<?php

Class Transaction extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('freemoney_model');
        $this->load->model('logadmin_model');
        $this->load->model('sourcegiftcode_model');
        $this->load->model('useragent_model');
//        $this->load->model('bc_trans_log');
    }

//    function logtranfer()
//
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
//            $end_time = date('Y-m-d 23:59:59');
//        }
//        $this->data['start_time'] = $start_time;
//        $this->data['end_time'] = $end_time;
//        $this->data['temp'] = 'admin/transaction/logtranfer';
//        $this->load->view('admin/main', $this->data);
//    }
//
//    function logtranferajax()
//    {
//        $nickname = urlencode($this->input->post("nickname"));
//        $toDate = $this->input->post("toDate");
//        $fromDate = $this->input->post("fromDate");
//        $type = $this->input->post("type");
//        $pages = $this->input->post("pages");
//        $datainfo = $this->get_web_page($this->config->item('api_backend2') . '?c=405&nn=' . $nickname . '&ts=' . urlencode($toDate) . '&te=' . urlencode($fromDate) . '&p=' . $pages . '&type=' . $type);
//        if (isset($datainfo)) {
//            echo $datainfo["content"];
//        } else {
//            echo "You must not hack";
//        }
//
//    }

//    function logtranferdailytong()
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
//        $this->data['temp'] = 'admin/transaction/logtranferdailytong';
//        $this->load->view('admin/main', $this->data);
//    }
//
//    function logtranferdailytongajax()
//    {
//
//        $toDate = $this->input->post("toDate");
//        $fromDate = $this->input->post("fromDate");
//        $nickname = $this->input->post("nickname");
//        $pages = $this->input->post("pages");
//        $datainfo = $this->get_data_curl($this->config->item('api_backend2') . '?c=155&ts=' . urlencode($toDate) . '&te=' . urlencode($fromDate) . '&p=' . $pages . '&nnr=tongdaily&tds=&st=&nns=' . $nickname);
//        if (isset($datainfo)) {
//            echo $datainfo;
//        } else {
//            echo "You must not hack";
//        }
//
//    }

    function checkcsv()
    {
        $data = array(
            array("First Name" => "Nitya", "Last Name" => "", "Email" => "nityamaity87@gmail.com", "Message" => "Test message by Nitya"),
            array("First Name" => "Codex", "Last Name" => "World", "Email" => "info@codexworld.com", "Message" => "Test message by CodexWorld"),
            array("First Name" => "John", "Last Name" => "Thomas", "Email" => "john@gmail.com", "Message" => "Test message by John"),
            array("First Name" => "Michael", "Last Name" => "Vicktor", "Email" => "michael@gmail.com", "Message" => "Test message by Michael"),
            array("First Name" => "Sarah", "Last Name" => "David", "Email" => "sarah@gmail.com", "Message" => "Test message by Sarah")
        );

        function filterData(&$str)
        {
            $str = preg_replace("/\t/", "\\t", $str);
            $str = preg_replace("/\r?\n/", "\\n", $str);
            if (strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
        }

        // file name for download
        $fileName = "codexworld_export_data" . date('Ymd') . ".xls";

        // headers for download
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        header("Content-Type: application/vnd.ms-excel");

        $flag = false;
        foreach ($data as $row) {
            if (!$flag) {
                // display column names as first row
                echo implode("\t", array_keys($row)) . "\n";
                $flag = true;
            }
            // filter data
            array_walk($row, 'filterData');
            echo implode("\t", array_values($row)) . "\n";

        }

        exit;
    }

//    function usergiftcode()
//    {
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
//            $start_time = "";
//        }
//        if ($end_time === null) {
//            $end_time = "";
//        }
//        $this->data['start_time'] = $start_time;
//        $this->data['end_time'] = $end_time;
//
//        $sourcemkt = $this->sourcegiftcode_model->get_source_gift_code_marketing_view();
//        $sourcevh = $this->sourcegiftcode_model->get_source_gift_code_vanhanh();
//        $sourcedl = $this->useragent_model->get_admin_gift_code();
//        $this->data['sourcemkt'] = $sourcemkt;
//        $this->data['sourcevh'] = $sourcevh;
//        $this->data['sourcedl'] = $sourcedl;
//        $this->data['temp'] = 'admin/transaction/usergiftcode';
//        $this->load->view('admin/main', $this->data);
//    }
//
//    function usergiftcodeajax()
//    {
//        $nickname = urlencode($this->input->post("nickname"));
//        $toDate = $this->input->post("toDate");
//        $fromDate = $this->input->post("fromDate");
//        $money = $this->input->post("money");
//        $pages = $this->input->post("pages");
//        $datainfo = $this->get_data_curl($this->config->im('api_backend2') . '?c=3&nn=' . $nickname . '&un=' . "" . '&ts=' . urlencode($toDate) . '&te=' . urlencode($fromDate) . '&mt=' . $money . '&ag=GiftCode&sn=' . "" . '&p=' . $pages . '&lk=1');
//        if (isset($datainfo)) {
//            echo $datainfo;
//        } else {
//            echo "You must not hack";
//        }
//    }

    function freemoney()
    {
        canMenu('transaction/freemoney');
        $this->data['temp'] = 'admin/transaction/freemoney';
        $this->load->view('admin/main', $this->data);
    }

    function freemoneyajax()
    {
        $nickname = urlencode($this->input->post("nickname"));
        $namegame = $this->input->post("namegame");
        $money = $this->input->post("money");
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $pages = $this->input->post("pages");
        $datainfo = $this->get_data_curl($this->config->item('api_backend2') . '?c=713&nn=' . $nickname . '&mt=' . $money . '&gn=' . $namegame . '&ts=' . urlencode($toDate) . '&te=' . urlencode($fromDate) . '&p=' . $pages);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "You must not hack";
        }
    }

//    function freemoneyagent()
//    {
//        canMenu('transaction/freemoneyagent');
//        $this->data['temp'] = 'admin/transaction/freemoneyagent';
//        $this->load->view('admin/main', $this->data);
//    }
//
//    function freemoneyagentajax()
//    {
//        canMenu('transaction/freemoneyagent');
//        $nickname = urlencode($this->input->post("nickname"));
//        $toDate = $this->input->post("toDate");
//        $fromDate = $this->input->post("fromDate");
//        $pages = $this->input->post("pages");
//        $status = $this->input->post("status");
//        $datainfo = $this->get_data_curl($this->config->item('api_backend2') . '?c=144&nn=' . $nickname . '&ts=' . urlencode($toDate) . '&te=' . urlencode($fromDate) . '&p=' . $pages . '&st=' . $status);
//        if (isset($datainfo)) {
//            echo $datainfo;
//        } else {
//            echo "You must not hack";
//        }
//    }

    function openmoney()
    {

        $this->data['temp'] = 'admin/transaction/openmoney';
        $this->load->view('admin/main', $this->data);
    }

    function checkopenmoneyajax()
    {
        $nickname = urlencode($this->input->post("nickname"));
        $namegame = $this->input->post("namegame");
        $money = $this->input->post("money");
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $datainfo = $this->get_data_curl($this->config->item('api_backend2') . '?c=713&nn=' . $nickname . '&mt=' . $money . '&gn=' . $namegame . '&ts=' . urlencode($toDate) . '&te=' . urlencode($fromDate));
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "You must not hack";
        }
    }

    function openmoneyajax()
    {
        $admin_login = $this->session->userdata('user_id_login');
        $admin_info = $this->admin_model->get_info($admin_login);
        $sid = $this->input->post("sid");
        $nickname = $this->input->post("nickname");
        $gamename = $this->input->post("gamename");
        $room = $this->input->post("room");
        $money = $this->input->post("money");

        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=714&sid=' . $sid);
        if (isset($datainfo)) {
            if ($datainfo == 0) {
                $data = array(
                    'account_name' => $admin_info->FullName,
                    'username' => $admin_info->UserName,
                    'action' => "Open freeze tiền cho  tài khoản " . $nickname . " ,game " . $gamename . " , Room " . $room . " ,số tiền " . $money,
                );
                $this->logadmin_model->create($data);
            }
            echo $datainfo;
        } else {
            echo "You must not hack";
        }
    }

    function openmoneyagentajax()
    {
        $admin_login = $this->session->userdata('user_id_login');
        $admin_info = $this->admin_model->get_info($admin_login);
        $sid = $this->input->post("sid");
        $nickname = $this->input->post("nickname");
        $money = $this->input->post("money");

        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=145&sid=' . $sid);
        if (isset($datainfo)) {
            if ($datainfo == 0) {
                $data = array(
                    'account_name' => $admin_info->FullName,
                    'username' => $admin_info->UserName,
                    'action' => "Open freeze tiền đại lý chuyển khoản cho  tài khoản " . $nickname . " ,số tiền " . $money,
                );
                $this->logadmin_model->create($data);
            }
            echo $datainfo;
        } else {
            echo "You must not hack";
        }
    }

    function checkopenmoney()
    {
        $nickname = $this->input->post('nickname');
        $info = $list = $this->freemoney_model->get_info_freemoney($nickname);
        if ($info != false) {
            echo json_encode("Mở khóa đóng băng thành công");

        } else {
            echo json_encode("Không tồn tại nick name");
        }

    }

    function agentbuy()
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
        $this->data['temp'] = 'admin/transaction/agentbuy';
        $this->load->view('admin/main', $this->data);
    }

    function agentbuyajax()
    {
        $nickname = urlencode($this->input->post("nickname"));
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $pages = $this->input->post("pages");
        $record = $this->input->post("record");
        $datainfo = $this->get_data_curl($this->config->item('api_backend2') . '?c=118&nn=' . $nickname . '&type=' . "2" . '&ts=' . urlencode($toDate) . '&te=' . urlencode($fromDate) . '&p=' . $pages . '&tr=' . $record);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "You must not hack";
        }
    }

    function agentsale()
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
        $this->data['temp'] = 'admin/transaction/agentsale';
        $this->load->view('admin/main', $this->data);
    }

    function agentsaleajax()
    {
        $nickname = urlencode($this->input->post("nickname"));
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $pages = $this->input->post("pages");
        $record = $this->input->post("record");
        $datainfo = $this->get_data_curl($this->config->item('api_backend2') . '?c=118&nn=' . $nickname . '&type=' . "1" . '&ts=' . urlencode($toDate) . '&te=' . urlencode($fromDate) . '&p=' . $pages . '&tr=' . $record);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "You must not hack";
        }
    }

    function refundfee()
    {
        canMenu('transaction/refundfee');
        $this->data['temp'] = 'admin/transaction/refundfee';
        $this->load->view('admin/main', $this->data);
    }

    function refundfeeajax()
    {
        $nickname = urlencode($this->input->post("nickname"));
        $month = $this->input->post("month");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=712&nn=' . $nickname . '&month=' . $month);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "You must not hack";
        }
    }

    function refundfeeagent()
    {
        $admin_login = $this->session->userdata('user_id_login');
        $admin_info = $this->admin_model->get_info($admin_login);
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=711');
        if (isset($datainfo)) {
            $data = array(
                'username' => $admin_info->UserName,
                'action' => "Refund of agent fees"
            );
            $this->logadmin_model->create($data);
            echo $datainfo;
        } else {
            echo "You must not hack";
        }
    }

    function bonusds()
    {
        canMenu('transaction/bonusds');
        $this->data['temp'] = 'admin/transaction/bonusds';
        $this->load->view('admin/main', $this->data);
    }

    function bonusdsajax()
    {
        $nickname = urlencode($this->input->post("nickname"));
        $month = $this->input->post("month");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=725&nn=' . $nickname . '&month=' . $month);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "You must not hack";
        }
    }

    function bonusagent()
    {
        $admin_login = $this->session->userdata('user_id_login');
        $admin_info = $this->admin_model->get_info($admin_login);
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=724');
        if (isset($datainfo)) {
            $data = array(
                'username' => $admin_info->UserName,
                'action' => "Trả thưởng top doanh số đại lý"
            );
            $this->logadmin_model->create($data);
            echo $datainfo;
        } else {
            echo "You must not hack";
        }
    }

    function huydoanhso()
    {
        canMenu('transaction/huydoanhso');
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
        $this->data['temp'] = 'admin/transaction/huydoanhso';
        $this->load->view('admin/main', $this->data);
    }

    function huydoanhsoajax()
    {
        $nickname = urlencode($this->input->post("nickname"));
        $nicknamere = urlencode($this->input->post("nicknamere"));
        $toDate = $this->input->post("toDate");
        $fromDate = $this->input->post("fromDate");
        $status = $this->input->post("status");
        $topds = $this->input->post("topds");
        $pages = $this->input->post("pages");
        $datainfo = $this->get_data_curl($this->config->item('api_backend2') . '?c=155&nns=' . $nickname . '&nnr=' . $nicknamere . '&st=' . $status . '&tds=' . $topds . '&ts=' . urlencode($toDate) . '&te=' . urlencode($fromDate) . '&p=' . $pages);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "You must not hack";
        }
    }

    function doanhsoajax()
    {
        $admin_login = $this->session->userdata('user_id_login');
        $admin_info = $this->admin_model->get_info($admin_login);
        $nicknamesend = urlencode($this->input->post("ns"));
        $nicknamerecive = urlencode($this->input->post("nr"));
        $date = $this->input->post("date");
        $tds = $this->input->post("tds");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=127&nns=' . $nicknamesend . '&nnr=' . $nicknamerecive . '&t=' . urlencode($date) . '&tds=' . $tds);
        if (isset($datainfo)) {
            echo $datainfo;
            if ($tds == 1) {
                $txtaction = "Add doanh số đại lý";
            } elseif ($tds == 0) {
                $txtaction = "Trừ doanh số đại lý";
            }
            $data = array(
                'account_name' => $nicknamesend . "," . $nicknamerecive,
                'username' => $admin_info->UserName,
                'action' => $txtaction
            );
            $this->logadmin_model->create($data);
        } else {
            echo "You must not hack";

        }
    }

    function refundi2b()
    {
        $this->data['temp'] = 'admin/transaction/refundi2b';
        $this->load->view('admin/main', $this->data);
    }

    function refundi2bajax()
    {
        $admin_login = $this->session->userdata('user_id_login');
        $admin_info = $this->admin_model->get_info($admin_login);
        $token = urlencode($this->input->post("token"));
        $datainfo = $this->get_data_curl('http://123.31.29.147:18081/i2b?error_code=00&token=' . $token);
        if (isset($datainfo)) {
            $data = array(
                'account_name' => $admin_info->UserName,
                'username' => $admin_info->FullName,
                'action' => "Update giao dịch ngân lượng"
            );
            $this->logadmin_model->create($data);
            echo $datainfo;
        } else {
            echo "You must not hack";
        }
    }

    function ratioagent()
    {
        $this->data['temp'] = 'admin/transaction/ratioagent';
        $this->load->view('admin/main', $this->data);
    }

    function ratioagentajax()
    {
        $datainfo = $this->get_data_curl($this->config->item('api_backend2') . '?c=156');
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "You must not hack";
        }
    }

    function ratioajax()
    {
        $nickname = urlencode($this->input->post("nickname"));
        $ratio = urlencode($this->input->post("ratio"));
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=157&nn=' . $nickname . '&per=' . $ratio);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "You must not hack";
        }
    }

//    function logchuyendoivinngoc()
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
//        $this->data['temp'] = 'admin/transaction/logchuyendoivinngoc';
//        $this->load->view('admin/main', $this->data);
//    }

//    function logchuyendoivinngocajax()
//    {
//
//        $toDate = $this->input->post("toDate");
//        $fromDate = $this->input->post("fromDate");
//        $nickname = urlencode($this->input->post("nickname"));
//        $pages = $this->input->post("pages");
//        $mid = $this->input->post("mid");
//        $tid = urlencode($this->input->post("tid"));
//        $tno = urlencode($this->input->post("tno"));
//        $type = $this->input->post("type");
//        $code = $this->input->post("code");
//        $datainfo = $this->get_data_curl($this->config->item('api_backend2') . '?c=29&ts=' . urlencode($toDate) . '&te=' . urlencode($fromDate) . '&p=' . $pages . '&mid=' . $mid . '&tid=' . $tid . '&tno=' . $tno . '&type=' . $type . '&co=' . $code . '&nn=' . $nickname);
//        if (isset($datainfo)) {
//            echo $datainfo;
//        } else {
//            echo "You must not hack";
//        }
//
//    }

    function topdoanhso()
    {
        canMenu('transaction/topdoanhso');
        $this->data['temp'] = 'admin/transaction/topdoanhso';
        $this->load->view('admin/main', $this->data);
    }

    function topdoanhsoajax()
    {
        $timestart = $this->input->post('timestart');
        $timeend = $this->input->post('timeend');
        $month = $this->input->post('month');
        $optinfo = $this->curl->simple_get($this->config->item('api_backend2') . '?c=110&nn=' . '&ts=' . urlencode($timestart) . '&te=' . urlencode($timeend) . '&month=' . urlencode($month));
        if ($optinfo) {
            echo $optinfo;
        } else {
            echo "1001";
        }

    }


}