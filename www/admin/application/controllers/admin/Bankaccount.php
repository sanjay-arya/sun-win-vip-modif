<?php

Class Bankaccount extends MY_Controller
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
            echo "No bank list";
        }

        $this->data['temp'] = 'admin/bankaccount/index';
        $this->load->view('admin/main', $this->data);
    }

    function indexajax()
    {
        $nickName = urlencode($this->input->post("nickName"));
        $customerName = urlencode($this->input->post("customerName"));
        $bankName = urlencode($this->input->post("bankName"));
        $bankNumber = urlencode($this->input->post("bankNumber"));
        $pages = urlencode($this->input->post("pages"));
        $size = urlencode($this->input->post("size"));

        $datainfo = $this->get_data_curl($this->config->item('api_backend')
            . "?c=8802&nn=$nickName&cn=$customerName&bn=$bankName&bnum=$bankNumber&pn=$pages&l=$size");

        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "You must not hack";
        }
    }

    function cskh()
    {
        canMenu('bankaccount/cskh');
        $datainfo = $this->get_data_curl($this->config->item('api_backend'). "?c=8820&l=100&pn=0");

        if (isset($datainfo)) {
            $data_decode = json_decode($datainfo);
            $this->data['banklist'] = array_map(function($x){
                return ($x->bank_name);
            }, $data_decode->data);
        } else {
            echo "No bank list";
        }

        $this->data['temp'] = 'admin/bankaccount/cskh';
        $this->load->view('admin/main', $this->data);
    }

    function cskhajax()
    {
        $nickName = urlencode($this->input->post("nickName"));
        $customerName = urlencode($this->input->post("customerName"));
        $bankName = urlencode($this->input->post("bankName"));
        $bankNumber = urlencode($this->input->post("bankNumber"));
        $pages = urlencode($this->input->post("pages"));
        $size = urlencode($this->input->post("size"));

        $datainfo = $this->get_data_curl($this->config->item('api_backend')
            . "?c=8802&nn=$nickName&cn=$customerName&bn=$bankName&bnum=$bankNumber&pn=$pages&l=$size");

        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "You must not hack";
        }
    }

    function bank_list_ajax()
    {
        $datainfo = $this->get_data_curl($this->config->item('api_backend'). "?c=8815");
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "You must not hack";
        }
    }

    function save_ajax() {
        $inputId = urlencode($this->input->post("inputId"));
        $inputType = urlencode($this->input->post("inputType"));
        $inputNickName = urlencode($this->input->post("inputNickName"));
        $inputCustomerName = urlencode($this->input->post("inputCustomerName"));
        $inputBankNumber = urlencode($this->input->post("inputBankNumber"));
        $inputBankName = urlencode($this->input->post("inputBankName"));
        $inputBranchName = urlencode($this->input->post("inputBranchName"));
        $inputStatus = urlencode($this->input->post("inputStatus"));
        $approvedName = $this->session->userdata('user_name_login');

        $datainfo = $this->get_data_curl($this->config->item('api_backend')
            . "?c=8801&id=$inputId&t=$inputType&nn=$inputNickName"
            . "&cn=$inputCustomerName&bnum=$inputBankNumber&bn=$inputBankName&br=$inputBranchName&st=$inputStatus&ann=$approvedName");

        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "You must not hack";
        }

    }


    function delete_ajax() {
        $id = urlencode($this->input->post("id"));

        $datainfo = $this->get_data_curl($this->config->item('api_backend'). "?c=8803&id=$id");

        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "You must not hack";
        }
    }


}