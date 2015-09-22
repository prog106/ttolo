<?php
class Mysp extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('myspinfo', 'myspinfo');
        $this->load->helper('url');
    }
    function index() {
        $this->load->view('mysp/_head');
        $this->load->view('mysp/main');
        $this->load->view('mysp/_footer');
    }
    function layer() {
        $this->load->view('mysp/layer');
    }
}
?>
