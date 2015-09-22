<?php
class Urlmodelbiz extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('dao/Urlmodeldao', 'urldao');
    }

    function getUserInfo($params) {
        if(empty($params['name']) || empty($params['password'])) {
            return false;
        }
        $prm['user'] = $params['name'];
        $prm['pwd'] = $params['password'];
        $result = $this->urldao->getUserInfo($prm);
        return (!empty($result)) ? $result : null;
    }

    function getUserLoginInfo($params) {
        if(empty($params['name']) || empty($params['password'])) {
            return false;
        }
        $prm['user'] = $params['name'];
        $result = $this->urldao->getUserLoginInfo($prm);
        if(empty($result['user'])) return null;
        if($params['password'] != $result['pwd']) return 'nomatch';
        return $result;
    }

    function saveUserInfo($params) {
        if(empty($params['name']) || empty($params['password'])) {
            return false;
        }
        $prm['user'] = $params['name'];
        $prm['pwd'] = $params['password'];
        $prm['regdate'] = date('Y-m-d H:i:s');
        return $this->urldao->saveUserInfo($prm);
    }

    function saveUrlInfo($params) {
        if(empty($params['user']) || empty($params['url'])) {
            return false;
        }
        $prm['user'] = $params['user'];
        $prm['comment'] = $params['comment'];
        $prm['url'] = $params['url'];
        $prm['secret'] = $params['secret'];
        $prm['status'] = 'Y'  ;
        $prm['regdate'] = date('Y-m-d H:i:s');
        return $this->urldao->saveUrlInfo($prm);
    }

    function modUrlInfo($params) {
        if(empty($params['user']) || empty($params['url']) || empty($params['srl'])) {
            return false;
        }
        $prm['comment'] = $params['comment'];
        $prm['url'] = $params['url'];
        $prm['secret'] = $params['secret'];
        //$prm['status'] = 'Y'  ;
        $prm['regdate'] = date('Y-m-d H:i:s');
        $prm['srl'] = $params['srl'];
        $prm['user'] = $params['user'];
        return $this->urldao->modUrlInfo($prm);
    }

    function delUrlInfo($params) {
        if(empty($params['user']) || empty($params['srl'])) {
            return false;
        }
        $prm['srl'] = $params['srl'];
        $prm['user'] = $params['user'];
        return $this->urldao->delUrlInfo($prm);
    }

    function saveUrlTop($params) {
        if(empty($params['user']) || empty($params['srl'])) {
            return false;
        }
        $prm['top'] = ($params['top'] == 'N') ? date('Y-m-d H:i:s') : NULL ;
        $prm['srl'] = $params['srl'];
        $prm['user'] = $params['user'];
        return $this->urldao->saveUrlTop($prm);
    }

    function saveUrlFav($params) {
        if(empty($params['user']) || empty($params['srl'])) {
            return false;
        }
        $prm['fav'] = ($params['fav'] == 'N') ? "Y" : "N";
        $prm['srl'] = $params['srl'];
        $prm['user'] = $params['user'];
        return $this->urldao->saveUrlFav($prm);
    }

    function saveUrlSec($params) {
        if(empty($params['user']) || empty($params['srl'])) {
            return false;
        }
        $prm['sec'] = ($params['sec'] == 'N') ? "Y" : "N";
        $prm['srl'] = $params['srl'];
        $prm['user'] = $params['user'];
        return $this->urldao->saveUrlSec($prm);
    }

    function getUrlList($params) {
        if(empty($params['user'])) {
            return false;
        }
        $prm['user'] = $params['user'];
        $return = $this->urldao->getUrlList($prm);
        return (empty($return)) ? array() : $return;
    }

    function getUrlSearch($params) {
        if(empty($params['user'])) {
            return false;
        }
        $prm['user'] = $params['user'];
        $return = $this->urldao->getUrlSearch($prm);
        return (empty($return)) ? array() : $return;
    }

    function getUserUrlList($params) {
        if(empty($params['user'])) {
            return false;
        }
        $return = $this->urldao->getUserUrlList($params);
        return (empty($return)) ? array() : $return;
    }

    function getRecentList($params=array()) {
        $return = $this->urldao->getRecentList($params);
        return (empty($return)) ? array() : $return;
    }
}
?>
