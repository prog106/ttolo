<?php
class Signin extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->library('encrypt');
        $this->load->helper('cookie');
        $this->load->model('signinmodel', 'model');
        $this->isUseLayout = false; // 템플릿 미사용시 false , defalut : true;
        $this->isttolo = $this->input->cookie('isttolo');
    }

    public function index() {
        if($this->isttolo) {
            header('Location: /');
            die;
        }
        $this->load->view('pc/head');
        $this->load->view('signin/index');
        $this->load->view('pc/footer');
    }

    public function choose() {
        if($this->isttolo) {
            header('Location: /');
            die;
        }
        $this->load->view('pc/head');
        $this->load->view('signin/choose');
        $this->load->view('pc/footer');
    }

    public function login() {
        if($this->isttolo) {
            header('Location: /');
            die;
        }
        $this->load->view('pc/head');
        $this->load->view('signin/login');
        $this->load->view('pc/footer');
    }

    public function logout() {
        $cookie_array = array(
            'name' => 'isttolo',
            'value' => '',
            'domain' => '.ttolo.kr',
            'path' => '/',
            'prefix' => '',
            'secure' => false,
        );
        delete_cookie($cookie_array);
        
        header('Location: /');
    }

    public function maillogin() {
        if(!empty($this->isttolo)) {
            echo "ALT";
            die;
        }

        $mail = $_POST['mail'];
        $this->load->helper('email');
        if (!valid_email($mail)) {
            echo "CHK";
            die;
        }

        $param['mail'] = $mail;
        $param['pwd'] = md5($this->config->item('Cookie_KEY').$_POST['pwd']);
        $usercheck = $this->model->getLoginUser($param);
        if ($usercheck) {
            $cookie_array = array(
                'name' => 'isttolo',
                'value' => $this->encrypt->encode($usercheck[0]['srl'].$this->config->item('Cookie_KEY').$usercheck[0]['mail'].$this->config->item('Cookie_KEY').$usercheck[0]['user']),
                'expire' => 60 * 60 * 24 * 1,
                'domain' => '.ttolo.kr',
                'path' => '/',
                'prefix' => '',
                'secure' => false,
            );
            $this->input->set_cookie($cookie_array);

            echo "SUC";
            die;
        } else {
            echo "NOT";
            die;
        }
        echo "ERR";

    }

    public function facebooklogin() {
        if(!empty($this->isttolo)) {
            echo "ALT";
            die;
        }

        $param['mail'] = $_POST['id'];
        $usercheck = $this->model->getLoginUserFacebook($param);
        if ($usercheck) {
            $cookie_array = array(
                'name' => 'isttolo',
                'value' => $this->encrypt->encode($usercheck[0]['srl'].$this->config->item('Cookie_KEY').$usercheck[0]['mail'].$this->config->item('Cookie_KEY').$usercheck[0]['user']),
                'expire' => 60 * 60 * 24 * 1,
                'domain' => '.ttolo.kr',
                'path' => '/',
                'prefix' => '',
                'secure' => false,
            );
            $this->input->set_cookie($cookie_array);

            echo "SUC";
            die;
        } else {
            echo "NOT";
            die;
        }
        echo "ERR";

    }

    public function mailauth() {
        $authkey = $_GET['authkey'];
        $authkey = $this->encrypt->decode($authkey);
        $token = explode($this->config->item('Cookie_KEY'), $authkey);
        $param = array($token[0]);
        $result = $this->model->getAuthUser($param);
        if(empty($result)) {
            echo "ERROR";
            die;
        }
        $param = array(
            "mail" => $result['mail'],
            "regdate" => date('Y-m-d H:i:s'),
            "token" => $result['token'],
        );
        $return = $this->model->authUser($param);
        if($return) {
            header('Location: http://ttolo.kr/');
        } else {
            echo "ERROR";
        }
    }

    public function parampwd() {
        $pwd = $_POST['pwd'];
        if(strlen($pwd) < 4 || strlen($pwd) > 15) {
            echo "L";
            die;
        }

        $check = array(); 
        if(preg_match('/[a-z]/',$pwd)) $check['lower'] = true; // 소문자
        if(preg_match('/[0-9]/',$pwd)) $check['number'] = true; // 숫자
        if(count($check) < 2) {
            echo "D";
            die;
        }

        if(preg_match('/[A-Z]/',$pwd)) $check['upper'] = true; // 대문자

        $special = '!"#$%&\'()*+,-./:;<=>?@[\]^_`{|}~'; 
        if(preg_match('/['.preg_quote($special,'/').']/',$pwd)) $check['special'] = true; // 특수문자

        if(count($check) == '4') echo "A";
        if(count($check) == '3') echo "B";
        if(count($check) == '2') echo "C";
    }

    public function parammail() {
        $mail = $_POST['mail'];
        $this->load->helper('email');
        if (!valid_email($mail)) {
            echo "CHK";
        } else
            echo "OK";
    }

    public function mailsignin() {
        $mail = $_POST['mail'];
        $this->load->helper('email');
        if (!valid_email($mail)) {
            echo "CHK";
            die;
        }

        $param['mail'] = $mail;
        $usercheck = $this->model->getUser($param);
        if ($usercheck) {
            echo "ALR";
            die;
        }

        $this->load->library('email');
        $this->email->from('prog106@ttolo.kr', '또로');
        $this->email->to($mail); 
        //$this->email->cc('another@another-example.com'); 
        //$this->email->bcc('them@their-example.com'); 

        $subject = "또로(ttolo.kr) 회원가입 인증 메일입니다.";

        $content = '또로(ttolo.kr) 회원가입 인증 메일입니다.\n\n';
        $content .= '회원가입을 완료하기 위해 아래의 링크를 클릭해 주세요.\n\n';

        $param = array(
            "mail" => $mail,
            "regdate" => date('Y-m-d H:i:s'),
        );
        $authkey = $this->model->saveAuthUser($param);
        $token = $this->encrypt->encode($authkey.$this->config->item('Cookie_KEY').$mail.$this->config->item('Cookie_KEY').$param['regdate']);
        $param = array(
            "mail" => $mail,
            "token" => $token,
        );
        $authlink = "http://ttolo.kr/signin/mailauth?authkey=".urlencode($token);
        $this->model->saveAuthUser2($param, $authkey);

        $content .= $authlink;
        $content .= '';

        $this->email->subject($subject);
        $this->email->message($content);  

        $result = $this->email->send();
        if($result == '1') {
            $param['mail'] = $mail;
            $param['pwd'] = md5($this->config->item('Cookie_KEY').$_POST['pwd']);
            $param['user'] = $_POST['name'];
            $param['regdate'] = date('Y-m-d H:i:s');
            $this->model->saveUser($param);
            echo "SUC";
        } else {
            echo "ERR";
        }
    }

    public function signinFacebook() {
        $param['mail'] = $_POST['param']['id'];
        /*$this->load->helper('email');
        if (!valid_email($param['mail'])) {
            echo "CHK";
            die;
        }*/

        $usercheck = $this->model->getUser($param, 1);
        if ($usercheck) {
            echo "ALR";
            die;
        }

        $param['pwd'] = '';
        $param['user'] = $_POST['param']['name'];
        $param['regdate'] = date('Y-m-d H:i:s');
        $result = $this->model->saveUser($param);

        if($result) {
            $param2['token'] = '';//$_POST['fbaccesstoken'];
            $param2['regdate'] = date('Y-m-d H:i:s');
            $param2['mail'] = $param['mail'];
            $param2['gender'] = ($_POST['param']['gender'] == 'male') ? "M" : "w";
            $this->model->authUserFacebook($param2);
            echo "SUC";
        } else
            echo "ALR";
    }
}
?>
