<?php
class SigninModel extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function saveAuthUser($param) {
        $this->db->insert('ttolo_user_auth', $param);
        $result = $this->db->insert_id();
        return $result;
    }

    function getUser($param, $auth=null) {
        $auth_table = ($auth) ? "ttolo_user" : "ttolo_user_auth";
        $query = "SELECT * FROM ".$auth_table." WHERE mail = ?";
        $result = $this->db->query($query, $param)->result_array();
        return $result;
    }

    function getAuthUser($param) {
        $query = "SELECT * FROM ttolo_user_auth WHERE srl = ?";
        $result = $this->db->query($query, $param)->result_array();
        return $result[0];
    }

    function saveAuthUser2($param, $srl) {
        $result = $this->db->where('srl', $srl)->update('ttolo_user_auth', $param);
        return $result;
    }

    function authUser($param) {
        $query = "UPDATE ttolo_user SET level = ?, token = ?, regdate = ? WHERE mail = ? AND level = ? AND token = ''";
        $query_param = array(1, $param['token'], $param['regdate'], $param['mail'], 0);
        $this->db->query($query, $query_param);
        $result = $this->db->affected_rows();
        return $result;
    }

    function authUserFacebook($param) {
        $query = "UPDATE ttolo_user SET level = ?, token = ?, gender = ?, fr = ?, regdate = ? WHERE mail = ? AND level = ? AND token = ''";
        $query_param = array(1, $param['token'], $param['gender'], 'facebook', $param['regdate'], $param['mail'], 0);
        $this->db->query($query, $query_param);
        $result = $this->db->affected_rows();
        return $result;
    }

    function saveUser($param) {
        $query = "INSERT INTO ttolo_user (mail, pwd, user, regdate) VALUES (?,?,?,?) ON DUPLICATE KEY UPDATE mail = ?, pwd = ?, user = ?, regdate = ?";
        $query_param = array($param['mail'], $param['pwd'], $param['user'], $param['regdate']);
        $query_param = array_merge($query_param, $query_param);
        $result = $this->db->query($query, $query_param);
        return $result;
    }

    function getLoginUser($param) {
        $query = "SELECT * FROM ttolo_user WHERE mail = ? AND pwd = ? AND level = '1'";
        $result = $this->db->query($query, $param)->result_array();
        return $result;
    }

    function getLoginUserFacebook($param) {
        $query = "SELECT * FROM ttolo_user WHERE mail = ? AND level = '1' AND fr = 'facebook'";
        $result = $this->db->query($query, $param)->result_array();
        return $result;
    }

}
?>
