<?php
class Dental extends CI_Model {
    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function md_list() {
        $query = "SELECT * FROM dental ORDER BY md_id DESC";
        $result = $this->db->query($query)->result_array();
        return $result;
    }

    function _ad_insert($param) {
        $result = $this->db->insert('ad', $param);
        return $result;
    }

    function _ad_modify($param) {
        $this->db->where('id', $param['id']);
        unset($param['id']);
        $result = $this->db->update('ad', $param);
        return $result;
    }
}
?>
