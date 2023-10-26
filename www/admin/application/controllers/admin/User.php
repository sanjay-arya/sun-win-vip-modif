<?php

Class User extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('logadmin_model');
        $this->load->model('admin_model');
        $this->load->model('groupuser_model');
        $this->load->model('DBvinplay_Users_model');
        $this->load->model('userrole_model');
        $this->load->model('menurole_model');
        $this->load->model('accesslink_model');


    }

    function changePassword()
    {
        //lay id cua quan tri vien can chinh sua
        $this->load->library('form_validation');
        $this->load->helper('form');
        //lay thong cua quan trị viên
        $id = $this->session->userdata('user_id_login');
        $info = $this->admin_model->get_info($id);
        if (!$info) {
            $response = [
                "success" => false,
                "errorCode" => -1,
                "message" => 'Administrator does not exist'
            ];
            echo json_encode($response);
        } else {
            $this->data['info'] = $info;
            if ($this->input->post()) {
                $oldPasswordInDB = $this->admin_model->getPasswordById($id);
                $username_dbvinplay_admin = $this->admin_model->getUserNameById($id);
                $oldPassword = md5($this->input->post('inputOldPassUser'));
                $newPassword = md5($this->input->post('inputNewPassUser'));
                $retypePassword = md5($this->input->post('inputRetypePassUser'));

                if($newPassword != $retypePassword){
                    $response = [
                        "success" => false,
                        "errorCode" => -1,
                        "message" => 'Nhập lại mật khẩu chưa trùng khớp'
                    ];
                    echo json_encode($response);
                } else{
                    if ($oldPasswordInDB == $oldPassword){
                        // data1 insert vào bằng user trong DB vinplay_admin
                        $data1 = array(
                            'Password' => $newPassword
                        );
                        // data2 insert vào bằng users trong DB vinplay
                        $data2 = array(
                            'password' => $newPassword
                        );
                        $username_dbvinplay = $username_dbvinplay_admin;
                        if ($this->DBvinplay_Users_model->updateByUsername($username_dbvinplay, $data2)
                            && $this->admin_model->update($id, $data1)) {
                            //tạo ra nội dung thông báo
                            $response = [
                                "success" => true,
                                "message" => 'Change Password thành công'
                            ];
                            echo json_encode($response);
                        } else {
                            $response = [
                                "success" => false,
                                "errorCode" => -1,
                                "message" => 'Unable to update'
                            ];
                            echo json_encode($response);
                        }
                    }else{
                        $response = [
                            "success" => false,
                            "errorCode" => -1,
                            "message" => 'Nhập lại mật khẩu, mật khẩu cũ chưa đúng'
                        ];
                        echo json_encode($response);
                    }
                }
            }
        }

    }


    function index()
    {
        $this->data['temp'] = 'admin/user/index';
        $this->load->view('admin/main', $this->data);
    }
    function congtrutien()
    {
        $this->data['temp'] = 'admin/user/congtrutien';
        $this->load->view('admin/main', $this->data);
    }
    function congtienajax(){
        $otpselectcong = $this->input->post("otpselectcong");
        $tienchuyen = $this->input->post("tienchuyen");
        $money_type = $this->input->post("money_type");
        $reasonchuyen = $this->input->post("reasonchuyen");
        $maotpcong = $this->input->post("maotpcong");
        $nickname = $this->input->post("nickname");
        $action = $this->input->post("actionname");
        $admin_nickname = $this->session->userdata('nick_name_login');

        $datainfo = $this->file_get_contents($this->config->item('api_backend') . '?c=100&nn=' . $nickname .
            '&mn=' . $tienchuyen .'&mt=' . $money_type. '&rs=' . urlencode($reasonchuyen). '&otp=' . $maotpcong . '&type=' .
            $otpselectcong.'&ac='.$action.'&nns='.$admin_nickname);
		
        $data = json_decode($datainfo);
        if (isset($data->success)) {
            if ($data->success == true) {
                if ($data->errorCode == 0) {
                    echo json_encode("1");
                     if($action == "Admin") {
                         $this->logadmin_model->create($this->logadmingiftcode(12, $nickname, $admin_nickname,"",$tienchuyen,$money_type));
                     } elseif($action == "EventVP"){
                        $this->logadmin_model->create($this->logadmingiftcode(19, $nickname, $admin_nickname,"",$tienchuyen,$money_type));
                    }
                }
            } else {
                if ($data->errorCode == 1001) {
                    echo json_encode("2");
                }elseif($data->errorCode == 1002) {
                    echo json_encode("3");
                }elseif($data->errorCode == 1008) {
                    echo json_encode("4");
                }elseif($data->errorCode == 1021) {
                    echo json_encode("5");
                }elseif($data->errorCode == 2001) {
                    echo json_encode("6");
                }
            }
        }else{
            echo "You must not hack";
        }
    }
    function trutienajax(){
//        $admin_login = $this->session->userdata('user_admintransfer_login');
//        $admin_info = $this->admin_model->get_info($admin_login);
        $otpselecttru = $this->input->post("otpselecttru");
        $tienchuyen = $this->input->post("tienchuyen");
        $money_type = $this->input->post("money_type");
        $reasonchuyen = $this->input->post("reasonchuyen");
        $maotptru = $this->input->post("maotptru");
        $nickname = $this->input->post("nickname");
		$action = $this->input->post("actionname");
		$admin_nickname = $this->session->userdata('nick_name_login');
        $datainfo = $this->file_get_contents($this->config->item('api_backend') . '?c=100&nn=' . $nickname . '&mn=' . $tienchuyen .'&mt=' . $money_type. '&rs=' . urlencode($reasonchuyen) . '&otp=' . $maotptru . '&type=' . $otpselecttru.'&ac='.$action.'&nns='.$admin_nickname);
        $data = json_decode($datainfo);
        if (isset($data->success)) {
            if ($data->success == true) {
                if ($data->errorCode == 0) {
                    echo json_encode("1");
                     if($action == "Admin") {
                         $this->logadmin_model->create($this->logadmingiftcode(12, $nickname, $admin_nickname,"",$tienchuyen,$money_type));
                     } elseif($action == "EventVP"){
                        $this->logadmin_model->create($this->logadmingiftcode(19, $nickname, $admin_nickname,"",$tienchuyen,$money_type));
                    }
                }
            } else {
                if ($data->errorCode == 1001) {
                    echo json_encode("2");
                }elseif($data->errorCode == 1002) {
                    echo json_encode("3");
                }elseif($data->errorCode == 1008) {
                    echo json_encode("4");
                }elseif($data->errorCode == 1021) {
                    echo json_encode("5");
                }elseif($data->errorCode == 2001) {
                    echo json_encode("6");
                }
            }
        }else{
            echo "You must not hack";
        }
    }

function getnicknameajax(){
        $nickname = urlencode($this->input->post("nickname"));
        $datainfo = $this->file_get_contents($this->config->item('api_backend') . '?c=716&nn=' . $nickname);
        if(isset($datainfo)) {
            echo $datainfo;
        }else{
            echo "You must not hack";
        }
    }
    /*
     * Ham chinh sua thong tin quan tri vien
     */


    function logout()
    {
        if ($this->session->userdata('user_admintransfer_login')) {
            $this->session->unset_userdata('user_admintransfer_login');
        }
        redirect(base_url('login'));
    }
	 function resetpw(){
        $this->data['temp'] = 'admin/user/resetpw';
        $this->load->view('admin/main', $this->data);
    }
    function resetpwajax(){
        $admin_login = $this->session->userdata('user_admintransfer_login');
        $admin_info = $this->admin_model->get_info($admin_login);
        $nickname = urlencode($this->input->post("nickname"));
        $type = $this->input->post("type");
        $otp = urlencode($this->input->post("otp"));
        $datainfo = $this->file_get_contents($this->config->item('api_url').'?c=14&nn='.$nickname.'&otp='.$otp.'&type='.$type.'&ad='.$admin_info->FullName);
        if(isset($datainfo)) {
            if($datainfo == 0){
                $data = array(
                    'account_name' => $nickname,
                    'username' => $admin_info->UserName,
                    'action' => "Reset password"
                );
                $this->logadmin_model->create($data);
            }
            echo $datainfo;
        }else{
            echo "You must not hack";
        }
    }
    function updatevpevent(){
        $this->data['temp'] = 'admin/user/updatevpevent';
        $this->load->view('admin/main', $this->data);
    }
    function updatevpajax(){
        $admin_login = $this->session->userdata('user_admintransfer_login');
        $admin_info = $this->admin_model->get_info($admin_login);
        $nickname = urlencode($this->input->post("nickname"));
        $type = $this->input->post("type");
        $value = urlencode($this->input->post("value"));
        $otp = urlencode($this->input->post("otp"));
        $typeotp = $this->input->post("typeotp");
        $datainfo = $this->file_get_contents($this->config->item('api_url').'?c=726&nn='.$nickname.'&tu='.$type.'&va='.$value.'&otp='.$otp.'&type='.$typeotp.'&ad='.$admin_info->FullName);
        if(isset($datainfo)) {
            $datainfo = intval($datainfo);
            if($datainfo == 0){
                if($type == 0){
                    $data = array(
                        'account_name' => $nickname,
                        'username' => $admin_info->UserName,
                        'action' => "Trừ vippoint event",
                        'money' => -$value
                    );
                }else{
                    $data = array(
                        'account_name' => $nickname,
                        'username' => $admin_info->UserName,
                        'action' => "Add vippoint event",
                        'money' => $value
                    );
                }

                $this->logadmin_model->create($data);
            }
            echo $datainfo;
        }else{
            echo "You must not hack";
        }
    }
	  function refundbonus(){
		   date_default_timezone_set('Asia/Yangon');
        $start_time = null;
        if ($start_time === null) {
            $start_time = date('d-m-Y');
        }
        $this->data['start_time'] = $start_time;
        $this->data['temp'] = 'admin/agent/index';
        $this->load->view('admin/main', $this->data);
    }

    function refundajax(){
        $admin_login = $this->session->userdata('user_admintransfer_login');
        $admin_info = $this->admin_model->get_info($admin_login);
        $otp = urlencode($this->input->post("otp"));
        $type = $this->input->post("type");
          $te = $this->input->post("te");
        $datainfo = $this->file_get_contents($this->config->item('api_url') . '?c=711&otp=' . $otp . '&type=' . $type.'&te='.$te.'&ad='.$admin_info->FullName);
        if(isset($datainfo)) {
            if($datainfo == 0){
            $data = array(
                'username' => $admin_info->UserName,
                'action' => "Refund of agent fees"
            );
            $this->logadmin_model->create($data);}
            echo $datainfo;
        }else{
            echo "You must not hack";
        }
    }
    function bonusajax(){
        $admin_login = $this->session->userdata('user_admintransfer_login');
        $admin_info = $this->admin_model->get_info($admin_login);
        $otp = urlencode($this->input->post("otp"));
        $type = $this->input->post("type");
        $datainfo = $this->file_get_contents($this->config->item('api_url').'?c=724&otp='.$otp.'&type='.$type.'&ad='.$admin_info->FullName);
        if(isset($datainfo)) {
            if($datainfo == 0){
                $data = array(
                    'username' => $admin_info->UserName,
                    'action' => "Trả thưởng top doanh số đại lý"
                );
                $this->logadmin_model->create($data);}
            echo $datainfo;
        }else{
            echo "You must not hack";
        }
    }
	
	  function reportgc(){
        $datainfo = json_decode($this->file_get_contents($this->config->item('api') . '?c=10'));
        $this->data['listvin'] = $datainfo->giftcode_vin;
        $this->data['listxu'] = $datainfo->giftcode_xu;
        $source = $this->sourcegiftcode_model->get_source_gift_code_marketing_view();
        $this->data['source'] = $source;
        $sourcevh = $this->sourcegiftcode_model->get_source_gift_code_vanhanh_view();
        $this->data['sourcevh'] = $sourcevh;
        $list = $this->useragent_model->get_admin_gift_code();
        $this->data['list'] = $list;
        $this->data['temp'] = 'admin/user/reportgc';
        $this->load->view('admin/main', $this->data);
    }

    function reportgcajax()
    {
        $roomvin = $this->input->post("roomvin");
        $roomxu = $this->input->post("roomxu");
        $nguonxuat = $this->input->post("nguonxuat");
        $fromDate = urlencode($this->input->post("fromDate"));
        $toDate = urlencode($this->input->post("toDate"));
        $money = $this->input->post("money");
        $filterdate = $this->input->post("filterdate");
        if($money == 1){
            $datainfo = $this->get_data_curl($this->config->item('api_url').'?c=304&gp='.$roomvin.'&ts=' . $fromDate . '&te=' . $toDate . '&mt=' . $money .'&gs=' .$nguonxuat .'&type=&tt='.$filterdate.'&bl=');
			
        }
        elseif($money == 0){
            $datainfo = $this->get_data_curl($this->config->item('api_url').'?c=304&gp='.$roomxu.'&ts=' . $fromDate . '&te=' . $toDate . '&mt=' . $money .'&gs=' .$nguonxuat .'&type=&tt='.$filterdate.'&bl=');
        }
        if(isset($datainfo)) {
            echo $datainfo;
        }else{
            echo "You must not hack";
        }
    }

        function reportgcmktajax(){
            $roomvin = $this->input->post("roomvin");
            $roomxu = $this->input->post("roomxu");
            $nguonxuat = $this->input->post("nguonxuat");
            $fromDate = urlencode($this->input->post("fromDate"));
            $toDate = urlencode($this->input->post("toDate"));
            $money = $this->input->post("money");
             $filterdate = $this->input->post("filterdate");
            if($money == 1){
                $datainfo = $this->get_data_curl($this->config->item('api_url').'?c=304&gp='.$roomvin.'&ts=' . $fromDate . '&te=' . $toDate . '&mt=' . $money .'&gs=' .$nguonxuat .'&type=2&tt='.$filterdate.'&bl=');
            }
            elseif($money == 0){
                $datainfo = $this->get_data_curl($this->config->item('api_url').'?c=304&gp='.$roomxu.'&ts=' . $fromDate . '&te=' . $toDate . '&mt=' . $money .'&gs=' .$nguonxuat .'&type=2&tt='.$filterdate.'&bl=');
            }
            if(isset($datainfo)) {
                echo $datainfo;
            }else{
                echo "You must not hack";
            }
        }

    function reportgcvhajax(){
        $roomvin = $this->input->post("roomvin");
        $roomxu = $this->input->post("roomxu");
        $nguonxuat = $this->input->post("nguonxuat");
        $fromDate = urlencode($this->input->post("fromDate"));
        $toDate = urlencode($this->input->post("toDate"));
        $money = $this->input->post("money");
        $filterdate = $this->input->post("filterdate");
        if($money == 1){
            $datainfo = $this->get_data_curl($this->config->item('api_url').'?c=304&gp='.$roomvin.'&ts=' . $fromDate . '&te=' . $toDate . '&mt=' . $money .'&gs=' .$nguonxuat .'&type=3&tt='.$filterdate.'&bl=');
        }
        elseif($money == 0){
            $datainfo = $this->get_data_curl($this->config->item('api_url').'?c=304&gp='.$roomxu.'&ts=' . $fromDate . '&te=' . $toDate . '&mt=' . $money .'&gs=' .$nguonxuat .'&type=3&tt='.$filterdate.'&bl=');
        }
        if(isset($datainfo)) {
            echo $datainfo;
        }else{
            echo "You must not hack";
        }
    }
    function reportgcdlajax(){
        $roomvin = $this->input->post("roomvin");
        $roomxu = $this->input->post("roomxu");
        $nguonxuat = $this->input->post("nguonxuat");
        $fromDate = urlencode($this->input->post("fromDate"));
        $toDate = urlencode($this->input->post("toDate"));
        $money = $this->input->post("money");
        $filterdate = $this->input->post("filterdate");
        if($money == 1){
            $datainfo = $this->get_data_curl($this->config->item('api_url').'?c=304&gp='.$roomvin.'&ts=' . $fromDate . '&te=' . $toDate . '&mt=' . $money .'&gs=' .$nguonxuat .'&type=1&tt='.$filterdate.'&bl=');
        }
        elseif($money == 0){
            $datainfo = $this->get_data_curl($this->config->item('api_url').'?c=304&gp='.$roomxu.'&ts=' . $fromDate . '&te=' . $toDate . '&mt=' . $money .'&gs=' .$nguonxuat .'&type=1&tt='.$filterdate.'&bl=');
        }
        if(isset($datainfo)) {
            echo $datainfo;
        }else{
            echo "You must not hack";
        }
    }
	
	 function delgiftcode()
    {
        $datainfo = json_decode($this->file_get_contents($this->config->item('api') . '?c=10'));
        $this->data['listvin'] = $datainfo->giftcode_vin;
        $source = $this->sourcegiftcode_model->get_source_gift_code_marketing_view();
        $this->data['source'] = $source;
        $sourcevh = $this->sourcegiftcode_model->get_source_gift_code_vanhanh_view();
        $this->data['sourcevh'] = $sourcevh;
        $this->data['temp'] = 'admin/user/delgiftcode';
        $this->load->view('admin/main', $this->data);
    }

    function delgiftcodeajax()
    {
        $admin_login = $this->session->userdata('user_admintransfer_login');
        $admin_info = $this->admin_model->get_info($admin_login);
        $fromdate = urlencode($this->input->post("fromdate"));
        $todate = urlencode($this->input->post("todate"));
        $source = urlencode($this->input->post("nguonxuat"));
        $price = urlencode($this->input->post("roomvin"));

        $datainfo = $this->get_data_curl($this->config->item('api_url').'?c=604&gp='.$price.'&ts=' . $fromdate . '&te=' . $todate .'&gs=' .$source);
        $data = json_decode($datainfo);
        $num = $data->transactions->countGiftCode;
        if(isset($datainfo)) {
           if( $num > 0){
                if($source == "" && $price == ""){
                    $action = "Thu hồi giftcode được tạo từ ngày ".$this->input->post("fromdate")." đến ngày ".$this->input->post("todate")." số lượng: ".$num;
                }else if($source == "" && $price != ""){
                    $action = "Thu hồi giftcode được tạo từ ngày ".$this->input->post("fromdate")." đến ngày ".$this->input->post("todate")." số lượng: ".$num." mệnh giá ".$price." K Vin";
                }
                else if($source != "" && $price == ""){
                    $action = "Thu hồi giftcode được tạo từ ngày ".$this->input->post("fromdate")." đến ngày ".$this->input->post("todate")." số lượng: ".$num." mã ".$source;
                }
                else if($source != "" && $price != ""){
                    $action = "Thu hồi giftcode được tạo từ ngày ".$this->input->post("fromdate")." đến ngày ".$this->input->post("todate")." số lượng: ".$num." mệnh giá ".$price." K Vin , mã ".$source;
                }
               $data = array(
                   'username' => $admin_info->UserName,
                   'account_name' =>$admin_info->FullName,
                   'action' => $action
               );
               $this->logadmin_model->create($data);
           }
            echo $datainfo;
        }else{
            echo "You must not hack";
        }
    }
	
	 function congtientaixiu()
    {
        $this->data['error'] = "";
        if ($this->input->post("ok")) {
            if (file_exists('public/admin/uploads/congtientaixiu.csv')) {
                unlink('public/admin/uploads/congtientaixiu.csv');
                $this->data['error'] = "Bạn xóa file cũ thành công";
            } else {
                $temp = explode(".", $_FILES["filexls"]["name"]);
                $extension = end($temp);
                if ($extension == "csv") {
                    $config = array("");
                    $config['upload_path'] = './public/admin/uploads';
                    $config['allowed_types'] = '*';
                    $config['max_size'] = 1024 * 8;
                  //  $config['overwrite'] = TRUE;
                    $config['file_name'] = 'congtientaixiu';
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('filexls')) {
                        $error = array('error' => $this->upload->display_errors());
                        $this->data['error'] = "Bạn chưa chọn file hoặc không được phân quyền";

                    } else {
                        $this->data['error'] = "";
                        $data = array('upload_data' => $this->upload->data());

                        $this->data['error'] = "Upload file thành công";
                    }
                } else {
                    $this->data['error'] = "Bạn chưa chọn file hoặc không chọn đúng file csv";
                }
            }

        }
        if (file_exists(FCPATH . "public/admin/uploads/congtientaixiu.csv") != false) {
            $this->load->library('csvreader');
            $result = $this->csvreader->parse_file(public_url('admin/uploads/congtientaixiu.csv'));
            $data = array();
            foreach ($result as $row) {
                if (isset($row["Nickname"]) && isset($row["Money"])) {
                    array_push($data,array(trim($row["Nickname"])=> intval($row["Money"])));
                }
            }
            $this->data['listnn'] = json_encode($data);

        } else {
            $this->data['listnn'] = "";
        }
        $this->data['temp'] = 'admin/user/congtientaixiu';
        $this->load->view('admin/main', $this->data);
    }

    function congtientaixiuajax()
    {
        $admin_login = $this->session->userdata('user_admintransfer_login');
        $admin_info = $this->admin_model->get_info($admin_login);
        $nickname = $this->input->post("nickname");
        $lydo = urlencode($this->input->post("lydo"));
        $money = urlencode($this->input->post("money"));
        $otp = urlencode($this->input->post("otp"));
        $typeotp = $this->input->post("typeotp");
		  $action = $this->input->post("action");
//        $server_output = $this->file_get_contents($this->config->item('api_url')."?c=17&data=".$nickname."&mt=".$money."&rs=".$lydo."&otp=".$otp."&type=".$typeotp);
//        var_dump($server_output);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$this->config->item('api_url'));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,"c=17&data=".$nickname."&mt=".$money."&rs=".$lydo."&otp=".$otp."&type=".$typeotp."&ac=".$action."&ad=".$admin_info->FullName. $this->getAuthBackend());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch,CURLOPT_TIMEOUT,3600);
		
        $server_output = curl_exec ($ch);
		
        $data = json_decode($server_output);

        if(isset($server_output)) {

            if ($data->errorCode == 0) {
                if($action == "Admin"){
                    $this->logadmin_model->create($this->logadmingiftcode(20, $nickname, $admin_info->UserName,"",0,$money));
                }elseif($action == "EventVP"){
                    $this->logadmin_model->create($this->logadmingiftcode(19, $nickname, $admin_info->UserName,"",0,$money));
                }
				if (file_exists('public/admin/uploads/congtientaixiu.csv')) {
                    unlink('public/admin/uploads/congtientaixiu.csv');
                }
            }
            echo $server_output;
        }else{
            echo "You must not hack";
        }
       curl_close ($ch);

    }
	function delsecuser()
    {
        $this->data['temp'] = 'admin/user/delsecuser';
        $this->load->view('admin/main', $this->data);
    }
    function update2fa()
    {
        $this->data['temp'] = 'admin/user/update2fa';
        $this->load->view('admin/main', $this->data);
    }
    function getqrajax(){
        $username = $this->session->userdata("usernameadmin");

        $datainfo = $this->get_data_curl($this->config->item('api_url') . '?c=2000&un=' . urlencode($username));
        //echo "get qrajax";
        //print_r($datainfo);
        $data = json_decode($datainfo);
        echo $datainfo;
        
    }
    function updateotpajax(){
        $username = $this->session->userdata("usernameadmin");
        $sec = $this->input->post('sec');
        $otp = $this->input->post('otp');
        $act = $this->input->post('act');
        $datainfo = $this->get_data_curl($this->config->item('api_url') . '?c=2000&un=' . urlencode($username) . '&secret='.$sec .'&otp='.$otp . '&act=' . $act);
        $data = json_decode($datainfo);
        if(!isset($data)){
            return;
            
        }
        if($act == "rm" && isset($data->errorCode) && $data->errorCode == 0){
            $this->session->set_userdata('isAppSecure',0);
        }
        elseif($act != "rm" && $data->errorCode == 0){
            $this->session->set_userdata('isAppSecure',1);
        }
        echo $datainfo;
    }
    function  huybaomat(){
        $admin_login = $this->session->userdata('user_admintransfer_login');
        $admin_info = $this->admin_model->get_info($admin_login);
        $nickname = $this->input->post('nickname');
        $ac = $this->input->post('ac');
        $type = $this->input->post('type');
        $otp = $this->input->post('otp');
        $action = $this->input->post('action');
        $datainfo = $this->file_get_contents($this->config->item('api_url') . '?c=21&nn=' . urlencode($nickname) . '&otp=' . $otp . '&type=' . $type.'&ac='.$ac.'&tu='.$action.'&ad='.$admin_info->FullName);
        $data = json_decode($datainfo);
        if(isset($datainfo)) {

            if ($data->errorCode == 0) {
                if($ac == 4 && $action == 0){
                    $data = array(
                        'action' => "Cancel bảo mật điện thoại",
                        'account_name' => $nickname,
                        'username' => $admin_info->UserName
                    );

                }elseif($ac == 5 && $action == 0){
                    $data = array(
                        'action' => "Cancel bảo mật email",
                        'account_name' => $nickname,
                        'username' => $admin_info->UserName
                    );

                }elseif($ac == 5 && $action == 1){
                    $data = array(
                        'action' => "Đăng ký bảo mật email",
                        'account_name' => $nickname,
                        'username' => $admin_info->UserName
                    );

                }elseif($ac == 4 && $action == 1){
                    $data = array(
                        'action' => "Đăng ký bảo mật điện thoại",
                        'account_name' => $nickname,
                        'username' => $admin_info->UserName
                    );

                }
                $this->logadmin_model->create($data);
            }
            echo $datainfo;
        }else{
            echo "You must not hack";
        }
    }
	
	function congtruslot()
    {
        $this->data['temp'] = 'admin/user/congtruslot';
        $this->load->view('admin/main', $this->data);
    }

    function congtruslotajax(){
        $admin_login = $this->session->userdata('user_admintransfer_login');
        $admin_info = $this->admin_model->get_info($admin_login);
        $nickname = $this->input->post('nickname');
        $number = $this->input->post('number');
        $type = $this->input->post('type');
        $otp = $this->input->post('otp');
        $slot = $this->input->post('slot');
        $datainfo = $this->file_get_contents($this->config->item('api_url') . '?c=30&nn=' . urlencode($nickname) . '&otp=' . $otp . '&type=' . $type.'&va='.$number.'&gn='.$slot.'&ad='.$admin_info->FullName);
        $data = json_decode($datainfo);
        if(isset($datainfo)) {
            if ($data->errorCode == 0) {
               if($number > 0){
                    $data = array(
                        'action' => "Add ".$number."  lượt quay slot ".$slot,
                        'account_name' => $nickname,
                        'username' => $admin_info->UserName
                    );

                }else{
                   $data = array(
                       'action' => "Trừ ".(-$number)."  lượt quay slot ".$slot,
                       'account_name' => $nickname,
                       'username' => $admin_info->UserName
                   );
               }
                $this->logadmin_model->create($data);
            }
            echo $datainfo;
        }else{
            echo "You must not hack";
        }
    }
	
	function congtrutienbot()
    {
        $this->data['temp'] = 'admin/user/congtrutienbot';
        $this->load->view('admin/main', $this->data);
    }


    function congtrutienbotajax()
    {
        $admin_login = $this->session->userdata('user_admintransfer_login');
        $admin_info = $this->admin_model->get_info($admin_login);
        $tienchuyen = $this->input->post("tienchuyen");
        $otp = $this->input->post("otp");
        $nickname = $this->input->post("nickname");
        $type = $this->input->post("typeotp");
        $datainfo = $this->file_get_contents($this->config->item('api_url') . '?c=1994&nn=' . $nickname . '&mn=' . $tienchuyen . '&otp=' . $otp . '&type=' . $type . '&ad=' . $admin_info->FullName);
        $data = json_decode($datainfo);
        if(isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Transaction không hợp lệ";
        }
    }

    function file_get_contents($content){
        return file_get_contents($content);
    }

}
