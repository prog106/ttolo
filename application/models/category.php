<?php
class Category extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->table = "ttolo_category";
    }

    function getCategory($param) {
        $query = "SELECT * FROM ".$this->table;
        $parent_id = ($param['parent_id'])? $param['parent_id'] : '0';
        $depth = ($param['depth'])? $param['depth'] : '1';

        $query .= " WHERE parent_id = ? AND depth = ? ";
        $prm = array($parent_id, $depth);

        if($param['live'] == 'live') {
            $query .= " AND NOW() BETWEEN live_start AND live_end AND status = 'Y'";
        }

        if($param['live'] == 'none') {
            $query .= " AND (live_start > NOW() OR live_end < NOW()) AND status = 'N'";
        }

        $query .= " ORDER BY id DESC";
        $result = $this->db->query($query, $prm);
        return $result->result_array();
    }

    function saveCategory($param) {
        $result = $this->db->insert($this->table, $param);
        return $result;
    }

    function updateCategory($param, $srl) {
        $result = $this->db->where('id', $srl)->update($this->table, $param);
        return $result;
    }

}
?>
