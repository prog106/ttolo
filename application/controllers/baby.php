<?php
class Baby extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('adinfo', 'adinfo');
        $this->load->model('mumug', 'mumug');
        $this->load->helper('url');
    }
    function index() {
        $this->load->helper('common');

        $page = ($this->input->get('pgno'))? : 1;
        $per = 20;
        $start = ($page-1) * $per;
        $data['comments'] = $this->mumug->mu_list(' mu_viewyn="y"', 'mu_id desc', array('start' => $start, 'cnt' => $per));
        $cnt = $this->mumug->mu_cnt(' mu_viewyn="y"');
        $data['calendar'] = calendar();
        $data['paging'] = page($cnt, $per, $page);
        $common['title'] = "Macham";
        $this->load->view('baby/_head', $common);

        $this->load->view('baby/main', $data);

        $this->load->view('baby/_footer', $common);
    }
    function commentinsert() {
        $input_array = array('title', 'comment', 'eater', 'imagesrc');
        foreach($input_array as $k) {
            $param['mu_'.$k] = $this->input->post($k);
        }

        $checktoken = md5('prog106'.$this->input->post('timestamp'));
        $path = '/home/prog106/ci/static/';
        if(!empty($param['mu_imagesrc'])) {
            if($this->input->post('token') == $checktoken) {
                $or = $path.'uploadready/'.$param['mu_imagesrc'];
                $mv = $path.'upload/'.$param['mu_imagesrc'];
                $command = "mv ".$or." ".$mv;
                shell_exec($command);
            } else {
                unlink($path.'uploadready/'.$param['mu_imagesrc']);
                unset($param['mu_imagesrc']);
            }
        }

        $param['mu_create_date'] = date('Y-m-d H:i:s');

        $result = $this->mumug->mu_insert($param);
        $msg = ($result)? "Comment Success!" : "Comment False! Retry!";
        echo json_encode($msg);
    }
    function viewcomment() {
        $where = " mu_id = ? AND mu_viewyn = 'y'";
        $srl = $this->input->post('srl');
        if(empty($srl)) die;
        $param[] = $srl;
        $lists = $this->mumug->mu_comment($where, $param);
        $data['row'] = $lists[0];
        $this->load->view('baby/view', $data);
    }
    function viewmore() {
        $this->load->helper('common');

        $page = $this->input->post('moreno');
        if(empty($page)) die;
        $start = $page * 10;
        $data['comments'] = $this->mumug->mu_list('', 'mu_id desc', array('start' => $start, 'cnt' => 10));
        $this->load->view('baby/more', $data);
    }
    function calendars() {
        $month = $this->input->post('month');
        $this->load->helper('common');
        echo calendar($month);
    }
}
?>
