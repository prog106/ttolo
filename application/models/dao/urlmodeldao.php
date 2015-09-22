<?php
class Urlmodeldao extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // name, pwd 조회
    function getUserInfo($params) {
        $sql = "SELECT * FROM urluser WHERE user = ? AND pwd = ?";
        $return = $this->db->query($sql, $params)->result_array();
        return (!empty($return))? $return[0]['user'] : null;
    }

    // 로그인 조회
    function getUserLoginInfo($params) {
        $sql = "SELECT * FROM urluser WHERE user = ?";
        $return = $this->db->query($sql, $params)->result_array();
        return (!empty($return))? $return[0] : array();
    }

    // 신규 name 등록
    function saveUserInfo($params) {
        $sql = "SELECT * FROM urluser WHERE user = ?";
        $result = $this->db->query($sql, array($params['user']))->result_array();
        if(empty($result)) {
            $return = $this->db->insert('urluser', $params);
            return (empty($return)) ? false : $params['user'];
        }
        return false;
    }

    // 신규 url 등록
    function saveUrlInfo($params) {
        $this->db->insert('url', $params);
        return $this->db->insert_id();
    }

    // url 수정
    function modUrlInfo($params) {
        $sql = "UPDATE url SET comment = ?, url = ?, secret = ?, regdate = ? WHERE srl = ? AND user = ?";
        $this->db->query($sql, $params);
        return $this->db->affected_rows();
    }

    // url 삭제
    function delUrlInfo($params) {
        $sql = "UPDATE url SET status = 'N' WHERE srl = ? AND user = ?";
        $this->db->query($sql, $params);
        return $this->db->affected_rows();
    }

    function saveUrlTop($params) {
        $sql = "UPDATE url SET chkdate = ? WHERE srl = ? AND user = ?";
        $this->db->query($sql, $params);
        return $this->db->affected_rows();
    }

    function saveUrlFav($params) {
        $sql = "UPDATE url SET fav = ? WHERE srl = ? AND user = ?";
        $this->db->query($sql, $params);
        return $this->db->affected_rows();
    }

    function saveUrlSec($params) {
        $sql = "UPDATE url SET secret = ? WHERE srl = ? AND user = ?";
        $this->db->query($sql, $params);
        return $this->db->affected_rows();
    }

    // url 조회
    function getUrlList($params) {
        $sql = "SELECT * FROM url WHERE user = ? AND status = 'Y' AND secret = 'N' ORDER BY srl DESC";
        return $this->db->query($sql, $params)->result_array();
    }

    // url 검색
    function getUrlSearch($params) {
        $sql = "SELECT U.*, R.* FROM urluser U LEFT JOIN url R ON R.user = U.user AND R.status = 'Y' WHERE U.user = ? ORDER BY R.chkdate DESC, R.srl DESC LIMIT 5";
        $return = $this->db->query($sql, $params)->result_array();
        return (empty($return)) ? array() : $return;
    }

    // user url 조회
    function getUserUrlList($params) {
        $sql = "SELECT R.* FROM urluser U JOIN url R ON R.user = U.user AND R.status = 'Y' WHERE U.user = ? ORDER BY R.chkdate DESC, R.srl DESC";
        $return = $this->db->query($sql, $params)->result_array();
        return (empty($return)) ? array() : $return;
    }

    // 최근 생성된 url
    function getRecentList($params) {
        $sql = "SELECT * FROM urluser ORDER BY regdate DESC LIMIT 7";
        $return = $this->db->query($sql, $params)->result_array();
        return (empty($return)) ? array() : $return;
    }

}
?>
