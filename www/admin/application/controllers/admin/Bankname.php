<?php

Class Bankname extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function userbot()
    {
        canMenu('bankname/userbot');
        $this->data['temp'] = 'admin/bankname/index';
        $this->load->view('admin/main', $this->data);
    }

    function indexajax()
    {
        $bankName = urlencode($this->input->post("bankName"));
        $bankCode = urlencode($this->input->post("bankCode"));
        $pages = urlencode($this->input->post("pages"));
        $size = urlencode($this->input->post("size"));

        $datainfo = $this->get_data_curl($this->config->item('api_backend')
            . "?c=8820&bn=$bankName&bc=$bankCode&pn=$pages&l=$size");

        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }

    function save_ajax() {
        $approvedName = $this->session->userdata('nick_name_login');
        $id = urlencode($this->input->post("id"));
        $bankName = urlencode($this->input->post("bankName"));
        $bankCode = urlencode($this->input->post("bankCode"));
        $logo = urlencode($this->input->post("logo"));
        $status = urlencode($this->input->post("status"));
        $type = urlencode($this->input->post("type"));

        $datainfo = $this->get_data_curl($this->config->item('api_backend')
            . "?c=8819&id=$id&nn=$approvedName&bn=$bankName&bc=$bankCode&lg=$logo"
            . "&st=$status&ty=$type");
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }

    }


    function delete_ajax() {
        $id = urlencode($this->input->post("id"));

        $datainfo = $this->get_data_curl($this->config->item('api_backend'). "?c=8821&id=$id");

        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "Bạn không được hack";
        }
    }


}