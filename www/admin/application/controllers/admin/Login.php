<?php

Class Login extends MY_controller
{
    function index()
    {

        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        if ($this->input->post()) {
            $this->form_validation->set_rules('login', 'login', 'callback_check_login');
            $user = $this->_get_user_info();
            $this->session->set_userdata('user_admintransfer_login', $user->ID);
        }
        $this->load->view('admin/login/index');
    }

    private function _get_user_info()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $password = md5($password);
        $this->load->model('admin_model');
        $where = array('UserName' => $username, 'Password' => $password);
        $user = $this->admin_model->get_info_rule($where);
        return $user;
    }

    function infouser($nickname, $accessToken)
    {
        $this->load->model('admin_model');
        $where = array('FullName' => $nickname);
        $user = $this->admin_model->get_info_rule($where);

        if ($user == false) {
            $this->session->set_flashdata('message', 'Account has not been authorized');
            return false;
        } else {
            $this->session->set_userdata('user_id_login', $user->ID);
            $this->session->set_userdata('user_name_login', $user->UserName);
            $this->session->set_userdata('nick_name_login', $nickname);
            $this->session->set_userdata('accessToken', array($accessToken, $nickname));
            $userPermission = $this->userPermission($user);
            $this->session->set_userdata('user_menu', $userPermission);
        }
        return true;
    }

    function loginajax(){
        $username = $this->input->post('username');
        $password =  $this->input->post('password');
        $datainfo = $this->curl->simple_get($this->config->item('api_url2').'?c=701&un='.$username.'&pw=' . $password);
        $data = json_decode($datainfo);
        if($data->success == true){
            $this->log_login_admin($username,"Success",0);
            $dataObj = json_decode(base64_decode($data->sessionKey));
            $nickname = $dataObj -> nickname;
            $this->session->set_userdata('nicknameadmin', $nickname);
            $this->session->set_userdata('isMobileSecure', $dataObj->mobileSecure);
            if ($dataObj->mobileSecure == 0) {
                if($this->infouser($nickname) == true){
                    $data->inforuser = 1;
                    $this->log_login_admin($username,"Login",0);
                }else{
                    $data->inforuser = 2;
                    $this->log_login_admin($username,"Account has not been authorized",1);
                }
                $datainfo = json_encode($data);
            }
        }else{
            if($data->errorCode == 1001){
                $this->log_login_admin($username,"System interruption",1);
            }
            if($data->errorCode == 1005){
                $this->log_login_admin($username,"Username does not exist",1);
            }
            if($data->errorCode == 1007){
                $this->log_login_admin($username,"Password is incorrect",1);
            }
            if($data->errorCode == 1109){
                $this->log_login_admin($username,"Account is locked from logging in",1);
            }
            if($data->errorCode == 1114){
                $this->log_login_admin($username,"Maintenance system",1);
            }
            if($data->errorCode == 2001){
                $this->log_login_admin($username,"Account has not updated nickname",1);
            }
            if($data->errorCode == 1012){
                $this->log_login_admin($username,"Account log in with OTP",1);
            }
        }
        if(isset($datainfo)) {
            echo $datainfo;
        }else{
            echo "You must not hack";
        }
    }

    function loginODP()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $odpinfo = $this->get_data_curl($this->config->item('api_backend') . '?c=701&un=' . $username . '&pw=' . $password);
        $data = json_decode($odpinfo);
        if (isset($data)) {
            if ($data->success == true) {
                $dataObj = json_decode(base64_decode($data->sessionKey));
                $nickname = $dataObj -> nickname;
                $this->session->set_userdata('nicknameadmin', $nickname);
                $this->session->set_userdata('isMobileSecure', $dataObj->mobileSecure);
				//print_r(json_decode(base64_decode($data->sessionKey)));
                $access = $data->accessToken;
				
                if ($this->infouser($nickname, $access) == true) {
                    $this->log_login_admin($username, "Success", 0);
					//echo 'day';
					//return;
                    echo json_encode("1");
                } else {
                    $this->log_login_admin($username, "Account has not been authorized", 1);
                    echo json_encode("2");
                }

            } else {
                if ($data->errorCode == 1001) {
                    $this->log_login_admin($username, "System interruption", 1);
                    echo json_encode("3");
                }
                if ($data->errorCode == 1005) {
                    $this->log_login_admin($username, "Username does not exist", 1);
                    echo json_encode("4");
                }
                if ($data->errorCode == 1007) {
                    $this->log_login_admin($username, "Password is incorrect", 1);
                    echo json_encode("5");
                }
                if ($data->errorCode == 1109) {
                    $this->log_login_admin($username, "Account is locked from logging in", 1);
                    echo json_encode("6");
                }
                if ($data->errorCode == 1114) {
                    $this->log_login_admin($username, "Maintenance system", 1);
                    echo json_encode("7");
                }
                if ($data->errorCode == 2001) {
                    $this->log_login_admin($username, "Account has not updated nickname", 1);
                    echo json_encode("8");
                }
                if ($data->errorCode == 1012) {
                    $this->log_login_admin($username, "Account log in with OTP", 1);
                    echo json_encode("9");
                }

            }
        }


    }

    function log_login_admin($username, $action, $status)
    {
        $this->load->model('admin_model');
        $this->load->model('log_loginadmin_model');
        $where = array('UserName' => $username);
        $user = $this->admin_model->get_info_rule($where);
        if ($user == true) {
            $username = $user->UserName;
            $nickname = $user->FullName;
        } else {
            $nickname = "";
        }
        $data = array(
            'username' => $username,
            'nickname' => $nickname,
            'ip' => $this->get_client_ip(),
            'status' => $status,
            'agent' => $_SERVER['HTTP_USER_AGENT'],
            'action' => $action,
            'tool' => "Admin"

        );
        $this->log_loginadmin_model->create($data);

    }

    function userPermission($user)
    {
        $this->load->model('userrole_model');
        $userPermission = $this->userrole_model->get_permission_by($user->ID);
        if ($userPermission) {
            return array_column($userPermission, "Link");
        }
        return [];
    }
}