<?php
class Ttolo extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function lt_usersave($param) {
        $result = $this->db->insert('ttolouser', $param);
        return $result;
    }
    function lt_savelist($prm) {
        $query = "SELECT * FROM savelotto WHERE user = ? AND status = 'Y' ORDER BY srl DESC";
        $param = $prm['user'];
        $result = $this->db->query($query, $param)->result_array();
        return $result;
    }

    function lt_checklist($prm) {
        $query = "SELECT * FROM savelotto WHERE user = ? AND lotto = ? AND status = 'Y' ORDER BY srl DESC";
        $param[] = $prm['user'];
        $param[] = $prm['lotto'];
        $result = $this->db->query($query, $param)->result_array();
        return $result;
    }

    function ltins($param) {
        $result = $this->db->insert('lotto', $param);
        return $result;
    }

    function lt_save($param) {
        $result = $this->db->insert('savelotto', $param);
        return $result;
    }

    function lt_del($param, $srl) {
        $result = $this->db->where('srl', $srl)->update('savelotto', $param);
        return $result;
    }

    function lt_list($param=array()) {
        $query = "SELECT * FROM lotto ORDER BY srl ASC";
        if($param) {
            $query = "SELECT * FROM lotto WHERE srl = ?";
        }
        $result = $this->db->query($query,$param)->result_array();
        foreach($result as $k => $v) {
            $return[] = array($v['lotto1'], $v['lotto2'], $v['lotto3'], $v['lotto4'], $v['lotto5'], $v['lotto6'], $v['lotto7'], $v['srl']);
        }
        return $return;
    }
}
?>
