<?php

Class Mail extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        //$this->load->model('eventgiftcode_model');
        //      fix error load library name
        $this->load->library('CSVReader');
    }

    /*
     * Lay danh sach admin
     */
    function index()
    {
        canMenu('mail');
        $this->data['temp'] = 'admin/mail/index';
        $this->load->view('admin/main', $this->data);
    }

    function indexajax()
    {
        canMenu('mail');
        $nickname = $this->input->post("nickname");
        $pages = $this->input->post("pages");
        $datainfo = $this->get_data_curl($this->config->item('api_backend2') . '?c=402&nn=' . $nickname . '&p=' . $pages);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "You must not hack";
        }
    }


    function sendmail()
    {
        canMenu('mail/sendmail');
        $this->data['temp'] = 'admin/mail/sendmail';
        $this->load->view('admin/main', $this->data);
    }

    function sendmailajax()
    {
        canMenu('mail/sendmail');
        $nickname = urlencode($this->input->post("nickname"));
        $title = urlencode($this->input->post("title"));
        $content = urlencode(html_entity_decode($this->input->post("content")));
        $datainfo = file_get_contents($this->config->item('api_backend') . '?c=401&nn=' . $nickname . '&tm=' . $title . '&cm=' . $content);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "You must not hack";
        }
    }

	//    function sendmailgc()
	//    {
	//        canMenu('mail/sendmailgc');
	//        $this->data['error'] = "";
	//        if ($this->input->post("ok")) {
	//            if (file_exists('public/admin/uploads/marketinggc.csv')) {
	//                unlink('public/admin/uploads/marketinggc.csv');
	//                $this->data['error'] = "Bạn xóa file cũ thành công";
	//            } else {
	//                $temp = explode(".", $_FILES["filexls"]["name"]);
	//                $extension = end($temp);
	//                if ($extension == "csv") {
	//                    $config = array("");
	//                    $config['upload_path'] = './public/admin/uploads';
	//                    $config['allowed_types'] = '*';
	//                    $config['max_size'] = 1024 * 8;
	//                    $config['overwrite'] = TRUE;
	//                    $config['file_name'] = 'marketinggc';
	//                    $this->load->library('upload', $config);
	//                    $this->upload->initialize($config);
	//
	//                    if (!$this->upload->do_upload('filexls')) {
	//                        $error = array('error' => $this->upload->display_errors());
	//                        $this->data['error'] = "Bạn chưa chọn file hoặc không được phân quyền";
	//
	//                    } else {
	//                        $this->data['error'] = "";
	//                        $data = array('upload_data' => $this->upload->data());
	//
	//                        $this->data['error'] = "Upload file thành công";
	//                    }
	//                } else {
	//                    $this->data['error'] = "Bạn chưa chọn file hoặc không chọn đúng file csv";
	//                }
	//            }
	//
	//        }
	//        if (file_exists(FCPATH . "public/admin/uploads/marketinggc.csv") != false) {
	//            $this->load->library('csvreader');
	//            $result = $this->csvreader->parse_file(public_url('admin/uploads/marketinggc.csv'));
	//            $listnn = array();
	//            $listgc = array();
	//            foreach ($result as $row) {
	//                if (isset($row["Nickname"])) {
	//                    array_push($listnn, $row["Nickname"]);
	//                }
	//
	//                if (isset($row["Giftcode"])) {
	//                    array_push($listgc, $row["Giftcode"]);
	//                }
	//            }
	//            $this->data['listnn'] = implode(',', $listnn);
	//            $this->data['listgc'] = implode(',', $listgc);
	//        } else {
	//            $this->data['listnn'] = "";
	//            $this->data['listgc'] = "";
	//        }
	//        $this->data['temp'] = 'admin/mail/sendmailgc';
	//        $this->load->view('admin/main', $this->data);
	//    }
	//
	//    function sendmailgcajax()
	//    {
	//        canMenu('mail/sendmailgc');
	//        $nickname = urlencode($this->input->post("nickname"));
	//        $giftcode = urlencode($this->input->post("giftcode"));
	//        $datainfo = $this->curl->simple_get($this->config->item('api_backend') ."?c=111&nn=".$nickname."&gc=".$giftcode."&type=1&gp=".'');
	//        if(isset($datainfo)) {
	//            echo $datainfo;
	//        }else{
	//            echo "You must not hack";
	//        }
	//
	//
	//    }

	//    function sendmailgctrian()
	//    {
	//        canMenu('mail/sendmailgctrian');
	//        $this->data['error'] = "";
	//        if ($this->input->post("ok")) {
	//            if (file_exists('public/admin/uploads/marketinggctrian.csv')) {
	//                unlink('public/admin/uploads/marketinggctrian.csv');
	//                $this->data['error'] = "Bạn xóa file cũ thành công";
	//            } else {
	//                $temp = explode(".", $_FILES["filexls"]["name"]);
	//                $extension = end($temp);
	//                if ($extension == "csv") {
	//                    $config = array("");
	//                    $config['upload_path'] = './public/admin/uploads';
	//                    $config['allowed_types'] = '*';
	//                    $config['max_size'] = 1024 * 8;
	//                    $config['overwrite'] = TRUE;
	//                    $config['file_name'] = 'marketinggctrian';
	//                    $this->load->library('upload', $config);
	//                    $this->upload->initialize($config);
	//
	//                    if (!$this->upload->do_upload('filexls')) {
	//                        $error = array('error' => $this->upload->display_errors());
	//                        $this->data['error'] = "Bạn chưa chọn file hoặc không được phân quyền";
	//
	//                    } else {
	//                        $this->data['error'] = "";
	//                        $data = array('upload_data' => $this->upload->data());
	//
	//                        $this->data['error'] = "Upload file thành công";
	//                    }
	//                } else {
	//                    $this->data['error'] = "Bạn chưa chọn file hoặc không chọn đúng file csv";
	//                }
	//            }
	//
	//        }
	//        if (file_exists(FCPATH . "public/admin/uploads/marketinggctrian.csv") != false) {
	//            $this->load->library('csvreader');
	//            $result = $this->csvreader->parse_file(public_url('admin/uploads/marketinggctrian.csv'));
	//            $listnn = array();
	//            $listgc = array();
	//            foreach ($result as $row) {
	//                if (isset($row["Nickname"])) {
	//                    array_push($listnn, $row["Nickname"]);
	//                }
	//
	//                if (isset($row["Giftcode"])) {
	//                    array_push($listgc, $row["Giftcode"]);
	//                }
	//            }
	//            $this->data['listnn'] = implode(',', $listnn);
	//            $this->data['listgc'] = implode(',', $listgc);
	//        } else {
	//            $this->data['listnn'] = "";
	//            $this->data['listgc'] = "";
	//        }
	//        $this->data['temp'] = 'admin/mail/sendmailgctrian';
	//        $this->load->view('admin/main', $this->data);
	//    }
	//
	//    function sendmailgctrianajax()
	//    {
	//        canMenu('mail/sendmailgctrian');
	//        $nickname = urlencode($this->input->post("nickname"));
	//        $giftcode = urlencode($this->input->post("giftcode"));
	//        $money = $this->input->post("money");
	//        $ch = curl_init();
	//        curl_setopt($ch, CURLOPT_URL,$this->config->item('api_backend'));
	//        curl_setopt($ch, CURLOPT_POST, 1);
	//        curl_setopt($ch, CURLOPT_POSTFIELDS,"c=111&nn=".$nickname."&gc=".$giftcode."&type=2&gp=".$money);
	//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	//        curl_setopt($ch,CURLOPT_TIMEOUT,3600);
	//        $server_output = curl_exec ($ch);
	//        if(isset($server_output)) {
	//            echo $server_output;
	//        }else{
	//            echo "You must not hack";
	//        }
	//        curl_close ($ch);
	//
	//    }

    function upload()
    {
        if (file_exists(FCPATH . "public/admin/uploads/marketinggc.csv") != false) {
            $this->load->library('csvreader');
            $result = $this->csvreader->parse_file(public_url('admin/uploads/marketinggc.csv'));
            $listnn = array();
            $listgc = array();
            $list = array();
            foreach ($result as $row) {
                if ($row["NickName"]) {
                    array_push($listnn, $row["NickName"]);
                }

                if ($row["GiftCode"]) {
                    array_push($listgc, $row["GiftCode"]);
                }
            }
            $this->data['listnn'] = implode(',', $listnn);
            $this->data['listgc'] = implode(',', $listgc);
            echo json_encode(array(array("er" => 0), array("nn" => implode(',', $listnn)), array("gc" => implode(',', $listgc))));
        } else {
            echo json_encode(array(array("er" => 1)));
        }
    }

    function messageagent()
    {
        canMenu('mail/messageagent');
        $this->data['temp'] = 'admin/mail/messageagent';
        $this->load->view('admin/main', $this->data);
    }

    function getmobiledaily()
    {
        $datainfo = $this->get_data_curl($this->config->item('api_backend2') . '?c=104&un=' . "" . '&nn=' . "" . '&m=' . "" . '&fd=' . "" . '&srt=' . "" . '&ts=' . "" . '&te=' . "" . '&dl=1&p=1&tr=50&bt=0');
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "You must not hack";
        }
    }

    function messageagentajax()
    {
        canMenu('mail/messageagent');
        $mobile = urlencode($this->input->post("mobile"));
        $content = $this->input->post("content");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=718&m=' . $mobile . '&ct=' . urlencode($content));
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "You must not hack";
        }
    }

	//    function sendmessagegc()
	//    {
	//        canMenu('mail/sendmessagegc');
	//        $this->data['error'] = "";
	//        if ($this->input->post("ok")) {
	//            if (file_exists('public/admin/uploads/messagegc.csv')) {
	//                unlink('public/admin/uploads/messagegc.csv');
	//                $this->data['error'] = "Bạn xóa file cũ thành công";
	//            } else {
	//                $temp = explode(".", $_FILES["filexls"]["name"]);
	//                $extension = end($temp);
	//                if ($extension == "csv") {
	//                    $config = array("");
	//                    $config['upload_path'] = './public/admin/uploads';
	//                    $config['allowed_types'] = '*';
	//                    $config['max_size'] = 1024 * 8;
	//                    $config['overwrite'] = TRUE;
	//                    $config['file_name'] = 'messagegc';
	//                    $this->load->library('upload', $config);
	//                    $this->upload->initialize($config);
	//
	//                    if (!$this->upload->do_upload('filexls')) {
	//                        $error = array('error' => $this->upload->display_errors());
	//                        $this->data['error'] = "Bạn chưa chọn file hoặc không được phân quyền";
	//
	//                    } else {
	//                        $this->data['error'] = "";
	//                        $data = array('upload_data' => $this->upload->data());
	//
	//                        $this->data['error'] = "Upload file thành công";
	//                    }
	//                } else {
	//                    $this->data['error'] = "Bạn chưa chọn file hoặc không chọn đúng file csv";
	//                }
	//            }
	//
	//        }
	//        if (file_exists(FCPATH . "public/admin/uploads/messagegc.csv") != false) {
	//            $this->load->library('csvreader');
	//            $result = $this->csvreader->parse_file(public_url('admin/uploads/messagegc.csv'));
	//            $listsdt = array();
	//            $listgc = array();
	//            foreach ($result as $row) {
	//                if (isset($row["Sdt"])) {
	//                    if (substr($row["Sdt"], 0, 2) == "84") {
	//                        array_push($listsdt, "0" . substr($row["Sdt"], 2, 14));
	//                    } else if (substr($row["Sdt"], 0, 1) != "0") {
	//                        array_push($listsdt, "0" . substr($row["Sdt"], 0, 14));
	//                    } else if (substr($row["Sdt"], 0, 1) == "0") {
	//                        array_push($listsdt, $row["Sdt"]);
	//                    }
	//                }
	//
	//
	//                if (isset($row["Giftcode"])) {
	//                    array_push($listgc, $row["Giftcode"]);
	//                }
	//            }
	//            $this->data['listsdt'] = implode(',', $listsdt);
	//            $this->data['listgc'] = implode(',', $listgc);
	//        } else {
	//            $this->data['listsdt'] = "";
	//            $this->data['listgc'] = "";
	//        }
	//        $this->data['temp'] = 'admin/mail/sendmessagegc';
	//        $this->load->view('admin/main', $this->data);
	//    }
	//
	//    function sendmessagegcajax()
	//    {
	//        canMenu('mail/sendmessagegc');
	//        $mobile = $this->input->post("mobile");
	//        $content = urlencode($this->input->post("content"));
	//        $giftcode = $this->input->post("giftcode");
	//        $ch = curl_init();
	//        curl_setopt($ch, CURLOPT_URL,$this->config->item('api_backend'));
	//        curl_setopt($ch, CURLOPT_POST, 1);
	//        curl_setopt($ch, CURLOPT_POSTFIELDS,"c=11&m=".$mobile."&gc=".$giftcode."&ct=".$content);
	//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	//        curl_setopt($ch,CURLOPT_TIMEOUT,3600);
	//        $server_output = curl_exec ($ch);
	//
	//        if(isset($server_output)) {
	//            echo $server_output;
	//        }else{
	//            echo "You must not hack";
	//        }
	//        curl_close ($ch);
	//
	//    }

    function uploadgc()
    {
        if (file_exists(FCPATH . "public/admin/uploads/messagegc.csv") != false) {
            $this->load->library('csvreader');
            $result = $this->csvreader->parse_file(public_url('admin/uploads/messagegc.csv'));
            $listsdt = array();
            $listgc = array();
            $list = array();
            foreach ($result as $row) {
                if ($row["Sdt"]) {
                    if (substr($row["Sdt"], 0, 2) == "84") {
                        array_push($listsdt, "0" . substr($row["Sdt"], 2, 14));
                    } else if (substr($row["Sdt"], 0, 1) != "0") {
                        array_push($listsdt, "0" . substr($row["Sdt"], 0, 14));
                    } else if (substr($row["Sdt"], 0, 1) == "0") {
                        array_push($listsdt, $row["Sdt"]);
                    }
                }

                if ($row["Giftcode"]) {
                    array_push($listgc, $row["Giftcode"]);
                }
            }
            echo json_encode(array(array("er" => 0), array("sdt" => implode(',', $listsdt)), array("gc" => implode(',', $listgc))));
        } else {
            echo json_encode(array(array("er" => 1)));
        }
    }

    function blockchat()
    {
        canMenu('mail/blockchat');
        $this->data['temp'] = 'admin/mail/blockchat';
        $this->load->view('admin/main', $this->data);
    }

    function blockchatajax()
    {
        canMenu('mail/blockchat');
        $nickname = urlencode($this->input->post("nickname"));
        $time = urlencode($this->input->post("time"));
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=1993&nn=' . $nickname . '&t=' . $time);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "You must not hack";
        }
    }

	//    function sendmailfull()
		//    {
		//        canMenu('mail/sendmailfull');
		//        $this->data['error'] = "";
		//        if ($this->input->post("ok")) {
		//            if (file_exists('public/admin/uploads/marketinggcfull.csv')) {
		//                unlink('public/admin/uploads/marketinggcfull.csv');
		//                $this->data['error'] = "Bạn xóa file cũ thành công";
		//            } else {
		//                $temp = explode(".", $_FILES["filexls"]["name"]);
		//                $extension = end($temp);
		//                if ($extension == "csv") {
		//                    $config = array("");
		//                    $config['upload_path'] = './public/admin/uploads';
		//                    $config['allowed_types'] = '*';
		//                    $config['max_size'] = 1024 * 8;
		//                    $config['overwrite'] = TRUE;
		//                    $config['file_name'] = 'marketinggcfull';
		//                    $this->load->library('upload', $config);
		//                    $this->upload->initialize($config);
		//
		//                    if (!$this->upload->do_upload('filexls')) {
		//                        $error = array('error' => $this->upload->display_errors());
		//                        $this->data['error'] = "Bạn chưa chọn file hoặc không được phân quyền";
		//
		//                    } else {
		//                        $this->data['error'] = "";
		//                        $data = array('upload_data' => $this->upload->data());
		//
		//                        $this->data['error'] = "Upload file thành công";
		//                    }
		//                } else {
		//                    $this->data['error'] = "Bạn chưa chọn file hoặc không chọn đúng file csv";
		//                }
		//            }
		//
		//        }
		//        if (file_exists(FCPATH . "public/admin/uploads/marketinggcfull.csv") != false) {
		//            $this->load->library('csvreader');
		//            $result = $this->csvreader->parse_file(public_url('admin/uploads/marketinggcfull.csv'));
		//            $listnn = array();
		//            $listgc = array();
		//            foreach ($result as $row) {
		//                if (isset($row["Nickname"])) {
		//                    array_push($listnn, $row["Nickname"]);
		//                }
		//
		//                if (isset($row["Giftcode"])) {
		//                    array_push($listgc, $row["Giftcode"]);
		//                }
		//            }
		//            $this->data['listnn'] = implode(',', $listnn);
		//
		//            $this->data['listgc'] = implode(',', $listgc);
		//
		//        } else {
		//            $this->data['listnn'] = "";
		//            $this->data['listgc'] = "";
		//        }
		//        $this->data['temp'] = 'admin/mail/sendmailfull';
		//        $this->load->view('admin/main', $this->data);
		//    }
		//
		//    function sendmailfullajax()
		//    {
		//        canMenu('mail/sendmailfull');
		//        $nickname = $this->input->post("nickname");
		//        $title = urlencode($this->input->post("title"));
		//        $content = urlencode($this->input->post("content"));
		//        $giftcode = $this->input->post("giftcode");
		//        $ch = curl_init();
		//        curl_setopt($ch, CURLOPT_URL,$this->config->item('api_backend'));
		//        curl_setopt($ch, CURLOPT_POST, 1);
		//        curl_setopt($ch, CURLOPT_POSTFIELDS,"c=136&nn=".$nickname."&gc=".$giftcode."&cm=".$content."&tm=".$title);
		//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		//        curl_setopt($ch,CURLOPT_TIMEOUT,3600);
		//
		//        $server_output = curl_exec ($ch);
		//
		//        if(isset($server_output)) {
		//            echo $server_output;
		//        }else{
		//            echo "You must not hack";
		//        }
		//        curl_close ($ch);
		//
		//    }

    function delmail()
    {

        $mid = $this->input->post("mid");
        $datainfo = $this->get_data_curl($this->config->item('api_backend') . '?c=406&mid=' . $mid);
        if (isset($datainfo)) {
            echo $datainfo;
        } else {
            echo "You must not hack";
        }
    }

	//    function sendmailvincard()
	//    {
	//        $this->data['error'] = "";
	//        if ($this->input->post("ok")) {
	//            if (file_exists('public/admin/uploads/marketingvincard.csv')) {
	//                unlink('public/admin/uploads/marketingvincard.csv');
	//                $this->data['error'] = "Bạn xóa file cũ thành công";
	//            } else {
	//                $temp = explode(".", $_FILES["filexls"]["name"]);
	//                $extension = end($temp);
	//                if ($extension == "csv") {
	//                    $config = array("");
	//                    $config['upload_path'] = './public/admin/uploads';
	//                    $config['allowed_types'] = '*';
	//                    $config['max_size'] = 1024 * 8;
	//                    $config['overwrite'] = TRUE;
	//                    $config['file_name'] = 'marketingvincard';
	//                    $this->load->library('upload', $config);
	//                    $this->upload->initialize($config);
	//
	//                    if (!$this->upload->do_upload('filexls')) {
	//                        $error = array('error' => $this->upload->display_errors());
	//                        $this->data['error'] = "Bạn chưa chọn file hoặc không được phân quyền";
	//
	//                    } else {
	//                        $this->data['error'] = "";
	//                        $data = array('upload_data' => $this->upload->data());
	//
	//                        $this->data['error'] = "Upload file thành công";
	//                    }
	//                } else {
	//                    $this->data['error'] = "Bạn chưa chọn file hoặc không chọn đúng file csv";
	//                }
	//            }
	//
	//        }
	//        if (file_exists(FCPATH . "public/admin/uploads/marketingvincard.csv") != false) {
	//            $this->load->library('csvreader');
	//            $result = $this->csvreader->parse_file(public_url('admin/uploads/marketingvincard.csv'));
	//            $listnn = array();
	//            $listsr = array();
	//            $listpin = array();
	//            foreach ($result as $row) {
	//                if (isset($row["Nickname"])) {
	//                    array_push($listnn, $row["Nickname"]);
	//                }
	//
	//                if (isset($row["Seri"])) {
	//                    array_push($listsr, $row["Seri"]);
	//                }
	//                if (isset($row["Pin"])) {
	//                    array_push($listpin, trim($row["Pin"]));
	//                }
	//            }
	//            $this->data['listnn'] = implode(',', $listnn);
	//
	//            $this->data['listsr'] = implode(',', $listsr);
	//            $this->data['listpin'] = implode(',', $listpin);
	//
	//        } else {
	//            $this->data['listnn'] = "";
	//            $this->data['listsr'] = "";
	//            $this->data['listpin'] = "";
	//        }
	//        $this->data['temp'] = 'admin/mail/sendmailvincard';
	//        $this->load->view('admin/main', $this->data);
	//    }
	//
	//    function sendmailvincardajax()
	//    {
	//        $nickname = $this->input->post("nickname");
	//        $title = urlencode($this->input->post("title"));
	//        $content = urlencode($this->input->post("content"));
	//        $seri = urlencode($this->input->post("seri"));
	//        $pin = urlencode($this->input->post("pin"));
	//        $server_output = $this->get_data_curl($this->config->item('api_backend')."?c=607&nn=".$nickname."&sr=".$seri."&pn=".$pin."&cm=".$content."&tm=".$title);
	//        $data = json_decode($server_output);
	//        if(isset($server_output)) {
	//            if ($data->errorCode == 0) {
	//                if (file_exists('public/admin/uploads/marketingvincard.csv')) {
	//                    unlink('public/admin/uploads/marketingvincard.csv');
	//                }
	//            }
	//            echo $server_output;
	//        }else{
	//            echo "You must not hack";
	//        }
	//
	//    }
}