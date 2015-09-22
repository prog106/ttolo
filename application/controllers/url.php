<?php
class Url extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('biz/Urlmodelbiz', 'model');
        $this->isUseLayout = false;
        $this->_user = ($this->input->cookie('ttolokr_urluser')) ? $this->input->cookie('ttolokr_urluser') : null;
    }

    private function _device() {
        // I(ios), M(etc mobile), W(web)
        $this->_device = (BROWSER_TYPE == 'I') ? 'I' : ((BROWSER_TYPE == 'M') ? 'M' : 'W');
    }

    // ttolo.kr/url/view/$NAME
    public function view($nm=null) {
        if(empty($nm)) {
            header('Location: /url');
            die;
        }

        self::_device();
        $params['user'] = $nm;
        $data['list'] = $this->model->getUrlList($params);
        $data['user'] = $params['user'];
        $this->load->view("url/view",$data);
    }

    // ttolo.kr/url
    public function index() {
        self::_device();
        if(empty($this->_user)) {
            $this->load->view("url/signin");
        } else {
            $user = $this->encrypt->decode($this->_user);
            if(substr($user, 0, 1) == 't') {
                $params['user'] = substr($user,1);
                $data['user'] = $params['user'];
                $data['list'] = $this->model->getUserUrlList($params);
            } else {
                // 정상적인 로그인 상태 아님
                header('Location: /url/logout');
                die;
            }
            $this->load->view("url/index",$data);
        }
    }

    // ttolo.kr/url ajax - signin
    public function signin() {
        $return = array('rtn' => 'NOK');
        if (!$this->input->is_ajax_request()) {
            echo json_encode($return);
            die;
        }
        $prm['name'] = $this->input->post('name');
        $prm['password'] = $this->input->post('password');

        $cv = null;
        $uinfo = $this->model->saveUserInfo($prm);
        if(!empty($uinfo)) {
            $cv = "t".$uinfo;
            $return = array('rtn' => 'OK', 'msg' => '가입');
        } else {
            $uinfo = $this->model->getUserInfo($prm);
            if(!empty($uinfo)) {
                $cv = "t".$uinfo;
                $return = array('rtn' => 'OK', 'msg' => '로그인');
            } else {
                $return = array('rtn' => 'POK', 'msg' => '비밀번호');
            }
        }

        if(!empty($cv)) {
            $_cookie = array(
                'name'   => 'ttolokr_urluser',
                'value'  => $this->encrypt->encode($cv),
                'expire' => 60*60*24*365*100, // 영구
                'domain' => 'ttolo.kr',
                'path'   => '/'
            );
            $this->input->set_cookie($_cookie);
        }

        echo json_encode($return);
    }

    // ttolo.kr/url ajax - urlsave
    public function urlsave() {
        $return = array('rtn' => 'NOK');
        if (!$this->input->is_ajax_request() || empty($this->_user)) {
            echo json_encode($return);
            die;
        }

        $user = $this->encrypt->decode($this->_user);
        $prm['user'] = substr($user,1);
        $prm['url'] = $this->input->post('url');
        $prm['comment'] = $this->input->post('comment');
        if($this->model->saveUrlInfo($prm)) {
            $return = array('rtn' => 'OK');
        }
        echo json_encode($return);
    }

    // ttolo.kr/url ajax - urldel
    public function urldel() {
        $return = array('rtn' => 'NOK');
        if (!$this->input->is_ajax_request() || empty($this->_user)) {
            echo json_encode($return);
            die;
        }

        $prm['srl'] = $this->input->post('srl');
        $user = $this->encrypt->decode($this->_user);
        $prm['user'] = substr($user,1);
        if($this->model->delUrlInfo($prm)) {
            $return = array('rtn' => 'OK');
        }
        echo json_encode($return);
    }

    // ttolo.kr/url/logout
    public function logout() {
        $this->load->helper('cookie');
        $cookie_array = array(
            'name' => 'ttolokr_urluser',
            'domain' => 'ttolo.kr',
            'path' => '/',
        );
        delete_cookie($cookie_array);
        header('Location: /url');
    }

}
?>
