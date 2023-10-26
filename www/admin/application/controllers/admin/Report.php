<?php

Class Report extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('logadmin_model');
        $this->load->model('admin_model');
        $this->load->library('session');

    }

    function  index()
    {
    }

    function  cashoutbybank()
    {
        canMenu('report/cashoutbybank');
        date_default_timezone_set('Asia/Yangon');
        $start_time = null;
        $end_time = null;
        if ($this->input->post('toDate')) {
            $start_time = $this->input->post('toDate');
        }

        if ($this->input->post('fromDate')) {
            $end_time = $this->input->post('fromDate');
        }

        if ($start_time === null) {
            $start_time = date('Y-m-d 00:00:00');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d H:i:s');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/cashoutbybank';
        $this->load->view('admin/main', $this->data);
    }

    function updatetrans(){
        date_default_timezone_set('Asia/Yangon');
        $transId = null;
        if ($this->input->get('transId')) {
            $transId = $this->input->get('transId');
        }
        if($transId == null)
            return;
        $this->data['transId'] = $transId;
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=112&tid=' . $transId.'&action=get');
        if(isset($datainfo)){
            $this->data['dataTrans']['data'] = json_decode($datainfo, true);
        }else{
            return;
        }
        
        $this->data['temp'] = 'admin/report/updatetrans';
        $this->load->view('admin/main', $this->data);
    }

    function updatetranajax(){
        $status = $this->input->post("status");
        $transId = $this->input->post("transId");
        $user = $this->session->userdata['usernameadmin'];
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=112&st=' . $status .'&tid=' . $transId.'&action=update' . '&uad='.$user);
        echo $datainfo;
        
    }

    function  cashoutbybankajax()
    {
        $bank = $this->input->post("bank");
        $nickname = urlencode($this->input->post("nickname"));
        $status = $this->input->post("status");
        $bankNumber = $this->input->post("bankNumber");
        $bankAccountName = $this->input->post("bankAccountName");
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $pages = $this->input->post("pages");
        $tranid = urlencode($this->input->post("tranid"));
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=112&nn=' . $nickname . '&b=' . $bank . '&st=' . $status . '&te=' . urlencode($toDate) . '&ts=' . urlencode($fromDate) . '&p=' . $pages . '&tid=' . $tranid.'&action=getList');
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "You must not hack";
        }
    }

    //start cashout by momo
//    function  cashoutbymomo()
//    {
//        date_default_timezone_set('Asia/Yangon');
//        $start_time = null;
//        $end_time = null;
//        if ($this->input->post('toDate')) {
//            $start_time = $this->input->post('toDate');
//        }
//
//        if ($this->input->post('fromDate')) {
//            $end_time = $this->input->post('fromDate');
//        }
//
//        if ($start_time === null) {
//            $start_time = date('Y-m-d 00:00:00');
//        }
//        if ($end_time === null) {
//            $end_time = date('Y-m-d H:i:s');
//        }
//        $this->data['start_time'] = $start_time;
//        $this->data['end_time'] = $end_time;
//        $this->data['temp'] = 'admin/report/cashoutbymomo';
//        $this->load->view('admin/main', $this->data);
//    }

    function updatetransmomo(){
        date_default_timezone_set('Asia/Yangon');
        $transId = null;
        if ($this->input->get('transId')) {
            $transId = $this->input->get('transId');
        }
        if($transId == null)
            return;
        $this->data['transId'] = $transId;
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=1122&tid=' . $transId.'&action=get');
        if(isset($datainfo)){
            $this->data['dataTrans']['data'] = json_decode($datainfo, true);
        }else{
            return;
        }
        
        $this->data['temp'] = 'admin/report/updatetransmomo';
        $this->load->view('admin/main', $this->data);
    }

    function updatetranmomoajax(){
        $status = $this->input->post("status");
        $transId = $this->input->post("transId");
        $user = $this->session->userdata['usernameadmin'];
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=1122&st=' . $status .'&tid=' . $transId.'&action=update&uad='.$user);
        echo $datainfo;
        
    }

//    function  cashoutbymomoajax()
//    {
//        $bank = $this->input->post("bank");
//        $nickname = urlencode($this->input->post("nickname"));
//        $status = $this->input->post("status");
//        $bankNumber = $this->input->post("bankNumber");
//        $bankAccountName = $this->input->post("bankAccountName");
//        $toDate = $this->input->post("toDate");
//        $fromDate = $this->input->post("fromDate");
//        $pages = $this->input->post("pages");
//        $tranid = urlencode($this->input->post("tranid"));
//        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=1122&nn=' . $nickname . '&b=' . $bank . '&st=' . $status . '&te=' . urlencode($toDate) . '&ts=' . urlencode($fromDate) . '&p=' . $pages . '&tid=' . $tranid.'&action=getList');
//        if (isset($datainfo)) {
//            echo $datainfo;
//        } else {
//            echo "You must not hack";
//        }
//    }


    //end cashout by momo


//    function  cashoutbycard()
//    {
//        date_default_timezone_set('Asia/Yangon');
//        $start_time = null;
//        $end_time = null;
//        if ($this->input->post('toDate')) {
//            $start_time = $this->input->post('toDate');
//        }
//
//        if ($this->input->post('fromDate')) {
//            $end_time = $this->input->post('fromDate');
//        }
//
//        if ($start_time === null) {
//            $start_time = date('Y-m-d 00:00:00');
//        }
//        if ($end_time === null) {
//            $end_time = date('Y-m-d H:i:s');
//        }
//        $this->data['start_time'] = $start_time;
//        $this->data['end_time'] = $end_time;
//        $this->data['temp'] = 'admin/report/cashoutbycard';
//        $this->load->view('admin/main', $this->data);
//    }
//
//    function  cashoutbycardajax()
//    {
//        $provider = $this->input->post("provider");
//        $nickname = urlencode($this->input->post("nickname"));
//        $serial = urlencode($this->input->post("serial"));
//        $status = $this->input->post("status");
//        $toDate = $this->input->post("toDate");
//        $fromDate = $this->input->post("fromDate");
//        $pages = $this->input->post("pages");
//        $partner = $this->input->post("partner");
//        $tranid = urlencode($this->input->post("tranid"));
//        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=113&nn=' . $nickname . '&pv=' . $provider . '&sp=' . $serial . '&co=' . $status . '&ts=' . urlencode($toDate) . '&te=' . urlencode($fromDate) . '&p=' . $pages . '&tid=' . $tranid.'&pa='.$partner);
//
//        if (isset($datainfo)) {
//            echo $datainfo;
//        } else {
//            echo "You must not hack";
//        }
//
//    }

//    function  cashoutbytopup()
//    {
//        date_default_timezone_set('Asia/Yangon');
//        $start_time = null;
//        $end_time = null;
//        if ($this->input->post('toDate')) {
//            $start_time = $this->input->post('toDate');
//        }
//
//        if ($this->input->post('fromDate')) {
//            $end_time = $this->input->post('fromDate');
//        }
//
//        if ($start_time === null) {
//            $start_time = date('Y-m-d 00:00:00');
//        }
//        if ($end_time === null) {
//            $end_time = date('Y-m-d H:i:s');
//        }
//        $this->data['start_time'] = $start_time;
//        $this->data['end_time'] = $end_time;
//        $this->data['temp'] = 'admin/report/cashoutbytopup';
//        $this->load->view('admin/main', $this->data);
//    }
//
//    function  cashoutbytopupajax()
//    {
//        $mobile = urlencode($this->input->post("mobile"));
//        $nickname = urlencode($this->input->post("nickname"));
//        $status = $this->input->post("status");
//        $toDate = $this->input->post("toDate");
//        $fromDate = $this->input->post("fromDate");
//        $pages = $this->input->post("pages");
//        $tranid = urlencode($this->input->post("tranid"));
//        $partner = $this->input->post("partner");
//        $type = $this->input->post("type");
//        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=114&nn=' . $nickname . '&tg=' . $mobile . '&st=' . "" . '&co=' . $status . '&ts=' . urlencode($toDate) . '&te=' . urlencode($fromDate) . '&p=' . $pages . '&tid=' . $tranid.'&pa='.$partner.'&type='.$type);
//        if (isset($datainfo)) {
//            echo $datainfo;
//        } else {
//            echo "You must not hack";
//        }
//    }

    function  rechargebyvincard()
    {


        date_default_timezone_set('Asia/Yangon');
        $start_time = null;
        $end_time = null;
        if ($this->input->post('toDate')) {
            $start_time = $this->input->post('toDate');
        }

        if ($this->input->post('fromDate')) {
            $end_time = $this->input->post('fromDate');
        }

        if ($start_time === null) {
            $start_time = date('Y-m-d 00:00:00');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d H:i:s');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/rechargebyvincard';
        $this->load->view('admin/main', $this->data);
    }

    function  rechargebyvincardajax()
    {

        $nickname = urlencode($this->input->post("nickname"));
        $serial = urlencode($this->input->post("serial"));
        $mathe = urlencode($this->input->post("mathe"));
        $status = $this->input->post("status");
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $pages = $this->input->post("pages");
        $tranid = urlencode($this->input->post("tranid"));
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=500&nn=' . $nickname . '&pv=&sr=' . $serial . '&pn=' . $mathe . '&co=' . $status . '&ts=' . urlencode($toDate) . '&te=' . urlencode($fromDate) . '&p=' . $pages . '&tid=' . $tranid);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "You must not hack";
        }

    }

    function  rechargebycard()
    {


        date_default_timezone_set('Asia/Yangon');
        $start_time = null;
        $end_time = null;
        if ($this->input->post('toDate')) {
            $start_time = $this->input->post('toDate');
        }

        if ($this->input->post('fromDate')) {
            $end_time = $this->input->post('fromDate');
        }

        if ($start_time === null) {
            $start_time = date('Y-m-d 00:00:00');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d 23:59:59');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/rechargebycard';
        $this->load->view('admin/main', $this->data);
    }


    function  rechargebycardajax()
    {
        $provider = $this->input->post("provider");
        $nickname = urlencode($this->input->post("nickname"));
        $serial = urlencode($this->input->post("serial"));
        $mathe = urlencode($this->input->post("mathe"));
        $status = $this->input->post("status");
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $pages = $this->input->post("pages");
        $tranid = urlencode($this->input->post("tranid"));
        $datainfo = $this->curl->simple_get($this->config->item('api_backendz') . '?c=115&nn=' . $nickname . '&pv=' . $provider . '&sr=' . $serial . '&pn=' . $mathe . '&co=' . $status . '&ts=' . urlencode($toDate) . '&te=' . urlencode($fromDate) . '&p=' . $pages . '&tid=' . $tranid);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "You must not hack";
        }

    }

    

    function updatecard()
    {
        $rid = $this->input->post("rid");
		if($rid==""){
			$rid = $this->input->get("rid");
		}
        $nickname = $this->input->post("nickname");
		if($nickname == ""){
			$nickname = $this->input->get("nickname");
		}
		//echo $rid . "---" . $nickname;die();
        $admin_login = $this->session->userdata('user_id_login');
        $admin_info = $this->admin_model->get_info($admin_login);
        $datainfo = $this->get_data_curl($this->config->item('api_backendz') . '?c=141&rid=' . $rid . '&act=' . $admin_info->FullName);
		
        $data1 = json_decode($datainfo);
		//var_dump($data1);die();
        if ($data1 != NULL && isset($datainfo)) {
            if ($data1->errorCode == 0) {
                $data = array(
                    'account_name' => $nickname,
                    'username' => $admin_info->UserName,
                    'action' => "Update thẻ pendding, mã giao dịch:  " . $rid,

                );
                $this->logadmin_model->create($data);
            }
            echo $datainfo;
        } else {
            echo "You must not hack";
        }
    }

//    function  doisoatthe()
//    {
//        date_default_timezone_set('Asia/Yangon');
//        $start_time = null;
//        $end_time = null;
//        if ($this->input->post('toDate')) {
//            $start_time = $this->input->post('toDate');
//        }
//
//        if ($this->input->post('fromDate')) {
//            $end_time = $this->input->post('fromDate');
//        }
//
//        if ($start_time === null) {
//            $start_time = date('Y-m-d 00:00:00');
//        }
//        if ($end_time === null) {
//            $end_time = date('Y-m-d H:i:s');
//        }
//        $this->data['start_time'] = $start_time;
//        $this->data['end_time'] = $end_time;
//        $this->data['temp'] = 'admin/report/doisoatthe';
//        $this->load->view('admin/main', $this->data);
//    }
//    function  doisoattheajax()
//    {
//
//        $toDate = $this->input->post("toDate");
//        $fromDate = $this->input->post("fromDate");
//        $provider = $this->input->post("provider");
//        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=161&ts=' . urlencode($toDate) . '&te=' . urlencode($fromDate).'&cr='.$provider);
//        if (isset($datainfo)) {
//            echo $datainfo;
//        } else {
//            echo "You must not hack";
//        }
//
//    }

//    function  rechargebybank()
//    {
//        date_default_timezone_set('Asia/Yangon');
//        $start_time = null;
//        $end_time = null;
//        if ($this->input->post('toDate')) {
//            $start_time = $this->input->post('toDate');
//        }
//
//        if ($this->input->post('fromDate')) {
//            $end_time = $this->input->post('fromDate');
//        }
//
//        if ($start_time === null) {
//            $start_time = date('Y-m-d 00:00:00');
//        }
//        if ($end_time === null) {
//            $end_time = date('Y-m-d H:i:s');
//        }
//        $this->data['start_time'] = $start_time;
//        $this->data['end_time'] = $end_time;
//        $this->data['temp'] = 'admin/report/rechargebybank';
//        $this->load->view('admin/main', $this->data);
//    }

//    function  rechargebymomo()
//    {
//        date_default_timezone_set('Asia/Yangon');
//        $start_time = null;
//        $end_time = null;
//        if ($this->input->post('toDate')) {
//            $start_time = $this->input->post('toDate');
//        }
//
//        if ($this->input->post('fromDate')) {
//            $end_time = $this->input->post('fromDate');
//        }
//
//        if ($start_time === null) {
//            $start_time = date('Y-m-d 00:00:00');
//        }
//        if ($end_time === null) {
//            $end_time = date('Y-m-d H:i:s');
//        }
//        $this->data['start_time'] = $start_time;
//        $this->data['end_time'] = $end_time;
//        $this->data['temp'] = 'admin/report/rechargebymomo';
//        $this->load->view('admin/main', $this->data);
//    }
//
//    function  rechargebymomoajax()
//    {
//        $txtvinplay = urlencode($this->input->post("txtvinplay"));
//        $nickname = urlencode($this->input->post("nickname"));
//        $txtip = urlencode($this->input->post("txtip"));
//        $sendFrom = $this->input->post("sendFrom");
//        $status = $this->input->post("status");
//        $toDate = $this->input->post("toDate");
//        $fromDate = $this->input->post("fromDate");
//        $pages = $this->input->post("pages");
//        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=787&nn=' . $nickname . '&tid=' . $txtvinplay . '&ip=' . $txtip . '&sendFrom=' . $sendFrom . '&st=' . $status . '&ts=' . urlencode($toDate) . '&te=' . urlencode($fromDate) . '&tno=' . "" . '&p=' . $pages);
//        if (isset($datainfo)) {
//            echo $datainfo;
//        } else {
//            echo "You must not hack";
//        }
//
//    }

//    function  rechargebybankajax()
//    {
//        $txtvinplay = urlencode($this->input->post("txtvinplay"));
//        $nickname = urlencode($this->input->post("nickname"));
//        $txtip = urlencode($this->input->post("txtip"));
//        $bank = $this->input->post("bank");
//        $status = $this->input->post("status");
//        $toDate = $this->input->post("toDate");
//        $fromDate = $this->input->post("fromDate");
//        $pages = $this->input->post("pages");
//        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=720&nn=' . $nickname . '&tid=' . $txtvinplay . '&ip=' . $txtip . '&b=' . $bank . '&st=' . $status . '&ts=' . urlencode($toDate) . '&te=' . urlencode($fromDate) . '&tno=' . "" . '&p=' . $pages);
//        if (isset($datainfo)) {
//            echo $datainfo;
//        } else {
//            echo "You must not hack";
//        }
//
//    }

    function updatedepositbankmanual(){
        $transId = urlencode($this->input->post("transId"));
        $type = urlencode($this->input->post("type"));
        $user = $this->session->userdata['usernameadmin'];
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=788&transId=' . $transId . '&type=' . $type . '&uad='. $user);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "You must not hack";
        }
    }

    function updatedepositmomomanual(){
        $transId = urlencode($this->input->post("transId"));
        $type = urlencode($this->input->post("type"));
        $user = $this->session->userdata['usernameadmin'];
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=789&transId=' . $transId . '&type=' . $type . '&uad='. $user);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "You must not hack";
        }
    }

    function  rechargebynganluong()
    {
        date_default_timezone_set('Asia/Yangon');
        $start_time = null;
        $end_time = null;
        if ($this->input->post('toDate')) {
            $start_time = $this->input->post('toDate');
        }

        if ($this->input->post('fromDate')) {
            $end_time = $this->input->post('fromDate');
        }

        if ($start_time === null) {
            $start_time = date('Y-m-d 00:00:00');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d H:i:s');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/rechargebynganluong';
        $this->load->view('admin/main', $this->data);
    }

    function  rechargebynganluongajax()
    {
        $txtvinplay = urlencode($this->input->post("txtvinplay"));
        $nickname = urlencode($this->input->post("nickname"));
        $txtip = urlencode($this->input->post("txtip"));
        $bank = $this->input->post("bank");
        $status = $this->input->post("status");
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $pages = $this->input->post("pages");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=721&nn=' . $nickname . '&tid=' . $txtvinplay . '&ip=' . $txtip . '&b=' . $bank . '&st=' . $status . '&ts=' . urlencode($toDate) . '&te=' . urlencode($fromDate) . '&tno=' . "" . '&p=' . $pages);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "You must not hack";
        }

    }

    function  logsmsotp()
    {
        canMenu('report/logsmsotp');
        date_default_timezone_set('Asia/Yangon');
        $start_time = null;
        $end_time = null;
        if ($this->input->post('toDate')) {
            $start_time = $this->input->post('toDate');
        }

        if ($this->input->post('fromDate')) {
            $end_time = $this->input->post('fromDate');
        }

        if ($start_time === null) {
            $start_time = date('Y-m-d 00:00:00');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d 23:59:59');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/logsmsotp';
        $this->load->view('admin/main', $this->data);
    }

    function  logsmsotpajax()
    {
        $mobile = urlencode($this->input->post("mobile"));
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $pages = $this->input->post("pages");
        $tranid = urlencode($this->input->post("tranid"));
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=722&m=' . $mobile . '&ts=' . urlencode($toDate) . '&te=' . urlencode($fromDate) . '&p=' . $pages . '&rid=' . $tranid);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "You must not hack";
        }
    }

    function  logbrandname()
    {
        date_default_timezone_set('Asia/Yangon');
        $start_time = null;
        $end_time = null;
        if ($this->input->post('toDate')) {
            $start_time = $this->input->post('toDate');
        }

        if ($this->input->post('fromDate')) {
            $end_time = $this->input->post('fromDate');
        }

        if ($start_time === null) {
            $start_time = date('Y-m-d 00:00:00');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d H:i:s');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/logbrandname';
        $this->load->view('admin/main', $this->data);
    }

    function  logbrandnameajax()
    {
        $mobile = urlencode($this->input->post("mobile"));
        $status = $this->input->post("status");
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $pages = $this->input->post("pages");
        $tranid = urlencode($this->input->post("tranid"));
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=719&m=' . $mobile . '&co=' . "" . '&st=' . $status . '&ts=' . urlencode($toDate) . '&te=' . urlencode($fromDate) . '&p=' . $pages . '&rid=' . $tranid);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "You must not hack";
        }
    }

    function  moneysystem()
    {
        date_default_timezone_set('Asia/Yangon');
        $start_time = null;
        $end_time = null;
        if ($this->input->post('toDate')) {
            $start_time = $this->input->post('toDate');
        }

        if ($this->input->post('fromDate')) {
            $end_time = $this->input->post('fromDate');
        }

        if ($start_time === null) {
            $start_time = date('d-m-Y');
        }
        if ($end_time === null) {
            $end_time = date('d-m-Y');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/moneysystem';
        $this->load->view('admin/main', $this->data);
    }

    function  moneysystemnew()
    {
        canMenu('report/moneysystemnew');
        date_default_timezone_set('Asia/Yangon');
        $start_time = null;
        $end_time = null;
        $nickName = "";
        if ($this->input->post('toDate')) {
            $start_time = $this->input->post('toDate');
        }

        if ($this->input->post('fromDate')) {
            $end_time = $this->input->post('fromDate');
        }
        if ($this->input->post('nickName')) {
            $nickName = $this->input->post('nickName');
        }

        if ($start_time === null) {
            $start_time = date('Y-m-d');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d');
        }

        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['nickName'] = $nickName;
        $this->data['temp'] = 'admin/report/moneysystemnew';
        $this->data['data'] = $this->config->item('game_match');
        $this->load->view('admin/main', $this->data);
    }

    function  moneysystemajax()
    {
        canMenu('report/moneysystemnew');
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $nickName = $this->input->post("nickName");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=71&startTime=' . urlencode($toDate) . '&endTime=' . urlencode($fromDate) . "&nickname=". $nickName);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "You must not hack";
        }
    }

    function  moneyuser()
    {
        canMenu('report/moneyuser');
        $this->data['temp'] = 'admin/report/moneyuser';
        $this->load->view('admin/main', $this->data);
    }

    function  moneyuserajax()
    {
        canMenu('report/moneyuser');
        $nickname = urlencode($this->input->post("nickname"));
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=8&nn=' . $nickname . '&ts=' . urlencode($toDate) . '&te=' . urlencode($fromDate));
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "You must not hack";
        }
    }

    function  moneytotal()
    {
        canMenu('report/moneytotal');
        date_default_timezone_set('Asia/Yangon');
        $start_time = null;
        $end_time = null;
        if ($this->input->post('toDate')) {
            $start_time = $this->input->post('toDate');
        }

        if ($this->input->post('fromDate')) {
            $end_time = $this->input->post('fromDate');
        }

        if ($start_time === null) {
            $start_time = date('Y-m-d 00:00:00');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d 23:59:59');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/moneytotal';
        $this->load->view('admin/main', $this->data);
    }

    function  moneytotalajax()
    {
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $pages = $this->input->post("pages");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=9&ts=' . urlencode($toDate) . '&te=' . urlencode($fromDate) . '&p=' . $pages);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "You must not hack";
        }

    }

    function  topnaptien()
    {
        $this->data['temp'] = 'admin/report/topnaptien';
        $this->load->view('admin/main', $this->data);
    }

    function  chartmoneytotal()
    {
        canMenu('report/chartmoneytotal');
        date_default_timezone_set('Asia/Yangon');
        $start_time = null;
        $end_time = null;
        if ($this->input->post('toDate')) {
            $start_time = $this->input->post('toDate');
        }

        if ($this->input->post('fromDate')) {
            $end_time = $this->input->post('fromDate');
        }

        if ($start_time === null) {
            $start_time = date('Y-m-d 00:00:00');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d 23:59:59');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/chartmoneytotal';
        $this->load->view('admin/main', $this->data);
    }

    function  chartmoneyagent()
    {
        canMenu('report/chartmoneyagent');
        date_default_timezone_set('Asia/Yangon');
        $start_time = null;
        $end_time = null;
        if ($this->input->post('toDate')) {
            $start_time = $this->input->post('toDate');
        }

        if ($this->input->post('fromDate')) {
            $end_time = $this->input->post('fromDate');
        }

        if ($start_time === null) {
            $start_time = date('Y-m-d 00:00:00');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d 23:59:59');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/chartmoneyagent';
        $this->load->view('admin/main', $this->data);
    }

    function  chartmoneytotalajax()
    {
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $pages = $this->input->post("pages");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=9&ts=' . urlencode($toDate) . '&te=' . urlencode($fromDate) . '&p=' . $pages);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "You must not hack";
        }

    }

    function  rechargebyiap()
    {

        date_default_timezone_set('Asia/Yangon');
        $start_time = null;
        $end_time = null;
        if ($this->input->post('toDate')) {
            $start_time = $this->input->post('toDate');
        }

        if ($this->input->post('fromDate')) {
            $end_time = $this->input->post('fromDate');
        }

        if ($start_time === null) {
            $start_time = date('Y-m-d 00:00:00');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d H:i:s');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/rechargebyiap';
        $this->load->view('admin/main', $this->data);
    }

    function  rechargebyiapajax()
    {
        $provider = $this->input->post("provider");
        $nickname = urlencode($this->input->post("nickname"));
        $txtoderid = urlencode($this->input->post("txtoderid"));
        $status = $this->input->post("status");
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $pages = $this->input->post("pages");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=124&nn=' . $nickname . '&am=' . $provider . '&oid=' . $txtoderid . '&co=' . $status . '&ts=' . urlencode($toDate) . '&te=' . urlencode($fromDate) . '&p=' . $pages);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "You must not hack";
        }
    }

    function  rechargeby9029()
    {

        date_default_timezone_set('Asia/Yangon');
        $start_time = null;
        $end_time = null;
        if ($this->input->post('toDate')) {
            $start_time = $this->input->post('toDate');
        }

        if ($this->input->post('fromDate')) {
            $end_time = $this->input->post('fromDate');
        }

        if ($start_time === null) {
            $start_time = date('Y-m-d 00:00:00');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d H:i:s');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/rechargeby9029';
        $this->load->view('admin/main', $this->data);
    }

    function  rechargeby9029ajax()
    {
        $nickname = urlencode($this->input->post("nickname"));
        $mobile = urlencode($this->input->post("mobile"));
        $amout = $this->input->post("amout");
        $rid = urlencode($this->input->post("rid"));
        $status = urlencode($this->input->post("status"));
        $toDate = urlencode($this->input->post("toDate"));
        $fromDate = urlencode($this->input->post("fromDate"));
        $pages = $this->input->post("pages");

        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=315&nn=' . $nickname . '&m=' . $mobile . '&am=' . $amout . '&rid=' . $rid . '&co=' . $status . '&ts=' . $toDate . '&te=' . $fromDate . '&p=' . $pages);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "You must not hack";
        }
    }

    function  rechargeby8x98()
    {

        date_default_timezone_set('Asia/Yangon');
        $start_time = null;
        $end_time = null;
        if ($this->input->post('toDate')) {
            $start_time = $this->input->post('toDate');
        }

        if ($this->input->post('fromDate')) {
            $end_time = $this->input->post('fromDate');
        }

        if ($start_time === null) {
            $start_time = date('Y-m-d 00:00:00');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d H:i:s');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/rechargeby8x98';
        $this->load->view('admin/main', $this->data);
    }

    function  rechargeby8x98ajax()
    {
        $nickname = urlencode($this->input->post("nickname"));
        $mobile = urlencode($this->input->post("mobile"));
        $amout = $this->input->post("amout");
        $rid = urlencode($this->input->post("rid"));
        $status = urlencode($this->input->post("status"));
        $toDate = urlencode($this->input->post("toDate"));
        $fromDate = urlencode($this->input->post("fromDate"));
        $pages = $this->input->post("pages");
        $shortcode = $this->input->post("shortcode");

        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=314&nn=' . $nickname . '&m=' . $mobile . '&am=' . $amout . '&sc=' . $shortcode . '&rid=' . $rid . '&co=' . $status . '&ts=' . $toDate . '&te=' . $fromDate . '&p=' . $pages);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "You must not hack";
        }
    }

    function  checkmo9029()
    {

        date_default_timezone_set('Asia/Yangon');
        $start_time = null;
        $end_time = null;
        if ($this->input->post('toDate')) {
            $start_time = $this->input->post('toDate');
        }

        if ($this->input->post('fromDate')) {
            $end_time = $this->input->post('fromDate');
        }

        if ($start_time === null) {
            $start_time = date('Y-m-d 00:00:00');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d H:i:s');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/checkmo9029';
        $this->load->view('admin/main', $this->data);
    }

    function  checkmo9029ajax()
    {
        $mobile = urlencode($this->input->post("mobile"));
        $amout = $this->input->post("amout");
        $status = urlencode($this->input->post("status"));
        $toDate = urlencode($this->input->post("toDate"));
        $fromDate = urlencode($this->input->post("fromDate"));
        $pages = $this->input->post("pages");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=316&m=' . $mobile . '&am=' . $amout . '&co=' . $status . '&ts=' . $toDate . '&te=' . $fromDate . '&p=' . $pages);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "You must not hack";
        }
    }

    function  money()
    {
        date_default_timezone_set('Asia/Yangon');
        $start_time = null;
        $end_time = null;
        if ($this->input->post('toDate')) {
            $start_time = $this->input->post('toDate');
        }

        if ($this->input->post('fromDate')) {
            $end_time = $this->input->post('fromDate');
        }

        if ($start_time === null) {
            $start_time = date('d-m-Y');
        }
        if ($end_time === null) {
            $end_time = date('d-m-Y');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/money';
        $this->load->view('admin/main', $this->data);
    }


//    function  reportupdatecard()
//    {
//
//
//        date_default_timezone_set('Asia/Yangon');
//        $start_time = null;
//        $end_time = null;
//        if ($this->input->post('toDate')) {
//            $start_time = $this->input->post('toDate');
//        }
//
//        if ($this->input->post('fromDate')) {
//            $end_time = $this->input->post('fromDate');
//        }
//
//        if ($start_time === null) {
//            $start_time = date('Y-m-d 00:00:00');
//        }
//        if ($end_time === null) {
//            $end_time = date('Y-m-d H:i:s');
//        }
//        $this->data['start_time'] = $start_time;
//        $this->data['end_time'] = $end_time;
//        $this->data['temp'] = 'admin/report/reportupdatecard';
//        $this->load->view('admin/main', $this->data);
//    }
//
//
//    function  reportupdatecardajax()
//    {
//        $provider = $this->input->post("provider");
//        $nickname = urlencode($this->input->post("nickname"));
//        $serial = urlencode($this->input->post("serial"));
//        $mathe = urlencode($this->input->post("mathe"));
//        $status = $this->input->post("status");
//        $toDate = $this->input->post("toDate");
//        $fromDate = $this->input->post("fromDate");
//        $pages = $this->input->post("pages");
//        $tranid = urlencode($this->input->post("tranid"));
//        $txtnickname = urlencode($this->input->post("txtnickname"));
//        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=510&nn=' . $nickname . '&pv=' . $provider . '&sr=' . $serial . '&pn=' . $mathe . '&co=' . $status . '&ts=' . urlencode($toDate) . '&te=' . urlencode($fromDate) . '&p=' . $pages . '&rid=' . $tranid . '&act=' . $txtnickname);
//        if (isset($datainfo)) {
//            echo $datainfo;
//        } else {
//            echo "You must not hack";
//        }
//
//    }


//    function  doisoatnganluong()
//    {
//        date_default_timezone_set('Asia/Yangon');
//        $start_time = null;
//        $end_time = null;
//        if ($this->input->post('toDate')) {
//            $start_time = $this->input->post('toDate');
//        }
//
//        if ($this->input->post('fromDate')) {
//            $end_time = $this->input->post('fromDate');
//        }
//
//        if ($start_time === null) {
//            $start_time = date('Y-m-d 00:00:00');
//        }
//        if ($end_time === null) {
//            $end_time = date('Y-m-d H:i:s');
//        }
//        $this->data['start_time'] = $start_time;
//        $this->data['end_time'] = $end_time;
//        $this->data['temp'] = 'admin/report/doisoatnganluong';
//        $this->load->view('admin/main', $this->data);
//    }
//
//    function doisoatnganluongajax()
//    {
//
//        $toDate = $this->input->post("toDate");
//        $fromDate = $this->input->post("fromDate");
//        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=511&ts=' . urlencode($toDate) . '&te=' . urlencode($fromDate));
//        if (isset($datainfo)) {
//            echo $datainfo;
//        } else {
//            echo "You must not hack";
//        }
//
//    }

    function  doisoatvmg()
    {
        date_default_timezone_set('Asia/Yangon');
        $start_time = null;
        $end_time = null;
        if ($this->input->post('toDate')) {
            $start_time = $this->input->post('toDate');
        }

        if ($this->input->post('fromDate')) {
            $end_time = $this->input->post('fromDate');
        }

        if ($start_time === null) {
            $start_time = date('Y-m-d 00:00:00');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d 23:59:59');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/doisoatvmg';
        $this->load->view('admin/main', $this->data);
    }

    function doisoatvmgajax()
    {

        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=18&ts=' . urlencode($toDate) . '&te=' . urlencode($fromDate));
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "You must not hack";
        }

    }

    function exportvmg()

    {
        date_default_timezone_set('Asia/Yangon');
        $start_time = null;
        $end_time = null;
        if ($this->input->post('toDate')) {
            $start_time = $this->input->post('toDate');
        }
        if ($this->input->post('fromDate')) {
            $end_time = $this->input->post('fromDate');
        }
        if ($start_time === null) {
            $start_time = date('Y-m-d 00:00:00');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d 23:59:59');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->load->library('PHPExcel');
        $objPHPExcel = new PHPExcel();
        $BStyle = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('E5:K5')
            ->setCellValue('E5', 'SỐ LƯỢNG BẢN TIN')
            ->mergeCells('L5:O5')
            ->setCellValue('L5', 'DOANH THU PHÂN CHIA')
            ->getStyle('E5:O5')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('C6', 'Đầu số')
            ->setCellValue('D6', 'Nhà cung cấp')
            ->setCellValue('E6', 'Yêu cầu (MO)')
            ->setCellValue('F6', 'Phản hồi (MT)')
            ->setCellValue('G6', 'Tính cước (CDR)')
            ->setCellValue('H6', 'Tỷ lệ sau khi trừ thất thoát')
            ->setCellValue('I6', 'Số tin MT cho phép/1 MO')
            ->setCellValue('K6', 'Giới hạn MT')
            ->setCellValue('L6', 'Chênh lệch MT')
            ->setCellValue('M6', 'Đơn giá')
            ->setCellValue('N6', 'Amount of money MT vượt phải thanh toán  ')
            ->setCellValue('O6', 'Doanh thu dùng để phân chia')
            ->getStyle('C6:O6')->applyFromArray($BStyle);
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=18&ts=' . urlencode($start_time) . '&te=' . urlencode($end_time));
        $data = json_decode($datainfo);
        //var_dump($data->providers);die();
        $i = 7;
        foreach ($data->providers as $row) {
            if ($i < 12) {
                $objPHPExcel->setActiveSheetIndex()
                    ->setCellValue('C' . $i, 8079)
                    ->getStyle('C' . $i)->applyFromArray($BStyle);

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('D' . $i, $this->getprovidervmg($row->id))
                    ->getStyle('D' . $i)->applyFromArray($BStyle);
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('E' . $i, $row->mo)
                    ->getStyle('E' . $i)->applyFromArray($BStyle)
                    ->getNumberFormat()->setFormatCode('#,##0');
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('F' . $i, $row->mt)
                    ->getStyle('F' . $i)->applyFromArray($BStyle)
                    ->getNumberFormat()->setFormatCode('#,##0');
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('G' . $i, $row->sms)
                    ->getStyle('G' . $i)->applyFromArray($BStyle)
                    ->getNumberFormat()->setFormatCode('#,##0');
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('H' . $i, 1)
                    ->getStyle('H' . $i)->applyFromArray($BStyle)
                    ->getNumberFormat()->applyFromArray(
                        array(
                            'code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE
                        )
                    );


                $i++;
            }
        }
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('I7', 1)
            ->setCellValue('I8', 2)
            ->setCellValue('I9', 2)
            ->setCellValue('I10', 1)
            ->setCellValue('I11', 0)
            ->getStyle('I7:I11')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('J7', '=IF(D7="VMS",E7*I7-E7,IF(D7="VNP",E7*I7-E7,IF(D7="VNM",E7*I7-E7,IF(D7="VIETTEL",E7*I7,0))))')
            ->setCellValue('J8', '=IF(D8="VMS",E8*I8-E8,IF(D8="VNP",E8*I8-E8,IF(D8="VNM",E8*I8-E8,IF(D8="VIETTEL",E8*I8,0))))')
            ->setCellValue('J9', '=IF(D9="VMS",E9*I9-E9,IF(D9="VNP",E9*I9-E9,IF(D9="VNM",E9*I9-E9,IF(D9="VIETTEL",E9*I9,0))))')
            ->setCellValue('J10', '=IF(D10="VMS",E10*I10-E10,IF(D10="VNP",E10*I10-E10,IF(D10="VNM",E10*I10-E10,IF(D10="VIETTEL",E10*I10,0))))')
            ->setCellValue('J11', '=IF(D11="VMS",E11*I11-E11,IF(D11="VNP",E11*I11-E11,IF(D11="VNM",E11*I11-E11,IF(D11="VIETTEL",E11*I11,0))))')
            ->getStyle('J7:J11')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('K7', '=IF(F7>E7,F7-E7,0)')
            ->setCellValue('K8', '=IF(F8>E8,F8-E8,0)')
            ->setCellValue('K9', '=IF(F9>E9,F9-E9,0)')
            ->setCellValue('K10', '=IF(F10>E10,F10-E10,0)')
            ->setCellValue('K11', '=IF(F11>E11,F11-E11,0)')
            ->getStyle('K7:K11')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('L7', 236)
            ->setCellValue('L8', 191)
            ->setCellValue('L9', 191)
            ->setCellValue('L10', 236)
            ->setCellValue('L11', 104)
            ->getStyle('L7:L11')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('M7', '=IF(D7="VIETTEL",545,IF(D7="VMS",318,IF(D7="VNP",455,IF(D7="VNM",455,181))))')
            ->setCellValue('M8', '=IF(D8="VIETTEL",545,IF(D8="VMS",318,IF(D8="VNP",455,IF(D8="VNM",455,181))))')
            ->setCellValue('M9', '=IF(D9="VIETTEL",545,IF(D9="VMS",318,IF(D9="VNP",455,IF(D9="VNM",455,181))))')
            ->setCellValue('M10', '=IF(D10="VIETTEL",545,IF(D10="VMS",318,IF(D10="VNP",455,IF(D10="VNM",455,181))))')
            ->setCellValue('M11', '=IF(D11="VIETTEL",545,IF(D11="VMS",318,IF(D11="VNP",455,IF(D11="VNM",455,181))))')
            ->getStyle('M7:M11')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('N7', '=IF(K7>J7,(K7-J7)*M7+J7*91,K7*91)')
            ->setCellValue('N8', '=IF(K8>J8,(K8-J8)*M8+J8*91,K8*91)')
            ->setCellValue('N9', '=IF(K9>J9,(K9-J9)*M9+J9*91,K9*91)')
            ->setCellValue('N10', '=IF(K10>J10,(K10-J10)*M10+J10*91,K10*91)')
            ->setCellValue('N11', '=IF(K11>J11,(K11-J11)*M11+J11*91,K11*91)')
            ->getStyle('N7:N11')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('O7', '=L7*G7*H7')
            ->setCellValue('O8', '=L8*G8*H8')
            ->setCellValue('O9', '=L9*G9*H9')
            ->setCellValue('O10', '=L10*G10*H10')
            ->setCellValue('O11', '=L11*G11*H11')
            ->getStyle('O7:O11')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->getStyle('I7:I11')
            ->getNumberFormat()
            ->setFormatCode('#,##0');
        $objPHPExcel->setActiveSheetIndex(0)
            ->getStyle('J7:J11')
            ->getNumberFormat()
            ->setFormatCode('#,##0');
        $objPHPExcel->setActiveSheetIndex(0)
            ->getStyle('K7:K11')
            ->getNumberFormat()
            ->setFormatCode('#,##0');
        $objPHPExcel->setActiveSheetIndex(0)
            ->getStyle('L7:L11')
            ->getNumberFormat()
            ->setFormatCode('#,##0');
        $objPHPExcel->setActiveSheetIndex(0)
            ->getStyle('M7:M11')
            ->getNumberFormat()
            ->setFormatCode('#,##0');
        $objPHPExcel->setActiveSheetIndex(0)
            ->getStyle('N7:N11')
            ->getNumberFormat()
            ->setFormatCode('#,##0');
        $objPHPExcel->setActiveSheetIndex(0)
            ->getStyle('O7:O11')
            ->getNumberFormat()
            ->setFormatCode('#,##0');
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('C12:D12')
            ->setCellValue('C12', 'Total Add')
            ->setCellValue('E12', '=SUM(E7:E11)')
            ->setCellValue('F12', '=SUM(F7:F11)')
            ->setCellValue('G12', '=SUM(G7:G11)')
            ->setCellValue('J12', '=SUM(J7:J11)')
            ->setCellValue('K12', '=SUM(K7:K11)')
            ->setCellValue('N12', '=SUM(N7:N11)')
            ->setCellValue('O12', '=SUM(O7:O11)')
            ->getStyle('C12:O12')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->getStyle('C12:O12')
            ->getNumberFormat()
            ->setFormatCode('#,##0');
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('C13:N13')
            ->setCellValue('C13', 'Doanh thu Công ty win123Club được hưởng (87%)')
            ->getStyle('C13:N13')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('C14:N14')
            ->setCellValue('C14', 'Doanh thu VMG được hưởng')
            ->getStyle('C14:N14')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('C15:N15')
            ->setCellValue('C15', 'Doanh thu tối thiểu win123Club phải trả VMG: 2.000.000đ/Month')
            ->getStyle('C15:N15')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('C16:N16')
            ->setCellValue('C16', 'Amount of money  MT vượt win123Club phải thanh toán')
            ->getStyle('C16:N16')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('C17:N17')
            ->setCellValue('C17', 'Fee command code đăng ký trên mạng Viettel: 1 mã x 2000đ')
            ->getStyle('C17:N17')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('C18:N18')
            ->setCellValue('C18', 'Doanh thu quyết toán - Công ty win123Club được hưởng sau khi trừ các chi phí')
            ->getStyle('C18:N18')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('C19:N19')
            ->setCellValue('C19', 'Amount of money đã tạm tính')
            ->getStyle('C19:N19')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('C20:N20')
            ->setCellValue('C20', 'Doanh thu còn lại win123Club được hưởng:')
            ->getStyle('C20:N20')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('C21:N21')
            ->setCellValue('C21', 'Thuế VAT 10%')
            ->getStyle('C21:N21')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('C22:N22')
            ->setCellValue('C22', 'Total Add sau thuế')
            ->getStyle('C22:N22')->applyFromArray($BStyle);

        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('O13', "=IF(O12<200000000,O12*87%,IF(O12<500000000,O12*89%,IF(O12<1000000001,O12*91%,O12*93%)))")
            ->setCellValue('O14', '=O12-O13')
            ->setCellValue('O15', '=1*2000000')
            ->setCellValue('O16', '=N12')
            ->setCellValue('O17', '=3*2000/1.1')
            ->setCellValue('O18', '=IF(O14>O15,O13-O16-O17,O12-O15-O16-O17)')
            ->setCellValue('O19', 0)
            ->setCellValue('O20', '=O18-O19')
            ->setCellValue('O21', '=ROUND(O20*10%,0)')
            ->setCellValue('O22', '=O20+O21')
            ->getStyle('O13:O22')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->getStyle('O13:O22')
            ->getNumberFormat()
            ->setFormatCode('#,##0');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="doisoatvmg.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');


        // var_dump($data);

    }

    function getprovidervmg($pro)
    {
        $str = "";
        if ($pro == 0) {
            $str = "VIETTEL";
        } else if ($pro == 1) {
            $str = "VNP";
        } else if ($pro == 2) {
            $str = "VMS";
        } else if ($pro == 3) {
            $str = "VNM";

        } else if ($pro == 4) {
            $str = "GTEL";
        }
        return $str;
    }


    function  doisoatbrandname()
    {
        date_default_timezone_set('Asia/Yangon');
        $start_time = null;
        $end_time = null;
        if ($this->input->post('toDate')) {
            $start_time = $this->input->post('toDate');
        }

        if ($this->input->post('fromDate')) {
            $end_time = $this->input->post('fromDate');
        }

        if ($start_time === null) {
            $start_time = date('Y-m-d 00:00:00');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d 23:59:59');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/doisoatbrandname';
        $this->load->view('admin/main', $this->data);
    }

    function doisoatbrandnameajax()
    {

        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=19&ts=' . urlencode($toDate) . '&te=' . urlencode($fromDate));
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "You must not hack";
        }

    }


    function exportbrandname()

    {
        date_default_timezone_set('Asia/Yangon');
        $start_time = null;
        $end_time = null;
        if ($this->input->post('toDate')) {
            $start_time = $this->input->post('toDate');
        }
        if ($this->input->post('fromDate')) {
            $end_time = $this->input->post('fromDate');
        }
        if ($start_time === null) {
            $start_time = date('Y-m-d 00:00:00');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d 23:59:59');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->load->library('PHPExcel');
        $objPHPExcel = new PHPExcel();
        $BStyle = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B6', 'No')
            ->mergeCells('C6:D6')
            ->setCellValue('C6', 'Nội dung')
            ->setCellValue('E6', 'Số lượng')
            ->setCellValue('F6', 'Đơn giá')
            ->setCellValue('G6', 'Amount of money')
            ->getStyle('B6:G6')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B7', 'I')
            ->mergeCells('C7:D7')
            ->setCellValue('C7', 'SMS Customer care')
            ->setCellValue('E7', '')
            ->setCellValue('F7', '')
            ->setCellValue('G7', '')
            ->getStyle('B7:G7')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('F8', 150000)
            ->getStyle('F8')->applyFromArray($BStyle)
            ->getNumberFormat()->setFormatCode('#,##0');
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('F9', 150000)
            ->getStyle('F9')->applyFromArray($BStyle)
            ->getNumberFormat()->setFormatCode('#,##0');
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('G9', '=F9*E9')
            ->getStyle('G9')->applyFromArray($BStyle)
            ->getNumberFormat()->setFormatCode('#,##0');
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B8', '1')
            ->mergeCells('C8:D8')
            ->setCellValue('C8', 'Fee đăng ký Brandname')
            ->setCellValue('E8', '')
            ->setCellValue('G8', '=F8*E8')
            ->getStyle('B8:G8')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B9', '2')
            ->mergeCells('C9:D9')
            ->setCellValue('C9', 'Fee duy trì thương hiệu')
            ->setCellValue('E9', 1)
            ->getStyle('B9:G9')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B10', '3')
            ->mergeCells('C10:D10')
            ->setCellValue('C10', 'Fee send tin')
            ->setCellValue('E10', '')
            ->setCellValue('F10', '')
            ->setCellValue('G10', '=F10*E10')
            ->getStyle('B10:G10')->applyFromArray($BStyle);
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=19&ts=' . urlencode($start_time) . '&te=' . urlencode($end_time));

        $data = json_decode($datainfo);
        $i = 11;

        foreach ($data->providers as $row) {
            //var_dump($row);die();

            $objPHPExcel->setActiveSheetIndex()
                ->setCellValue('B' . $i, "")
                ->getStyle('B' . $i)->applyFromArray($BStyle);

            $objPHPExcel->setActiveSheetIndex(0)
                ->mergeCells('C' . $i . ':D' . $i)
                ->setCellValue('C' . $i, $this->getprovider($row->id))
                ->getStyle('C' . $i . ':D' . $i)->applyFromArray($BStyle)
                ->getNumberFormat()->setFormatCode('#,##0');
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('E' . $i, $row->sms)
                ->getStyle('E' . $i)->applyFromArray($BStyle)
                ->getNumberFormat()->setFormatCode('#,##0');
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('F' . $i, $row->price)
                ->getStyle('F' . $i)->applyFromArray($BStyle)
                ->getNumberFormat()->setFormatCode('#,##0');
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('G' . $i, '=E' . $i . '*F' . $i)
                ->getStyle('G' . $i)->applyFromArray($BStyle)
                ->getNumberFormat()->setFormatCode('#,##0');


            $i++;
        }

        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B15', "II")
            ->getStyle('B15:B20')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('C15:D15')
            ->setCellValue('C15', "SMS Quảng cáo")
            ->getStyle('C15:D15')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('C16:D16')
            ->setCellValue('C16', "Mạng Viettel")
            ->getStyle('C16:D16')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('C17:D17')
            ->setCellValue('C17', "Mạng Vinaphone")
            ->getStyle('C17:D17')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('C18:D18')
            ->setCellValue('C18', "Mạng Mobiofone")
            ->getStyle('C18:D18')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('C19:D19')
            ->setCellValue('C19', "Mạng Khác")
            ->getStyle('C19:D19')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('C20:D20')
            ->setCellValue('C20', "Total Add (đã bao gồm 10% VAT)")
            ->getStyle('C20:D20')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('E20', "=SUM(E10:E19)")
            ->getStyle('E15:E20')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('F16', "450")
            ->setCellValue('F17', "410")
            ->setCellValue('F18', "410")
            ->setCellValue('F19', "360")
            ->getStyle('F15:F20')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('G15', "=F15*E15")
            ->setCellValue('G16', "=F16*E16")
            ->setCellValue('G17', "=F17*E17")
            ->setCellValue('G18', "=F18*E18")
            ->setCellValue('G19', "=F19*E19")
            ->getStyle('G15:G20')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('G20', "=ROUND(SUM(G8:G19),0)")
            ->getStyle('G20')
            ->getNumberFormat()->setFormatCode('#,##0');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="doisoatbrandname.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');


        // var_dump($data);

    }

    function getprovider($pro)
    {
        $str = "";
        if ($pro == 0) {
            $str = "Mạng Viettel";
        } else if ($pro == 1) {
            $str = "Mạng Vinaphone";
        } else if ($pro == 2) {
            $str = "Mạng Mobifone";
        } else if ($pro == 3) {
            $str = "Mạng Vietnammobile";

        } else if ($pro == 4) {
            $str = "Mạng Gtel";
        } else if ($pro == 5) {
            $str = "Mạng khác";
        }
        return $str;
    }


//    function  doisoatmuamt()
//    {
//        date_default_timezone_set('Asia/Yangon');
//        $start_time = null;
//        $end_time = null;
//        if ($this->input->post('toDate')) {
//            $start_time = $this->input->post('toDate');
//        }
//
//        if ($this->input->post('fromDate')) {
//            $end_time = $this->input->post('fromDate');
//        }
//
//        if ($start_time === null) {
//            $start_time = date('Y-m-d 00:00:00');
//        }
//        if ($end_time === null) {
//            $end_time = date('Y-m-d 23:59:59');
//        }
//        $this->data['start_time'] = $start_time;
//        $this->data['end_time'] = $end_time;
//        $this->data['temp'] = 'admin/report/doisoatmuamt';
//        $this->load->view('admin/main', $this->data);
//    }
//
//    function doisoatmuamtajax()
//    {
//
//        $toDate = $this->input->post("toDate");
//        $fromDate = $this->input->post("fromDate");
//        $partner = $this->input->post("partner");
//        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=146&ts=' . urlencode($toDate) . '&te=' . urlencode($fromDate) . '&pa=' . $partner);
//        if (isset($datainfo)) {
//            echo $datainfo;
//        } else {
//            echo "You must not hack";
//        }
//
//    }

//    function  doisoatnapdt()
//    {
//        date_default_timezone_set('Asia/Yangon');
//        $start_time = null;
//        $end_time = null;
//        if ($this->input->post('toDate')) {
//            $start_time = $this->input->post('toDate');
//        }
//
//        if ($this->input->post('fromDate')) {
//            $end_time = $this->input->post('fromDate');
//        }
//
//        if ($start_time === null) {
//            $start_time = date('Y-m-d 00:00:00');
//        }
//        if ($end_time === null) {
//            $end_time = date('Y-m-d 23:59:59');
//        }
//        $this->data['start_time'] = $start_time;
//        $this->data['end_time'] = $end_time;
//        $this->data['temp'] = 'admin/report/doisoatnapdt';
//        $this->load->view('admin/main', $this->data);
//    }
//
//    function doisoatnapdtajax()
//    {
//
//        $toDate = $this->input->post("toDate");
//        $fromDate = $this->input->post("fromDate");
//        $partner = $this->input->post("partner");
//        $dichvu = $this->input->post("dichvu");
//        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=147&ts=' . urlencode($toDate) . '&te=' . urlencode($fromDate) . '&pa=' . $partner . '&type=' . $dichvu);
//        if (isset($datainfo)) {
//            echo $datainfo;
//        } else {
//            echo "You must not hack";
//        }
//
//    }

    function  doisoat9029()
    {
        date_default_timezone_set('Asia/Yangon');
        $start_time = null;
        $end_time = null;


        if ($start_time === null) {
            $start_time = date('Y-m-d 00:00:00');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d 23:59:59');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;

        $this->data['temp'] = 'admin/report/doisoat9029';
        $this->load->view('admin/main', $this->data);
    }

    function doisoat9029ajax()
    {

        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=149&ts=' . urlencode($toDate) . '&te=' . urlencode($fromDate));
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "You must not hack";
        }

    }

    function exportdoisoat9029()

    {
        date_default_timezone_set('Asia/Yangon');
        $start_time = null;
        $end_time = null;
        if ($this->input->post('toDate')) {
            $start_time = $this->input->post('toDate');
        }
        if ($this->input->post('fromDate')) {
            $end_time = $this->input->post('fromDate');
        }
        if ($start_time === null) {
            $start_time = date('Y-m-d 00:00:00');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d 23:59:59');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->load->library('PHPExcel');
        $objPHPExcel = new PHPExcel();
        $BStyle = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('C3:E3')
            ->setCellValue('C3', 'Viettel')
            ->mergeCells('F3:H3')
            ->setCellValue('F3', 'Mobifone')
            ->mergeCells('I3:K3')
            ->setCellValue('I3', 'Vinaphone')
            ->getStyle('C3:K3')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('C4', 'Đơn giá')
            ->setCellValue('D4', 'Số lượng')
            ->setCellValue('E4', 'Total money')
            ->setCellValue('F4', 'Đơn giá')
            ->setCellValue('G4', 'Số lượng')
            ->setCellValue('H4', 'Total money')
            ->setCellValue('I4', 'Đơn giá')
            ->setCellValue('J4', 'Số lượng')
            ->setCellValue('K4', 'Total money')
            ->getStyle('C4:K4')->applyFromArray($BStyle);
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=149&ts=' . urlencode($start_time) . '&te=' . urlencode($end_time));
        $data = json_decode($datainfo)->moneyReponse[1]->trans;
        $data1 = json_decode($datainfo)->moneyReponse[3]->trans;
        $data2 = json_decode($datainfo)->moneyReponse[2]->trans;
        $i = 5;
        $j = 5;
        $k = 5;
        for($o=count($data)-1; $o>=0;$o--){
            $objPHPExcel->setActiveSheetIndex()
                ->setCellValue('B' . $i, $data[$o]->faceValue)
                ->getStyle('B' . $i)->applyFromArray($BStyle)
                ->getNumberFormat()->setFormatCode('#,##0');
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('C' . $i, $this->dongiaviettel($data[$o]->faceValue))
                ->getStyle('C' . $i)->applyFromArray($BStyle)
                ->getNumberFormat()->setFormatCode('#,##0');
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('D' . $i, $data[$o]->quantity)
                ->getStyle('D' . $i)->applyFromArray($BStyle)
                ->getNumberFormat()->setFormatCode('#,##0');
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('E' . $i, '=C' . $i . '*D' . $i)
                ->getStyle('E' . $i)->applyFromArray($BStyle)
                ->getNumberFormat()->setFormatCode('#,##0');

            $i++;

        }

        for($p=count($data1)-1; $p>=0;$p--){
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('F' . $j, $this->dongiavinamobi($data1[$p]->faceValue))
                ->getStyle('F' . $j)->applyFromArray($BStyle)
                ->getNumberFormat()->setFormatCode('#,##0');
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('G' . $j, $data1[$p]->quantity)
                ->getStyle('G' . $j)->applyFromArray($BStyle)
                ->getNumberFormat()->setFormatCode('#,##0');
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('H' . $j, '=F' . $j . '*G' . $j)
                ->getStyle('H' . $j)->applyFromArray($BStyle)
                ->getNumberFormat()->setFormatCode('#,##0');

            $j++;
        }


        for($q=count($data2)-1; $q>=0;$q--){
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('I' . $k, $this->dongiavinamobi($data2[$q]->faceValue))
                ->getStyle('I' . $k)->applyFromArray($BStyle)
                ->getNumberFormat()->setFormatCode('#,##0');
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('J' . $k, $data2[$q]->quantity)
                ->getStyle('J' . $k)->applyFromArray($BStyle)
                ->getNumberFormat()->setFormatCode('#,##0');
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('K' . $k, '=I' . $k . '*J' . $k)
                ->getStyle('K' . $k)->applyFromArray($BStyle)
                ->getNumberFormat()->setFormatCode('#,##0');

            $k++;
        }

        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('E16', '=SUM(E5:E15)')
            ->getStyle('E16')
            ->getNumberFormat()->setFormatCode('#,##0');
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('H16', '=SUM(H5:H15)')
            ->getStyle('H16')
            ->getNumberFormat()->setFormatCode('#,##0');
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('K16', '=SUM(K5:K15)')
            ->getStyle('K16')
            ->getNumberFormat()->setFormatCode('#,##0');
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('B17:E17')
            ->setCellValue('B17', 'Total doanh thu')
            ->getStyle('B17:E17')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('B18:E18')
            ->setCellValue('B18', 'Total doanh thu không bao gồm VAT')
            ->getStyle('B18:E18')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('B19:E19')
            ->setCellValue('B19', 'Tỷ lệ chia sẻ doanh thu')
            ->getStyle('B19:E19')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('B20:E20')
            ->setCellValue('B20', 'Tỷ lệ thất thoát')
            ->getStyle('B20:E20')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('B21:E21')
            ->setCellValue('B21', '')
            ->getStyle('B21:E21')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('B22:E22')
            ->setCellValue('B22', 'Chi phí mở mã (80,000 đ / mã)')
            ->getStyle('B22:E22')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('B23:E23')
            ->setCellValue('B23', 'Chi phí duy trì mã (32,000 đ / mã)')
            ->getStyle('B23:E23')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('B24:E24')
            ->setCellValue('B24', 'Refund fee cước khách hàng khiếu nại')
            ->getStyle('B24:E24')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('B25:E25')
            ->setCellValue('B25', 'Fee khác (nếu có)')
            ->getStyle('B25:E25')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('B26:E26')
            ->setCellValue('B26', 'Total phí')
            ->getStyle('B26:E26')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('B27:E27')
            ->setCellValue('B27', 'Doanh thu vinplay')
            ->getStyle('B27:E27')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('F17', '= E16+H16+K16')
            ->getStyle('F17')->applyFromArray($BStyle)
            ->getNumberFormat()->setFormatCode('#,##0');
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('F18', '= ROUND(F17/1.1,0)')
            ->getStyle('F18')->applyFromArray($BStyle)
            ->getNumberFormat()->setFormatCode('#,##0');
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('F19', '=IF(F18<=800000000,0.88,0.9)')
            ->getStyle('F19')->applyFromArray($BStyle)
            ->getNumberFormat()->applyFromArray(
                array(
                    'code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE
                )
            );
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('F20', '0.03')
            ->getStyle('F20')->applyFromArray($BStyle)
            ->getNumberFormat()->applyFromArray(
                array(
                    'code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE
                )
            );
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('F21', '= IF(F20<=0.03,0.98,1-F20)')
            ->getStyle('F21')->applyFromArray($BStyle)
            ->getNumberFormat()->applyFromArray(
                array(
                    'code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE
                )
            );
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('F22', '0')
            ->setCellValue('F23', '0')
            ->setCellValue('F24', '0')
            ->setCellValue('F25', '0')
            ->setCellValue('F26', '=SUM(F22:F25)')
            ->setCellValue('F27', '=ROUND(F18*F19*F21,0) - F26')
            ->getStyle('F22:F27')->applyFromArray($BStyle)
            ->getNumberFormat()->setFormatCode('#,##0');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="doisoat9029.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');


        // var_dump($data);

    }

    function dongiaviettel($dongia)
    {
        $str = 0;
        if ($dongia == 100000) {
            $str = 60000;
        } else if ($dongia == 50000) {
            $str = 30000;
        } else if ($dongia == 30000) {
            $str = 18000;
        } else if ($dongia == 20000) {
            $str = 12000;
        } else if ($dongia == 15000) {
            $str = 9000;
        } else if ($dongia == 10000) {
            $str = 6000;
        } else if ($dongia == 5000) {
            $str = 3000;
        } else if ($dongia == 4000) {
            $str = 2400;
        } else if ($dongia == 3000) {
            $str = 1800;
        } else if ($dongia == 2000) {
            $str = 1200;
        } else if ($dongia == 1000) {
            $str = 600;
        }
        return $str;
    }

    function dongiavinamobi($dongia)
    {
        $str = 0;
        if ($dongia == 100000) {
            $str = 65000;
        } else if ($dongia == 50000) {
            $str = 32500;
        } else if ($dongia == 30000) {
            $str = 19500;
        } else if ($dongia == 20000) {
            $str = 13000;
        } else if ($dongia == 15000) {
            $str = 9750;
        } else if ($dongia == 10000) {
            $str = 6500;
        } else if ($dongia == 5000) {
            $str = 3250;
        } else if ($dongia == 4000) {
            $str = 2600;
        } else if ($dongia == 3000) {
            $str = 1950;
        } else if ($dongia == 2000) {
            $str = 1300;
        } else if ($dongia == 1000) {
            $str = 650;
        }

        return $str;
    }

//    function  reportbycard()
//    {
//        date_default_timezone_set('Asia/Yangon');
//        $start_time = null;
//        $end_time = null;
//        //  $error = "";
//
//        if ($start_time === null) {
//            $start_time = date('Y-m-d 00:00:00');
//        }
//        if ($end_time === null) {
//            $end_time = date('Y-m-d 23:59:59');
//        }
//        $provider = "";
//        $code = "";
//        $amount = "";
//        $this->data['start_time'] = $start_time;
//        $this->data['end_time'] = $end_time;
//        $this->data['provider'] = $provider;
//        $this->data['code'] = $code;
//        $this->data['amount'] = $amount;
//        //$this->data['error'] = $error;
//        $message = $this->session->flashdata('message');
//        $this->data['message'] = $message;
//
//        $this->data['temp'] = 'admin/report/reportbycard';
//        $this->load->view('admin/main', $this->data);
//    }

    function  exportbycard()
    {
        date_default_timezone_set('Asia/Yangon');
        $start_time = null;
        $end_time = null;
        $provider = "";
        $amount = "";
        $code = "";
        $table = 0;
        $partner = "";
        $type = "";
        if($this->input->post('ok')){
            $this->data['error'] = "22222";
        }

        if ($this->input->post('toDate')) {
            $start_time = $this->input->post('toDate');
        }
        if ($this->input->post('fromDate')) {
            $end_time = $this->input->post('fromDate');
        }
        if ($this->input->post('select_provider')) {
            $provider = $this->input->post('select_provider');
        }
        if ($this->input->post('select_status')) {
            $code = $this->input->post('select_status');
        }
        if ($this->input->post('select_menhgia')) {
            $amount = $this->input->post('select_menhgia');
        }
        if ($this->input->post('select_table')) {
            $table = $this->input->post('select_table');
        }
        if ($this->input->post('select_partner')) {
            $partner = $this->input->post('select_partner');
        }
        if ($this->input->post('select_dichvu')) {
            $type = $this->input->post('select_dichvu');
        }
        if ($start_time === null) {
            $start_time = date('Y-m-d 00:00:00');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d 23:59:59');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->load->library('PHPExcel');
        $objPHPExcel = new PHPExcel();
        $BStyle = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        if ($table == 1) {
            $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=151&ts=' . urlencode($start_time) . '&te=' . urlencode($end_time) . '&pv=' . $provider . '&am=' . $amount . '&co=' . $code);
        } else if ($table == 2) {
            $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=152&ts=' . urlencode($start_time) . '&te=' . urlencode($end_time) . '&am=' . $amount . '&co=' . $code);
        } else if ($table == 3) {
            $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=153&ts=' . urlencode($start_time) . '&te=' . urlencode($end_time) . '&am=' . $amount . '&co=' . $code);
        }
        else if ($table == 4) {
            $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=158&ts=' . urlencode($start_time) . '&te=' . urlencode($end_time) . '&am=' . $amount . '&co=' . $code.'&pa='.$partner.'&pv='.$provider);
        } else if ($table == 5) {
            $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=159&ts=' . urlencode($start_time) . '&te=' . urlencode($end_time) . '&am=' . $amount . '&co=' . $code.'&pa='.$partner.'&pv='.$provider.'&type='.$type);
        }

        else if ($table == 6) {
            $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=165&ts=' . urlencode($start_time) . '&te=' . urlencode($end_time) . '&pri=' . $amount);
        }

       // $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=151&ts=' . urlencode($start_time) . '&te=' . urlencode($end_time) . '&pv=' . $provider . '&am=' . $amount . '&co=' . $code);
        // var_dump($this->config->item('api_backend') . '?c=151&ts=' . urlencode($start_time) . '&te=' . urlencode($end_time).'&pv='.$provider.'&am='.$amount.'&co='.$code);die();
        $data = json_decode($datainfo)->transactions;

       if ($table == 1) {

            if ($data == "" || $data != null) {
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'No')
                    ->setCellValue('B1', 'Trading code')
                    ->setCellValue('C1', 'Nickname')
                    ->setCellValue('D1', 'Thẻ')
                    ->setCellValue('E1', 'Nhà cung cấp')
                    ->setCellValue('F1', 'Serial')
                    ->setCellValue('G1', 'Mã thẻ')
                    ->setCellValue('H1', 'Denominations')
                    ->setCellValue('I1', 'Error code dịch vụ')
                    ->setCellValue('J1', 'Describe')
                    ->setCellValue('K1', 'Error code win123club')
                    ->setCellValue('L1', 'Time')
                    ->getStyle('A1:L1')->applyFromArray($BStyle);
                $i = 2;
                $j = 1;
                foreach ($data as $row) {

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A' . $i, $j)
                        ->getStyle('A' . $i)->applyFromArray($BStyle);

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('B' . $i, "'" . $row->referenceId)
                        ->getStyle('B' . $i)->applyFromArray($BStyle);

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('C' . $i, $row->nickName)
                        ->getStyle('C' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('D' . $i, $row->provider)
                        ->getStyle('D' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('E' . $i, $row->partner)
                        ->getStyle('E' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('F' . $i, "'" . $row->serial)
                        ->getStyle('F' . $i)->applyFromArray($BStyle);

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('G' . $i, "'" . $row->pin)
                        ->getStyle('G' . $i)->applyFromArray($BStyle);

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('H' . $i, $row->amount)
                        ->getStyle('H' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('I' . $i, $row->status)
                        ->getStyle('I' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('J' . $i, $row->message)
                        ->getStyle('J' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('K' . $i, $row->code)
                        ->getStyle('K' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('L' . $i, $row->timelog)
                        ->getStyle('L' . $i)->applyFromArray($BStyle);
                    $i++;
                    $j++;
                }

            } else {

                $this->session->set_flashdata('message', 1);
                redirect(admin_url('report/reportbycard'));


            }
        }
        if ($table == 2) {
            if ($data == "" || $data != null) {
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'No')
                    ->setCellValue('B1', 'Nickname')
                    ->setCellValue('C1', 'Điện thoại')
                    ->setCellValue('D1', 'Nhà mạng')
                    ->setCellValue('E1', 'Tin nhắn send')
                    ->setCellValue('F1', 'Denominations')
                    ->setCellValue('G1', 'Đầu số')
                    ->setCellValue('H1', 'Trading code')
                    ->setCellValue('I1', 'Describe')
                    ->setCellValue('J1', 'Win')
                    ->setCellValue('K1', 'Time')
                    ->getStyle('A1:K1')->applyFromArray($BStyle);
                $i = 2;
                $j = 1;
                foreach ($data as $row) {

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A' . $i, $j)
                        ->getStyle('A' . $i)->applyFromArray($BStyle);

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('B' . $i, $row->nickname)
                        ->getStyle('B' . $i)->applyFromArray($BStyle);

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('C' . $i, $row->mobile)
                        ->getStyle('C' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('D' . $i, $row->provider)
                        ->getStyle('D' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('E' . $i, $row->moMessage)
                        ->getStyle('E' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('F' . $i,   $row->amount)
                        ->getStyle('F' . $i)->applyFromArray($BStyle);

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('G' . $i,  $row->shortCode)
                        ->getStyle('G' . $i)->applyFromArray($BStyle);

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('H' . $i, $row->requestId)
                        ->getStyle('H' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('I' . $i, $row->des)
                        ->getStyle('I' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('J' . $i, $row->money)
                        ->getStyle('J' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('K' . $i, $row->timeLog)
                        ->getStyle('K' . $i)->applyFromArray($BStyle);
                    $i++;
                    $j++;
                }


            } else {

                $this->session->set_flashdata('message', 1);
                redirect(admin_url('report/reportbycard'));

            }
        }
        if ($table == 3) {
            if ($data == "" || $data != null) {
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'No')
                    ->setCellValue('B1', 'Nickname')
                    ->setCellValue('C1', 'Điện thoại')
                    ->setCellValue('D1', 'Nhà mạng')
                    ->setCellValue('E1', 'Tin nhắn send')
                    ->setCellValue('F1', 'Denominations')
                    ->setCellValue('G1', 'Đầu số')
                    ->setCellValue('H1', 'Trading code')
                    ->setCellValue('I1', 'Describe')
                    ->setCellValue('J1', 'Win')
                    ->setCellValue('K1', 'Time')
                    ->getStyle('A1:K1')->applyFromArray($BStyle);
                $i = 2;
                $j = 1;
                foreach ($data as $row) {

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A' . $i, $j)
                        ->getStyle('A' . $i)->applyFromArray($BStyle);

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('B' . $i, $row->nickname)
                        ->getStyle('B' . $i)->applyFromArray($BStyle);

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('C' . $i, $row->mobile)
                        ->getStyle('C' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('D' . $i, $row->provider)
                        ->getStyle('D' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('E' . $i, $row->moMessage)
                        ->getStyle('E' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('F' . $i,   $row->amount)
                        ->getStyle('F' . $i)->applyFromArray($BStyle);

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('G' . $i,  $row->shortCode)
                        ->getStyle('G' . $i)->applyFromArray($BStyle);

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('H' . $i, $row->requestId)
                        ->getStyle('H' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('I' . $i, $row->des)
                        ->getStyle('I' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('J' . $i, $row->money)
                        ->getStyle('J' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('K' . $i, $row->timeLog)
                        ->getStyle('K' . $i)->applyFromArray($BStyle);
                    $i++;
                    $j++;
                }


            } else {
                $this->session->set_flashdata('message', 1);
                redirect(admin_url('report/reportbycard'));

            }
        }

        if ($table == 4) {
            if ($data == "" || $data != null) {
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'No')
                    ->setCellValue('B1', 'Trading code')
                    ->setCellValue('C1', 'Nickname')
                    ->setCellValue('D1', 'Thẻ')
                    ->setCellValue('E1', 'Nhà cung cấp')
                    ->setCellValue('F1', 'Denominations')
                    ->setCellValue('G1', 'Số lượng')
                    ->setCellValue('H1', 'Thông tin thẻ nạp')
                    ->setCellValue('I1', 'Error code dịch vụ')
                    ->setCellValue('J1', 'Describe')
                    ->setCellValue('K1', 'Error code win123Club')
                    ->setCellValue('L1', 'Time')
                    ->getStyle('A1:L1')->applyFromArray($BStyle);
                $i = 2;
                $j = 1;
                foreach ($data as $row) {

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A' . $i, $j)
                        ->getStyle('A' . $i)->applyFromArray($BStyle);

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('B' . $i, "'".$row->referenceId)
                        ->getStyle('B' . $i)->applyFromArray($BStyle);

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('C' . $i, $row->nickName)
                        ->getStyle('C' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('D' . $i, $row->provider)
                        ->getStyle('D' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('E' . $i, $row->partner)
                        ->getStyle('E' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('F' . $i,   $row->amount)
                        ->getStyle('F' . $i)->applyFromArray($BStyle);

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('G' . $i,  $row->quantity)
                        ->getStyle('G' . $i)->applyFromArray($BStyle);

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('H' . $i, $row->softpin)
                        ->getStyle('H' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('I' . $i, $row->status)
                        ->getStyle('I' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('J' . $i, $row->message)
                        ->getStyle('J' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('K' . $i, $row->code)
                        ->getStyle('K' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('L' . $i, $row->timeLog)
                        ->getStyle('L' . $i)->applyFromArray($BStyle);
                    $i++;
                    $j++;
                }


            } else {
                $this->session->set_flashdata('message', 1);
                redirect(admin_url('report/reportbycard'));

            }

        }

        if ($table == 5) {
            if ($data == "" || $data != null) {
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'No')
                    ->setCellValue('B1', 'Trading code')
                    ->setCellValue('C1', 'Nickname')
                    ->setCellValue('D1', 'Điện thoại')
                    ->setCellValue('E1', 'Nhà mạng')
                    ->setCellValue('F1', 'Nhà cung cấp')
                    ->setCellValue('G1', 'Thuê bao')
                    ->setCellValue('H1', 'Money')
                    ->setCellValue('I1', 'Error code dịch vụ')
                    ->setCellValue('J1', 'Describe')
                    ->setCellValue('K1', 'Error code win123club')
                    ->setCellValue('L1', 'Time')
                    ->getStyle('A1:L1')->applyFromArray($BStyle);
                $i = 2;
                $j = 1;
                foreach ($data as $row) {

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A' . $i, $j)
                        ->getStyle('A' . $i)->applyFromArray($BStyle);

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('B' . $i, "'".$row->referenceId)
                        ->getStyle('B' . $i)->applyFromArray($BStyle);

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('C' . $i, $row->nickName)
                        ->getStyle('C' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('D' . $i, "'".$row->target)
                        ->getStyle('D' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('E' . $i, $row->provider)
                        ->getStyle('E' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('F' . $i,   $row->partner)
                        ->getStyle('F' . $i)->applyFromArray($BStyle);

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('G' . $i,  $row->type)
                        ->getStyle('G' . $i)->applyFromArray($BStyle);

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('H' . $i, $row->amount)
                        ->getStyle('H' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('I' . $i, $row->status)
                        ->getStyle('I' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('J' . $i, $row->message)
                        ->getStyle('J' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('K' . $i, $row->code)
                        ->getStyle('K' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('L' . $i, $row->timeLog)
                        ->getStyle('L' . $i)->applyFromArray($BStyle);
                    $i++;
                    $j++;
                }


            } else {
                $this->session->set_flashdata('message', 1);
                redirect(admin_url('report/reportbycard'));

            }

        }

        if ($table == 6) {
            if ($data == "" || $data != null) {
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'No')
                    ->setCellValue('B1', 'orderCode')
                    ->setCellValue('C1', 'nickName')
                    ->setCellValue('D1', 'email')
                    ->setCellValue('E1', 'ip')
                    ->setCellValue('F1', 'totalAmount')
                    ->setCellValue('G1', 'bank')
                    ->setCellValue('H1', 'errorCodeSend')
                    ->setCellValue('I1', 'descVp')
                    ->setCellValue('J1', 'transTime')
                    ->setCellValue('K1', 'errorCodeReturn')
                    ->setCellValue('L1', 'descReturn')
                    ->setCellValue('M1', 'updateTime')
                    ->getStyle('A1:M1')->applyFromArray($BStyle);
                $i = 2;
                $j = 1;
                foreach ($data as $row) {

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A' . $i, $j)
                        ->getStyle('A' . $i)->applyFromArray($BStyle);

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('B' . $i, "'".$row->orderCode)
                        ->getStyle('B' . $i)->applyFromArray($BStyle);

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('C' . $i, $row->nickName)
                        ->getStyle('C' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('D' . $i, "'".$row->email)
                        ->getStyle('D' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('E' . $i, $row->ip)
                        ->getStyle('E' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('F' . $i,   $row->totalAmount)
                        ->getStyle('F' . $i)->applyFromArray($BStyle);

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('G' . $i,  $row->bank)
                        ->getStyle('G' . $i)->applyFromArray($BStyle);

                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('H' . $i, $row->errorCodeSend)
                        ->getStyle('H' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('I' . $i, $row->descVp)
                        ->getStyle('I' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('J' . $i, $row->transTime)
                        ->getStyle('J' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('K' . $i, $row->errorCodeReturn)
                        ->getStyle('K' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('L' . $i, $row->descReturn)
                        ->getStyle('L' . $i)->applyFromArray($BStyle);
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('M' . $i, $row->updateTime)
                        ->getStyle('M' . $i)->applyFromArray($BStyle);
                    $i++;
                    $j++;
                }


            } else {
                $this->session->set_flashdata('message', 1);
                redirect(admin_url('report/reportbycard'));

            }

        }

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="thenap.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');

        // var_dump($datainfo);die();

    }

    function  doisoat8x98()
    {
        date_default_timezone_set('Asia/Yangon');
        $start_time = null;
        $end_time = null;


        if ($start_time === null) {
            $start_time = date('Y-m-d 00:00:00');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d 23:59:59');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;

        $this->data['temp'] = 'admin/report/doisoat8x98';
        $this->load->view('admin/main', $this->data);
    }

    function doisoat8x98ajax()
    {

        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=148&ts=' . urlencode($toDate) . '&te=' . urlencode($fromDate));
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "You must not hack";
        }

    }

    function exportdoisoat8x98()

    {
        date_default_timezone_set('Asia/Yangon');
        $start_time = null;
        $end_time = null;
        if ($this->input->post('toDate')) {
            $start_time = $this->input->post('toDate');
        }
        if ($this->input->post('fromDate')) {
            $end_time = $this->input->post('fromDate');
        }
        if ($start_time === null) {
            $start_time = date('Y-m-d 00:00:00');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d 23:59:59');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->load->library('PHPExcel');
        $objPHPExcel = new PHPExcel();
        $BStyle = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('C3:E3')
            ->setCellValue('C3', 'Viettel')
            ->mergeCells('F3:H3')
            ->setCellValue('F3', 'Mobifone')
            ->mergeCells('I3:K3')
            ->setCellValue('I3', 'Vinaphone')
            ->mergeCells('L3:N3')
            ->setCellValue('L3', 'Vietnam Mobile')
            ->mergeCells('O3:Q3')
            ->setCellValue('O3', 'Vietnam Mobile')
            ->getStyle('C3:Q3')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('C4', 'Đơn giá')
            ->setCellValue('D4', 'Số lượng')
            ->setCellValue('E4', 'Total money')
            ->setCellValue('F4', 'Đơn giá')
            ->setCellValue('G4', 'Số lượng')
            ->setCellValue('H4', 'Total money')
            ->setCellValue('I4', 'Đơn giá')
            ->setCellValue('J4', 'Số lượng')
            ->setCellValue('K4', 'Total money')
            ->setCellValue('L4', 'Đơn giá')
            ->setCellValue('M4', 'Số lượng')
            ->setCellValue('N4', 'Total money')
            ->setCellValue('O4', 'Đơn giá')
            ->setCellValue('P4', 'Số lượng')
            ->setCellValue('Q4', 'Total money')
            ->getStyle('C4:Q4')->applyFromArray($BStyle);
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=148&ts=' . urlencode($start_time) . '&te=' . urlencode($end_time));
        $data = json_decode($datainfo)->moneyReponse[1]->trans;
        $data1 = json_decode($datainfo)->moneyReponse[3]->trans;
        $data2 = json_decode($datainfo)->moneyReponse[2]->trans;
        $data3 = json_decode($datainfo)->moneyReponse[4]->trans;
        $data4 = json_decode($datainfo)->moneyReponse[5]->trans;
        $i = 5;
        $j = 5;
        $k = 5;
        $l = 5;
        $m = 5;

        for($o=count($data)-1; $o>=0;$o--){
            if ($data[$o]->faceValue <= 15000) {
                $objPHPExcel->setActiveSheetIndex()
                    ->setCellValue('B' . $i, $data[$o]->faceValue)
                    ->getStyle('B' . $i)->applyFromArray($BStyle)
                    ->getNumberFormat()->setFormatCode('#,##0');
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('C' . $i, $this->dongiaviettel8x98($data[$o]->faceValue))
                    ->getStyle('C' . $i)->applyFromArray($BStyle)
                    ->getNumberFormat()->setFormatCode('#,##0');
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('D' . $i, $data[$o]->quantity)
                    ->getStyle('D' . $i)->applyFromArray($BStyle)
                    ->getNumberFormat()->setFormatCode('#,##0');
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('E' . $i, '=C' . $i . '*D' . $i)
                    ->getStyle('E' . $i)->applyFromArray($BStyle)
                    ->getNumberFormat()->setFormatCode('#,##0');
                $i++;
            }
        }

        for($p=count($data1)-1; $p>=0;$p--){
            if ($data1[$p]->faceValue <= 15000) {
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('F' . $j, $this->dongiavinamobi8x98($data1[$p]->faceValue))
                    ->getStyle('F' . $j)->applyFromArray($BStyle)
                    ->getNumberFormat()->setFormatCode('#,##0');
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('G' . $j, $data1[$p]->quantity)
                    ->getStyle('G' . $j)->applyFromArray($BStyle)
                    ->getNumberFormat()->setFormatCode('#,##0');
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('H' . $j, '=F' . $j . '*G' . $j)
                    ->getStyle('H' . $j)->applyFromArray($BStyle)
                    ->getNumberFormat()->setFormatCode('#,##0');
                $j++;
            }

        }
        for($q=count($data2)-1; $q>=0;$q--){
            if ($data2[$q]->faceValue <= 15000) {
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('I' . $k, $this->dongiavinamobi8x98($data2[$q]->faceValue))
                    ->getStyle('I' . $k)->applyFromArray($BStyle)
                    ->getNumberFormat()->setFormatCode('#,##0');
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('J' . $k, $data2[$q]->quantity)
                    ->getStyle('J' . $k)->applyFromArray($BStyle)
                    ->getNumberFormat()->setFormatCode('#,##0');
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('K' . $k, '=I' . $k . '*J' . $k)
                    ->getStyle('K' . $k)->applyFromArray($BStyle)
                    ->getNumberFormat()->setFormatCode('#,##0');
                $k++;
            }

        }

        for($r=count($data3)-1; $r>=0;$r--){
            if ($data3[$r]->faceValue <= 15000) {
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('L' . $l, $this->dongiavietnam8x98($data3[$r]->faceValue))
                    ->getStyle('L' . $l)->applyFromArray($BStyle)
                    ->getNumberFormat()->setFormatCode('#,##0');
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('M' . $l, $data3[$r]->quantity)
                    ->getStyle('M' . $l)->applyFromArray($BStyle)
                    ->getNumberFormat()->setFormatCode('#,##0');
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('N' . $l, '=L' . $l . '*M' . $l)
                    ->getStyle('N' . $l)->applyFromArray($BStyle)
                    ->getNumberFormat()->setFormatCode('#,##0');
                $l++;
            }

        }
        for($s=count($data4)-1; $s>=0;$s--){
            if ($data4[$s]->faceValue <= 15000) {
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('O' . $m, $this->dongiavietnam8x98($data4[$s]->faceValue))
                    ->getStyle('O' . $m)->applyFromArray($BStyle)
                    ->getNumberFormat()->setFormatCode('#,##0');
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('P' . $m, $data4[$s]->quantity)
                    ->getStyle('P' . $m)->applyFromArray($BStyle)
                    ->getNumberFormat()->setFormatCode('#,##0');
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('Q' . $m, '=O' . $m . '*P' . $m)
                    ->getStyle('Q' . $m)->applyFromArray($BStyle)
                    ->getNumberFormat()->setFormatCode('#,##0');
                $m++;
            }

        }

        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('E12', '=SUM(E5:E11)')
            ->getStyle('E12')
            ->getNumberFormat()->setFormatCode('#,##0');
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('H12', '=SUM(H5:H11)')
            ->getStyle('H12')
            ->getNumberFormat()->setFormatCode('#,##0');
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('K12', '=SUM(K5:K11)')
            ->getStyle('K12')
            ->getNumberFormat()->setFormatCode('#,##0');
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('N12', '=SUM(N5:N11)')
            ->getStyle('N12')
            ->getNumberFormat()->setFormatCode('#,##0');
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('Q12', '=SUM(Q5:Q11)')
            ->getStyle('Q12')
            ->getNumberFormat()->setFormatCode('#,##0');
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('B17:E17')
            ->setCellValue('B17', 'Total doanh thu')
            ->getStyle('B17:E17')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('B18:E18')
            ->setCellValue('B18', 'Total doanh thu không bao gồm VAT')
            ->getStyle('B18:E18')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('B19:E19')
            ->setCellValue('B19', 'Tỷ lệ chia sẻ doanh thu')
            ->getStyle('B19:E19')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('B20:E20')
            ->setCellValue('B20', 'Tỷ lệ thất thoát')
            ->getStyle('B20:E20')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('B21:E21')
            ->setCellValue('B21', '')
            ->getStyle('B21:E21')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('B22:E22')
            ->setCellValue('B22', 'Chi phí mở mã (80,000 đ / mã)')
            ->getStyle('B22:E22')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('B23:E23')
            ->setCellValue('B23', 'Chi phí duy trì mã (32,000 đ / mã)')
            ->getStyle('B23:E23')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('B24:E24')
            ->setCellValue('B24', 'Refund fee cước khách hàng khiếu nại')
            ->getStyle('B24:E24')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('B25:E25')
            ->setCellValue('B25', 'Fee khác (nếu có)')
            ->getStyle('B25:E25')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('B26:E26')
            ->setCellValue('B26', 'Total phí')
            ->getStyle('B26:E26')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('B27:E27')
            ->setCellValue('B27', 'Doanh thu win123club')
            ->getStyle('B27:E27')->applyFromArray($BStyle);
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('F17', '= E12+H12+K12+N12+Q12')
            ->getStyle('F17')->applyFromArray($BStyle)
            ->getNumberFormat()->setFormatCode('#,##0');
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('F18', '= ROUND(F17/1.1,0)')
            ->getStyle('F18')->applyFromArray($BStyle)
            ->getNumberFormat()->setFormatCode('#,##0');
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('F19', '=IF(F18<=800000000,0.88,0.9)')
            ->getStyle('F19')->applyFromArray($BStyle)
            ->getNumberFormat()->applyFromArray(
                array(
                    'code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE
                )
            );
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('F20', '0.03')
            ->getStyle('F20')->applyFromArray($BStyle)
            ->getNumberFormat()->applyFromArray(
                array(
                    'code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE
                )
            );
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('F21', '= IF(F20<=0.03,0.98,1-F20)')
            ->getStyle('F21')->applyFromArray($BStyle)
            ->getNumberFormat()->applyFromArray(
                array(
                    'code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE
                )
            );
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('F22', '0')
            ->setCellValue('F23', '0')
            ->setCellValue('F24', '0')
            ->setCellValue('F25', '0')
            ->setCellValue('F26', '=SUM(F22:F25)')
            ->setCellValue('F27', '=ROUND(F18*F19*F21,0) - F26')
            ->getStyle('F22:F27')->applyFromArray($BStyle)
            ->getNumberFormat()->setFormatCode('#,##0');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="doisoat8x98.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');


        // var_dump($data);

    }

    function dongiaviettel8x98($dongia)
    {
        $str = 0;
        if ($dongia == 15000) {
            $str = 6750;
        } else if ($dongia == 10000) {
            $str = 4500;
        } else if ($dongia == 5000) {
            $str = 2250;
        } else if ($dongia == 4000) {
            $str = 1600;
        } else if ($dongia == 3000) {
            $str = 1200;
        } else if ($dongia == 2000) {
            $str = 800;
        } else if ($dongia == 1000) {
            $str = 260;
        }
        return $str;
    }

    function dongiavinamobi8x98($dongia)
    {
        $str = 0;
        if ($dongia == 15000) {
            $str = 6000;
        } else if ($dongia == 10000) {
            $str = 4000;
        } else if ($dongia == 5000) {
            $str = 2000;
        } else if ($dongia == 4000) {
            $str = 1600;
        } else if ($dongia == 3000) {
            $str = 1200;
        } else if ($dongia == 2000) {
            $str = 800;
        } else if ($dongia == 1000) {
            $str = 210;
        }

        return $str;
    }

    function dongiavietnam8x98($dongia)
    {
        $str = 0;
        if ($dongia == 15000) {
            $str = 8760;
        } else if ($dongia == 10000) {
            $str = 5760;
        } else if ($dongia == 5000) {
            $str = 2760;
        } else if ($dongia == 4000) {
            $str = 2160;
        } else if ($dongia == 3000) {
            $str = 1560;
        } else if ($dongia == 2000) {
            $str = 960;
        } else if ($dongia == 1000) {
            $str = 60;
        }

        return $str;
    }

    function  doisoatvincard()
    {
        date_default_timezone_set('Asia/Yangon');
        $start_time = null;
        $end_time = null;
        if ($this->input->post('toDate')) {
            $start_time = $this->input->post('toDate');
        }

        if ($this->input->post('fromDate')) {
            $end_time = $this->input->post('fromDate');
        }

        if ($start_time === null) {
            $start_time = date('Y-m-d 00:00:00');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d H:i:s');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/doisoatvincard';
        $this->load->view('admin/main', $this->data);
    }

    function doisoatvincardajax()
    {

        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=150&ts=' . urlencode($toDate) . '&te=' . urlencode($fromDate));
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "You must not hack";
        }

    }

    function  rechargebymegacard()
    {


        date_default_timezone_set('Asia/Yangon');
        $start_time = null;
        $end_time = null;
        if ($this->input->post('toDate')) {
            $start_time = $this->input->post('toDate');
        }

        if ($this->input->post('fromDate')) {
            $end_time = $this->input->post('fromDate');
        }

        if ($start_time === null) {
            $start_time = date('Y-m-d 00:00:00');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d H:i:s');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/rechargebymegacard';
        $this->load->view('admin/main', $this->data);
    }


    function  rechargebymegacardajax()
    {

        $nickname = urlencode($this->input->post("nickname"));
        $serial = urlencode($this->input->post("serial"));
        $mathe = urlencode($this->input->post("mathe"));
        $status = $this->input->post("status");
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $pages = $this->input->post("pages");
        $tranid = urlencode($this->input->post("tranid"));
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=514&nn=' . $nickname . '&pv=&sr=' . $serial . '&pn=' . $mathe . '&co=' . $status . '&ts=' . urlencode($toDate) . '&te=' . urlencode($fromDate) . '&p=' . $pages . '&tid=' . $tranid);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "You must not hack";
        }

    }

    function  doisoatmegacard()
    {
        date_default_timezone_set('Asia/Yangon');
        $start_time = null;
        $end_time = null;
        if ($this->input->post('toDate')) {
            $start_time = $this->input->post('toDate');
        }

        if ($this->input->post('fromDate')) {
            $end_time = $this->input->post('fromDate');
        }

        if ($start_time === null) {
            $start_time = date('Y-m-d 00:00:00');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d H:i:s');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/doisoatmegacard';
        $this->load->view('admin/main', $this->data);
    }

    function doisoatmegacardajax()
    {
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=515&ts=' . urlencode($toDate) . '&te=' . urlencode($fromDate));
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "You must not hack";
        }

    }
    function rechargefromvtc(){
        date_default_timezone_set('Asia/Yangon');
        $start_time = null;
        $end_time = null;
        if ($this->input->post('toDate')) {
            $start_time = $this->input->post('toDate');
        }

        if ($this->input->post('fromDate')) {
            $end_time = $this->input->post('fromDate');
        }

        if ($start_time === null) {
            $start_time = date('Y-m-d 00:00:00');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d H:i:s');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/rechargefromvtc';
        $this->load->view('admin/main', $this->data);

    }

    function  rechargefromvtcajax()
    {

        $nickname = urlencode($this->input->post("nickname"));
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $pages = $this->input->post("pages");
        $tranid = urlencode($this->input->post("tranid"));
        $price= urlencode($this->input->post("price"));
        $status= urlencode($this->input->post("status"));
        $datainfo = $this->curl->simple_get($this->config->item('api_backend') . '?c=163&nn=' . $nickname .'&ts=' . urlencode($toDate) . '&te=' . urlencode($fromDate) . '&p=' . $pages . '&tid=' . $tranid.'&pri='.$price.'&st='.$status . $this->getAuthBackend());
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "You must not hack";
        }

    }

    function  doisoatfromvtc()
    {
        date_default_timezone_set('Asia/Yangon');
        $start_time = null;
        $end_time = null;
        if ($this->input->post('toDate')) {
            $start_time = $this->input->post('toDate');
        }

        if ($this->input->post('fromDate')) {
            $end_time = $this->input->post('fromDate');
        }

        if ($start_time === null) {
            $start_time = date('Y-m-d 00:00:00');
        }
        if ($end_time === null) {
            $end_time = date('Y-m-d H:i:s');
        }
        $this->data['start_time'] = $start_time;
        $this->data['end_time'] = $end_time;
        $this->data['temp'] = 'admin/report/doisoatfromvtc';
        $this->load->view('admin/main', $this->data);
    }

    function doisoatfromvtcajax()
    {

        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $datainfo = $this->curl->simple_get($this->config->item('api_backend') . '?c=164&ts=' . urlencode($toDate) . '&te=' . urlencode($fromDate) . $this->getAuthBackend());
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "You must not hack";
        }

    }

    function getProviders() {
        $params = [
            'c' => 8812,
            'nns' => $this->session->userdata['usernameadmin'],
            'oid' => $this->input->post('orderId')
        ];
        echo $this->doRequest($params);
    }

    private function doRequest($params) {
        $url = $this->config->item('api_backend') . '?' . http_build_query($params);
        return $this->file_get_contents($url);
    }

		function chitietgiaodich()
		{
			$this->data['temp'] = 'admin/report/chitietgiaodich';
			$this->load->view('admin/main', $this->data);
		}

		function chitietgiaodichajax()
		{
			$actionName = urlencode($this->input->post("actionName"));
			$nickName = urlencode($this->input->post("nickName"));
			$toDate = urlencode($this->input->post("toDate"));
			$fromDate = urlencode($this->input->post("fromDate"));
			$fee = urlencode($this->input->post("fee"));
			$flagTime = urlencode($this->input->post("flagTime"));
			$moneyLost = urlencode($this->input->post("moneyLost"));
			$moneyOther = urlencode($this->input->post("moneyOther"));
			$moneyWin  = urlencode($this->input->post("moneyWin"));
			$page = urlencode($this->input->post("page"));
			$maxItem = urlencode($this->input->post("maxItem"));
			$datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=8822&an=' . $actionName . '&nn=' . $nickName . '&ft=' . $fromDate
				. '&et=' . $toDate . '&fe=' . $fee . '&ml=' . $moneyLost . '&mo=' . $moneyOther . '&mw=' . $moneyWin . '&fgt=' .$flagTime. '&pg=' . $page . '&mi=' . $maxItem);
			if (isset($datainfo)) {
				echo $datainfo;
			} else {
				echo "You must not hack";
			}
		}

	function napwin()
	{
		canMenu('report/napwin');
		$this->data['temp'] = 'admin/report/napwin';
		$this->load->view('admin/main', $this->data);
	}

	function napwinajax()
	{
		$nickName = urlencode($this->input->post("nickName"));
		$actionName = urlencode($this->input->post("actionName"));
		$toDate = urlencode($this->input->post("toDate"));
		$fromDate = urlencode($this->input->post("fromDate"));
		$serviceName = urlencode($this->input->post("serviceName"));
		$transId = urlencode($this->input->post("transId"));
		$userId = urlencode($this->input->post("userId"));
		$currentMoney = urlencode($this->input->post("currentMoney"));
		$moneyExchange = urlencode($this->input->post("moneyExchange"));
		$fee = urlencode($this->input->post("fee"));
		$page = urlencode($this->input->post("page"));
		$maxItem = urlencode($this->input->post("maxItem"));
		$datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=8823&nn=' . $nickName . '&an=' . $actionName . '&sn=' . $serviceName
			. '&ft=' . $fromDate . '&et=' . $toDate . '&trid=' . $transId . '&uid=' . $userId . '&cm=' . $currentMoney . '&me=' . $moneyExchange . '&fe=' . $fee. '&pg=' . $page. '&mi=' . $maxItem);
		if (isset($datainfo)) {
			echo $datainfo;
		} else {
			echo "You must not hack";
		}
	}

	function userwin()
	{
		canMenu('report/userwin');
		$this->data['temp'] = 'admin/report/userwin';
		$this->load->view('admin/main', $this->data);
	}

	function userwinajax()
	{
		$nickName = urlencode($this->input->post("nickName"));
		$toDate = urlencode($this->input->post("toDate"));
		$fromDate = urlencode($this->input->post("fromDate"));
		$serviceName = urlencode($this->input->post("serviceName"));
		$transId = urlencode($this->input->post("transId"));
		$userId = urlencode($this->input->post("userId"));
		$currentMoney = urlencode($this->input->post("currentMoney"));
		$moneyExchange = urlencode($this->input->post("moneyExchange"));
		$fee = urlencode($this->input->post("fee"));
		$page = urlencode($this->input->post("page"));
		$maxItem = urlencode($this->input->post("maxItem"));
        $actionName = $this->input->post("actionName");
        if ($actionName == "taixiusieutoc") {
            $actionName = "TaiXiu";
            $serviceName = 190;
        }

		$datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=8825&nn=' . $nickName . '&an=' . $actionName . '&sn=' . $serviceName
			. '&ft=' . $fromDate . '&et=' . $toDate . '&trid=' . $transId . '&uid=' . $userId . '&cm=' . $currentMoney . '&me=' . $moneyExchange . '&fe=' . $fee. '&pg=' . $page. '&mi=' . $maxItem);
		if (isset($datainfo)) {
			echo $datainfo;
		} else {
			echo "You must not hack";
		}
	}

	function tieuwin()
	{
		canMenu('report/tieuwin');
		$this->data['temp'] = 'admin/report/tieuwin';
		$this->load->view('admin/main', $this->data);
	}

	function tieuwinajax()
	{
		$nickName = urlencode($this->input->post("nickName"));
		$actionName = urlencode($this->input->post("actionName"));
		$toDate = urlencode($this->input->post("toDate"));
		$fromDate = urlencode($this->input->post("fromDate"));
		$serviceName = urlencode($this->input->post("serviceName"));
		$transId = urlencode($this->input->post("transId"));
		$userId = urlencode($this->input->post("userId"));
		$currentMoney = urlencode($this->input->post("currentMoney"));
		$moneyExchange = urlencode($this->input->post("moneyExchange"));
		$fee = urlencode($this->input->post("fee"));
		$page = urlencode($this->input->post("page"));
		$maxItem = urlencode($this->input->post("maxItem"));
		$datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=8824&nn=' . $nickName . '&an=' . $actionName . '&sn=' . $serviceName
			. '&ft=' . $fromDate . '&et=' . $toDate . '&trid=' . $transId . '&uid=' . $userId . '&cm=' . $currentMoney . '&me=' . $moneyExchange . '&fe=' . $fee. '&pg=' . $page. '&mi=' . $maxItem);
		if (isset($datainfo)) {
			echo $datainfo;
		} else {
			echo "You must not hack";
		}
	}

    function logbonus()
    {
        canMenu('report/logbonus');
        $this->data['temp'] = 'admin/report/logbonus';
        $eventConfig = $this->getEventConfig();
        $this->data['eventConfig'] = $eventConfig ? $eventConfig : [['name' => 'Không lấy được giá trị. Liên hệ với admin', 'id' => 0]];
        $this->load->view('admin/main', $this->data);
    }

    function logbonusajax()
    {
        $httpData = [
            'c' => 8834,
            'nn' => $this->input->post("nickName"),
            'bt' => $this->input->post("bonusType"),
            'ft' => $this->input->post("fromTime"),
            'et' => $this->input->post("endTime"),
            'fa' => $this->input->post("fromAmount"),
            'ta' => $this->input->post("toAmount"),
            'ip' => $this->input->post("ip"),
            'pg' => $this->input->post("pages"),
            'mi' => $this->input->post("size")
        ];
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?' . http_build_query($httpData));
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "You must not hack";
        }
    }

	function tongcuoc()
	{
		canMenu('report/tongcuoc');
		$this->data['temp'] = 'admin/report/tongcuoc';
		$this->load->view('admin/main', $this->data);
	}

	function tongcuocajax()
	{
		$nickName = urlencode($this->input->post("nickName"));
		$toDate = urlencode($this->input->post("toDate"));
		$fromDate = urlencode($this->input->post("fromDate"));
		$datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=8835&nn=' . $nickName . '&ft=' . $fromDate . '&et=' . $toDate);
		if (isset($datainfo)) {
			echo $datainfo;
		} else {
			echo "You must not hack";
		}
	}

    function firstDeposit()
    {
        canMenu('report/firstDeposit');
        $this->data['temp'] = 'admin/report/firstDeposit';
        $this->load->view('admin/main', $this->data);
    }

    function firstDepositAjax()
    {
        canMenu('report/firstDeposit');
        $params = [
            'c' => 74,
            't' => $this->input->post("t"),
            'code' => empty($this->input->post("code")) ? $this->config->item('default_code') : $this->input->post("code"),
            'nn' => $this->input->post("nn"),
            'pg' => $this->input->post("pg") ? $this->input->post("pg") : 1,
            'mi' => $this->input->post("mi") ? $this->input->post("mi") : 10,
        ];
        $endPoint = $this->config->item('api_agent') . "?" . http_build_query($params);
        try {
            $data = $this->get_data_curl($endPoint);
            echo empty($data) ? "Không trả về dữ liệu" : $data;
            return;
        } catch (\Exception $e) {
            log_message('error', 'Caught exception getListAjax : ' . $e->getMessage());
            return;
        }
    }

    function overviewReport(){
        $this->data['temp'] = 'admin/report/overviewReport';
        $uri = [
            'parent' => $this->input->get('parent'),
            'referral_code' => $this->input->get('referral_code'),
        ];
        $query = http_build_query($uri);
        $this->data['uri'] = $query;
        $this->load->view('admin/main', $this->data);
    }

    function overviewReportajax(){
        $nn = urlencode($this->input->post("nn"));
        $fromDate = urlencode($this->input->post("fromDate"));
        $toDate = urlencode($this->input->post("toDate"));
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=8828&nn=' . $nn.'&ft=' . $fromDate.'&et=' . $toDate);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "You must not hack";
        }
    }

    function userCount()
    {
        $this->data['temp'] = 'admin/report/userCount';
        $uri = [
            'parent' => $this->input->get('parent'),
            'referral_code' => $this->input->get('referral_code'),
        ];
        $query = http_build_query($uri);
        $this->data['uri'] = $query;
        $this->load->view('admin/main', $this->data);
    }

    function userCountAjax()
    {
        $params = [
            'c' => 9437,
            'nn' => $this->input->post("nn"),
            'ft' => $this->input->post("ft") ?? '2021-01-01',
            'et' => $this->input->post("et") ?? '2021-09-30',
            'p' => $this->input->post("pages") ?? 1,
            'mi' => $this->input->post("mi") ?? 10,
        ];
        $endPoint = $this->config->item('api_backend') . "?" . http_build_query($params);
        try {
            $response = $this->get_data_curl($endPoint);
            echo empty($response) ? '' : $response;
            return;
        } catch (\Exception $e) {
            log_message('error', 'Caught exception userCountAjax : ' . $e->getMessage());
            return;
        }
    }
}
