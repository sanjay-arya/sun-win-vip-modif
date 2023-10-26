<?php

Class Withdraw extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('logadmin_model');
        $this->load->model('actionadmin_model');
        $this->load->library('paginationlib');
    }

    function userbot()
    {
        canMenu('withdraw/userbot');
        $datainfo = $this->get_data_curl($this->config->item('api_backend'). "?c=8820&l=100&pn=0");

        if (isset($datainfo)) {
            $data_decode = json_decode($datainfo);
            $this->data['banklist'] = array_map(function($x){
                return ($x->bank_name);
            }, $data_decode->data);
        } else {
            echo "Không có danh sách ngân hàng";
        }

        $this->data['temp'] = 'admin/withdraw/index';
        $this->load->view('admin/main', $this->data);
    }

    function cskh()
    {
        canMenu('withdraw/cskh');
        $datainfo = $this->get_data_curl($this->config->item('api_backend'). "?c=8820&l=100&pn=0");

        if (isset($datainfo)) {
            $data_decode = json_decode($datainfo);
            $this->data['banklist'] = array_map(function($x){
                return ($x->bank_name);
            }, $data_decode->data);
        } else {
            echo "Không có danh sách ngân hàng";
        }

        $this->data['temp'] = 'admin/withdraw/cskh';
        $this->load->view('admin/main', $this->data);
    }

    function indexajax()
    {
        $nickName = urlencode($this->input->post("nickName"));
        $nhaCungCap = urlencode($this->input->post("nhaCungCap"));
        $orderId = urlencode($this->input->post("orderId"));
        $transactionId = urlencode($this->input->post("transactionId"));
        $fromTime = urlencode($this->input->post("fromTime"));
        $endTime = urlencode($this->input->post("endTime"));
        $status = urlencode($this->input->post("status"));
        $pages = urlencode($this->input->post("pages"));
        $bankAccountName = urlencode($this->input->post("bankAccountName"));
        $bankAccountNumber = urlencode($this->input->post("bankAccountNumber"));
        $bankCode = urlencode($this->input->post("bankName"));
        $size = urlencode($this->input->post("size"));
        $fromAmount = urlencode($this->input->post("fromAmount"));
        $toAmount = urlencode($this->input->post("toAmount"));

        $datainfo = $this->get_data_curl($this->config->item('api_backend')
            . "?c=9200&nn=$nickName&pn=$nhaCungCap&oi=$orderId&ti=$transactionId&ft=$fromTime&et=$endTime&st=$status&pg=$pages&mi=$size&bc=$bankCode&ba=$bankAccountName&bn=$bankAccountNumber&fa=$fromAmount&ta=$toAmount");

        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "You must not hack";
        }
    }

    function reject_ajax()
    {
        $approvedName = $this->session->userdata('user_name_login');

        $orderId = urlencode($this->input->post("orderId"));
        $reason = urlencode($this->input->post("reason"));

        $datainfo = $this->get_data_curl($this->config->item('api_backend')
            . "?c=8814&nns=$approvedName&oid=$orderId&reason=$reason");

        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "You must not hack";
        }
    }

    function list_provider_support_ajax()
    {
        $approvedName = $this->session->userdata('user_name_login');

        $orderId = urlencode($this->input->post("orderId"));

        $datainfo = $this->get_data_curl($this->config->item('api_backend')
            . "?c=8812&nns=$approvedName&oid=$orderId");

        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "You must not hack";
        }
    }

    function accept_ajax()
    {
        $approvedName = $this->session->userdata('user_name_login');

        $providerName = urlencode($this->input->post("providerName"));
        $orderId = urlencode($this->input->post("orderId"));
        $nickName = urlencode($this->input->post("nickName"));

        $datainfo = $this->get_data_curl($this->config->item('api_backend')
            . "?c=8813&nns=$approvedName&nn=$nickName&oid=$orderId&pn=$providerName&ip=" . $this->getIPAddress());

        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "You must not hack";
        }
    }

    function getIPAddress()
    {
        //whether ip is from the share internet
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } //whether ip is from the proxy
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } //whether ip is from the remote address
        else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    function updateStatusWithdraw()
    {
        canMenu('withdraw/cskh');
        $params = [
            'c' => 9432,
            'nns' => $this->input->post("nn"),
            'oid' => $this->input->post("oid"),
            'st' => $this->input->post("st"),
            'rs' => $this->input->post("rs"),
            'ip' => $this->input->ip_address(),
        ];
        $endPoint = $this->config->item('api_backend') . "?" . http_build_query($params);
        try {
            $data = $this->get_data_curl($endPoint);
            $result = json_decode($data, true);
            if ($result == null) {
                echo json_encode(['success' => true]);
                return;
            }
            if (!empty($result['success']) && $result['success']) {
                echo json_encode(['success' => true]);
                return;
            }
            echo json_encode(['success' => false]);
            return;
        } catch (\Exception $e) {
            log_message('error', 'Caught exception alertUserAgentCodeAjax : ' . $e->getMessage());
            return;
        }
    }
}