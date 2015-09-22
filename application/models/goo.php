<?php
class Goo extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function goSave($param) {
        $result = $this->db->insert('gourl', $param);
        return $result;
    }

    function getList($prm) {
        $query = "SELECT * FROM gourl WHERE user = ? AND status = 'Y' ORDER BY chkdate DESC, srl DESC";
        $param = $prm['user'];
        $result = $this->db->query($query, $param)->result_array();
        return $result;
    }

    function nmJoin($prm) {
        $query = "SELECT srl FROM gouser WHERE user = ? ORDER BY srl DESC";
        $param = $prm['user'];
        $result = $this->db->query($query, $param)->result_array();
        return $result;
    }

    function nmSave($param) {
        $result = $this->db->insert('gouser', $param);
        return $result;
    }

    function urlSave($param) {
        $result = $this->db->insert('gourl', $param);
        return $result;
    }

    function urlDel($param, $srl) {
        $result = $this->db->where('srl', $srl)->update('gourl', $param);
        return $result;
    }

}
?>
