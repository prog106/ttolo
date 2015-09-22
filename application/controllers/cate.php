<?php
class Cate extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('category', 'model');
        $this->load->helper('url');
        $this->isUseLayout = false;
    }

    function index() {
        $param['parent_id'] = 0;
        $param['depth'] = '1';
        $param['live'] = '';
        $rows = $this->model->getCategory($param);
        $data['rows'] = $rows;
        $this->load->view('category/index', $data);
    }

    function getCate() {
        $param['parent_id'] = $this->input->post('parent_id');
        $param['depth'] = $this->input->post('depth');
        $param['live'] = '';
        $rows = $this->model->getCategory($param);
        $return = array();
        foreach($rows as $k => $v) {
            $return[] = array($v['id'], $v['cat_name']);
        }
        echo json_encode($return);
    }
}
?>
