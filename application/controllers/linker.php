<?php
class Linker extends CI_Controller {
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

    private function _type($str, $arr) {
    }

    private function _urltype($str) {
        $arr = array(
            "youtube.com/watch" => "youtubewatch",
            "youtube.com/embed" => "youtubeembed",
            "youtu.be" => "youtube",
            ".jpg" => "image",
            ".jpeg" => "image",
            ".gif" => "image",
            ".png" => "image",
            "vimeo.com/channels/staffpicks" => "vimeo",
            "v.youku.com" => "youku",
            "player.youku.com" => "youkuplayer",
        );
        $return = "string";
        foreach($arr as $k => $v) {
            $pos = stripos($str, $k);
            if($pos !== false) {
                $return = $v;
                break;
            }
        }
        return $return;
    }

    // ttolo.kr/linker/view/$NAME
    public function view($nm=null) {
        if(empty($nm)) {
            header('Location: /linker');
            die;
        }

        self::_device();
        $params['user'] = $nm;
        $data['recentlist'] = $this->model->getRecentList();
        $data['list'] = $this->model->getUrlList($params);
        foreach($data['list'] as $k => $v) {
            $data['list'][$k]['tp'] = self::_urltype($v['url']);
        }
        $data['user'] = $params['user'];
        $data['write'] = true;
        $this->load->view("linker/view",$data);
    }

    // ttolo.kr/linker
    public function index() {
        self::_device();
        if(empty($this->_user)) {
            $data['recentlist'] = $this->model->getRecentList();
            $this->load->view("linker/signin", $data);
        } else {
            $user = $this->encrypt->decode($this->_user);
            if(substr($user, 0, 1) == 't') {
                $params['user'] = substr($user,1);
                $data['user'] = $params['user'];
                $data['list'] = $this->model->getUserUrlList($params);
                $data['recentlist'] = $this->model->getRecentList();
                foreach($data['list'] as $k => $v) {
                    $data['list'][$k]['tp'] = self::_urltype($v['url']);
                }
            } else {
                // 정상적인 로그인 상태 아님
                header('Location: /linker/logout');
                die;
            }
            $this->load->view("linker/index",$data);
        }
    }

    // ttolo.kr/linker ajax - login
    public function login() {
        $return = array('rtn' => 'NOK');
        if (!$this->input->is_ajax_request()) {
            echo json_encode($return);
            die;
        }
        $prm['name'] = $this->input->post('name');
        $prm['password'] = $this->input->post('password');

        $cv = null;
        $info = $this->model->getUserLoginInfo($prm);
        if($info == 'nomatch') {
            $return = array('rtn' => 'POK', 'msg' => '비밀번호가 다릅니다.');
        } else if(empty($info)) {
            $return = array('rtn' => 'POK', 'msg' => '존재하지 않는 MyLinker 입니다.');
        } else if(!empty($info)) {
            $cv = "t".$info['user'];
            $return = array('rtn' => 'OK', 'msg' => '로그인');
        } else {
            $return = array('rtn' => 'POK', 'msg' => '심각한 오류 발생!');
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

    // ttolo.kr/linker ajax - signin
    public function signin() {
        $return = array('rtn' => 'NOK');
        if (!$this->input->is_ajax_request()) {
            echo json_encode($return);
            die;
        }
        $prm['name'] = $this->input->post('name');
        $prm['password'] = $this->input->post('password');

        $cv = null;
        $info = $this->model->saveUserInfo($prm);
        if(!empty($info)) {
            $cv = "t".$info;
            $return = array('rtn' => 'OK', 'msg' => '가입');
        } else {
            $return = array('rtn' => 'POK', 'msg' => '입력하신 MyLinker 는 이미 사용중입니다.');
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

    // ttolo.kr/linker/urlsearch
    public function urlsearch() {
        $return = array('rtn' => 'NOK');
        if (!$this->input->is_ajax_request()) {
            echo json_encode($return);
            die;
        }

        $params['user'] = $this->input->post('urltxt');
        $list = $this->model->getUrlSearch($params);
        if(count($list) == 0)
            $rtn = "<h6>등록된 MyLinker가 없습니다.</h6>";
        else {
            $rtn = "<pre><h6>5개의 게시글만 보입니다.</h6>";
            $cnt = 0;
            for($i=0;$i<((count($list) < 5)?count($list):"5");$i++) {
                if(!empty($list[$i]['srl'])) {
                    $rtn .= "<h6>".($i+1).". [ ".(($list[$i]['comment'])? $list[$i]['comment'] : 'No Comment')." ] ".$list[$i]['url']."</h6>";
                    $cnt++;
                }
            }
            $rtn .= "<a href=\"http://ttolo.kr/linker/view/".$params['user']."\">MyLinker 더보기 (".number_format($cnt)." 건)</a></pre>";
        }
        $return = array('rtn' => 'OK', 'msg' => $rtn);
        echo json_encode($return);
    }
    // ttolo.kr/linker ajax - urlsave
    public function urlsave() {
        $return = array('rtn' => 'NOK');
        if (!$this->input->is_ajax_request() || empty($this->_user)) {
            echo json_encode($return);
            die;
        }

        $user = $this->encrypt->decode($this->_user);
        $prm['user'] = substr($user,1);
        $prm['srl'] = $this->input->post('msrl');
        $prm['url'] = $this->input->post('url');
        $prm['comment'] = $this->input->post('comment');
        $prm['secret'] = $this->input->post('secret');
        if(!empty($prm['srl'])) {
            $result = $this->model->modUrlInfo($prm);
        } else {
            $result = $this->model->saveUrlInfo($prm);
        }
        if($result) {
            $return = array('rtn' => 'OK');
        }
        echo json_encode($return);
    }

    // ttolo.kr/linker ajax - urldel
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

    // ttolo.kr/linker ajax - urltop
    public function urltop() {
        $return = array('rtn' => 'NOK');
        if (!$this->input->is_ajax_request() || empty($this->_user)) {
            echo json_encode($return);
            die;
        }

        $prm['srl'] = $this->input->post('srl');
        $prm['top'] = $this->input->post('top');
        $user = $this->encrypt->decode($this->_user);
        $prm['user'] = substr($user,1);
        if($this->model->saveUrlTop($prm)) {
            $return = array('rtn' => 'OK');
        }
        echo json_encode($return);
    }

    // ttolo.kr/linker ajax - urlfav
    public function urlfav() {
        $return = array('rtn' => 'NOK');
        if (!$this->input->is_ajax_request() || empty($this->_user)) {
            echo json_encode($return);
            die;
        }

        $prm['fav'] = $this->input->post('fav');
        $prm['srl'] = $this->input->post('srl');
        $user = $this->encrypt->decode($this->_user);
        $prm['user'] = substr($user,1);
        if($this->model->saveUrlFav($prm)) {
            $return = array('rtn' => 'OK');
        }
        echo json_encode($return);
    }

    // ttolo.kr/linker ajax - urlsec
    public function urlsec() {
        $return = array('rtn' => 'NOK');
        if (!$this->input->is_ajax_request() || empty($this->_user)) {
            echo json_encode($return);
            die;
        }

        $prm['sec'] = $this->input->post('sec');
        $prm['srl'] = $this->input->post('srl');
        $user = $this->encrypt->decode($this->_user);
        $prm['user'] = substr($user,1);
        if($this->model->saveUrlSec($prm)) {
            $return = array('rtn' => 'OK');
        }
        echo json_encode($return);
    }

    // ttolo.kr/linker/logout
    public function logout() {
        $this->load->helper('cookie');
        $cookie_array = array(
            'name' => 'ttolokr_urluser',
            'domain' => 'ttolo.kr',
            'path' => '/',
        );
        delete_cookie($cookie_array);
        header('Location: /linker');
    }

}
?>
