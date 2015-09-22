<?php
class Mumug extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function mu_list($where='', $order='', $limit='', $param=array()) {
        $query = "SELECT * FROM mumug";
        $query .= (!empty($where))? " WHERE ". $where : '';
        $query .= (!empty($order))? " ORDER BY ".$order : '';
        $query .= (!empty($limit))? " LIMIT ".$limit['start'].", ".$limit['cnt'] : '';
        $result = $this->db->query($query, $param)->result_array();
        return $result;
    }

    function mu_cnt($where='') {
        $query = "SELECT count(*) as cnt FROM mumug";
        $query .= (!empty($where))? " WHERE ". $where : '';
        $result = $this->db->query($query)->result_array();
        return $result[0]['cnt'];
    }

    function mu_insert($param) {
        $result = $this->db->insert('mumug', $param);
        return $result;
    }

    function mu_comment($where='', $param=array()) {
        $query = "SELECT * FROM mumug";
        $query .= (!empty($where))? " WHERE ". $where : '';
        $result = $this->db->query($query, $param)->result_array();
        return $result;
    }
}
?>
