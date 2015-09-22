<?php
class Pc extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->library('encrypt');
        $this->load->helper('cookie');
        $this->isUseLayout = false; // 템플릿 미사용시 false , defalut : true;
        $this->bgimg = array(
            array('http://i.imgur.com/GxFLWycl.jpg', '500'),
            array('http://i.imgur.com/SQl9icql.jpg', '500'),
            array('http://i.imgur.com/VHvH6PE.jpg', '500'),
        );
        $this->isttolo = $this->input->cookie('isttolo');
        $this->load->view('pc/head');
    }
    public function index() {
        $data['bgimg'] = $this->bgimg;
        $this->load->view('pc/index', $data);
        $this->load->view('pc/footer');
    }

    public function contact() {
        $this->load->view('pc/contact');
        $this->load->view('pc/footer');
    }
}
?>
