<?php

Class Deposit extends MY_Controller
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
        canMenu('deposit/userbot');
        $datainfo = $this->get_data_curl($this->config->item('api_backend'). "?c=8820&l=100&pn=0");

        if (isset($datainfo)) {
            $data_decode = json_decode($datainfo);
            $this->data['banklist'] = array_map(function($x){
                return ($x->bank_name);
            }, $data_decode->data);
        } else {
            echo "No bank list";
        }

        $this->data['temp'] = 'admin/deposit/index';
        $this->load->view('admin/main', $this->data);
    }

    function userBotApproveAjax()
    {
        canMenu('deposit/userbot');
        $params = [
            'c' => 8809,
            'nn' => $this->input->post("nn"),
            'nns' => $this->session->userdata('nick_name_login'),
            'oid' => $this->input->post("oid"),
            'st' => $this->input->post("st"),
            'rs' => $this->input->post("rs"),
            'ip' => $this->input->ip_address(),
        ];
        $endPoint = $this->config->item('api_backend') . "?" . http_build_query($params);
        try {
            $data = $this->get_data_curl($endPoint);
            echo empty($data) ? "" : $data;
            return;
        } catch (\Exception $e) {
            log_message('error', 'Caught exception getListAjax : ' . $e->getMessage());
            return;
        }
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
            . "?c=9201&nn=$nickName&pn=$nhaCungCap&oi=$orderId&ti=$transactionId&ft=$fromTime&et=$endTime&st=$status&pg=$pages&mi=$size&bc=$bankCode&ba=$bankAccountName&bn=$bankAccountNumber&fa=$fromAmount&ta=$toAmount");

        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "You must not hack";
        }
    }

}