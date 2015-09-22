<?php
class Moneys extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function moneySave($param) {
        $result = $this->db->insert('jeongchongmu', $param);
        return $result;
    }

    function getMoneySum($prm) {
        $query = "SELECT SUM(if(plusminus = '+', money, 0)) as pmoney, SUM(IF(plusminus = '-', money, 0)) as mmoney FROM jeongchongmu WHERE cate = ? AND status = 'Y'";
        $param = $prm['cate'];
        $result = $this->db->query($query, $param)->result_array();
        return $result[0];
    }

    function getMoneyList($prm) {
        $query = "SELECT * FROM jeongchongmu WHERE cate = ? AND status = 'Y' ORDER BY srl DESC";
        $param = $prm['cate'];
        $result = $this->db->query($query, $param)->result_array();
        return $result;
    }

    function moneyDel($param, $srl) {
        $result = $this->db->where('srl', $srl)->update('jeongchongmu', $param);
        return $result;
    }

}
?>
