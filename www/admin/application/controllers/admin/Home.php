<?php
Class Home extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $this->lang->load('admin/home');
        $this->data['temp'] = 'admin/home/index';
        $this->load->view('admin/main', $this->data);
    }

    function getDashboardStatisticsAjax(){
        $dateOption = $this->input->post('dateOption');
        $today = date('Y-m-d');
        switch ($dateOption) {
            case "yesterday":
                $start_time = date('Y-m-d', strtotime('-1 day', strtotime($today)));
                $end_time = $start_time;
                break;
            case "previousWeek":
                $start_time = date('Y-m-d', strtotime("monday -2 week"));
                $end_time = date('Y-m-d', strtotime("sunday -1 week"));
                break;
            case "previousMonth":
                $month_ini = new DateTime("first day of last month");
                $month_end = new DateTime("last day of last month");
                $start_time = $month_ini->format('Y-m-d');;
                $end_time = $month_end->format('Y-m-d');
                break;
            default:
                $start_time = $today;
                $end_time = $today;
                break;
        }
        $rechargeParams = [
            'c' => 9102,
            'ts' => $start_time,
            'te' => $end_time,
        ];
        $start_time1=date('d-m-Y',strtotime($start_time));
        $end_time1=date('d-m-Y',strtotime($end_time));
        $charging = $this->get_data_curl($this->config->item('api_backend') . '?c=7&ts='.$start_time1.'&te='.$end_time1);
        $userRegister = file_get_contents($this->config->item('api_backend2').'?c=142&ts='.urlencode($start_time.' 00:00:00').'&te='.urlencode($end_time. '23:59:00'));
        $ccu = $this->get_data_curl($this->config->item('api_backend2').'?c=108&ts='.$start_time.' 00:00:00&te='.$end_time.' 23:59:00');
        $userRecharge = $this->get_data_curl($this->config->item('api_backend2') . '?' . http_build_query($rechargeParams));

//        $vinplay=$this->load->database("vinplay",TRUE);
        $newCCU = new stdClass();
        $newCCU->web=0;
        $newCCU->android=0;
        $newCCU->ios=0;
        $newCCU->total=0;
        $ccu=json_decode($ccu);
        if ($ccu&&$ccu->transactions){
            foreach ($ccu->transactions as $item){
                $newCCU->web=$newCCU->web+$item->web;
                $newCCU->web=$newCCU->android+$item->android;
                $newCCU->ios=$newCCU->android+$item->ios;
                $newCCU->total=$newCCU->total+$item->web+$item->android+$item->ios+$item->ad+$item->wp+$item->fb+$item->dt+$item->ot+$item->ts;
            }
        }
        if (isset($charging)) {
            $charging=json_decode($charging);
            $charging->register=json_decode($userRegister);
            $charging->ccu=$newCCU;
            $charging->userRecharge=$userRecharge;
            echo json_encode($charging);
        } else {
            echo "You must not hack";
        }
    }
}