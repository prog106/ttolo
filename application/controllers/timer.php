<?php
class Timer extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->helper('cookie');
        $this->isUseLayout = false; // 템플릿 미사용시 false , defalut : true;
    }
    public function index() {
        $this->load->view('timer/index');
    }

}
?>
