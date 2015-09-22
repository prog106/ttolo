<?php
class Adform extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('Adinfo', 'adinfo');
        $this->load->helper('url');
    }
    function index() {
        $common['title'] = "AD for U";
        $this->load->view('_head', $common);

        $data['lists'] = $this->adinfo->ad_list($where='', $order=' id DESC');
        $this->load->view('adlist', $data);

        $this->load->view('_footer', $common);
    }
    function add() {
        $common['title'] = "AD add";
        $this->load->view('_head', $common);

        $this->load->view('adform');

        $this->load->view('_footer', $common);
    }
    function edit() {
        $common['title'] = "AD add";
        $this->load->view('_head', $common);

        $id = $this->input->get('id');
        if(empty($id)) {
            redirect('/adform/add');
            exit();
        }

        $where = (!empty($id))? " id = ".$id : '';
        $result = (!empty($where))? $this->adinfo->ad_list($where) : array();
        $data['row'] = (!empty($result))? $result[0] : array();
        $this->load->view('adform_edit', $data);

        $this->load->view('_footer', $common);
    }
    function adinsert() {
        $input_array = array('title', 'desc', 'startdate', 'enddate', 'money', 'img1', 'img2');
        foreach($input_array as $k) {
            $param['ad_'.$k] = $this->input->post($k);
        }

        $result = $this->adinfo->ad_insert($param);
        $msg = ($result)? "Insert Success!" : "Insert False! Retry!";
        echo json_encode($msg);
    }
    function admodify() {
        $param['id'] = $this->input->post('id');
        $input_array = array('title', 'desc', 'startdate', 'enddate', 'money', 'img1', 'img2');
        foreach($input_array as $k) {
            $param['ad_'.$k] = $this->input->post($k);
        }
        $result = $this->adinfo->ad_modify($param);
        $msg = ($result)? "Modify Success!" : "Modify False! Retry!";
        echo json_encode($msg);
    }
}
?>
