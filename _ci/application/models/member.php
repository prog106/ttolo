<?php
class Member extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function ad_list($where='', $order='', $limit='') {
        $query = "SELECT * FROM ad";
        $query .= (!empty($where))? " WHERE ". $where : '';
        $query .= (!empty($order))? " ORDER BY ".$order : '';
        $query .= (!empty($limit))? " LIMIT ".$limit['start'].", ".$limit['cnt'] : '';
        $result = $this->db->query($query)->result_array();
        return $result;
    }

    function signin($param) {
        //$result = $this->db->insert('baba', $param);
        $result = 1;
        return $result;
    }

    function ad_modify($param) {
        $this->db->where('id', $param['id']);
        unset($param['id']);
        $result = $this->db->update('ad', $param);
        return $result;
    }
}
?>
