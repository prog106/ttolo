<?php
class Home extends CI_Controller {
    function __construct() {
        parent::__construct();
        self::_logincheck();
        $this->commonurl = "/home/";
        $this->load->helper('url');
        $this->load->view('/home/_head');
    }
    private function _logincheck() {
        $this->load->helper('cookie');
        $is_login = $this->input->cookie('is_login');
        if(!empty($is_login)) {
            $this->load->library('encrypt');
            $split = explode($this->config->item('Cookie_KEY'), $this->encrypt->decode($is_login),3);
            $this->usersrl = $split[0];
            $this->username = $split[1];
        } else {
            $this->usersrl = null;
            $this->username = null;
        }
    }
    // 초기화면
    public function index() {
        $data['ms'] = array(
            "Grow Site" => $this->commonurl.'main',
            "Dev Site" => $this->commonurl.'favi',
            "Facebook" => $this->commonurl.'snsfb',
            "kakao" => $this->commonurl.'kakao',
        );
        $this->load->view('home/link', $data);
        //redirect($this->commonurl.'main', 'refresh');
    }
    // 첫화면
    public function main() {
        $this->load->view('/home/main');
    }
    // 회원가입 페이지
    public function signin() {
        $this->load->view('/home/signin');
    }
    // 로그인페이지
    public function login() {
        $this->load->view('/home/login');
    }
    // 로그아웃
    public function logout() {
        $this->load->helper('cookie');
        $cookie_array = array(
            'name' => 'is_login',
            'domain' => 'prog106.phps.kr',
            'path' => '/',
            'prefix' => '',
        );
        delete_cookie($cookie_array);
        header('Location: '.$this->commonurl.'main');
    }

    function favi() {
        $data['fs'] = array(
            "블로그" => "http://color106.egloos.com/",
            "오늘의유머" => "http://www.todayhumor.co.kr/board/list.php?table=bestofbest",
            "alrin" => "http://www.alrin.net/",
            "토렌트바이" => "http://torrentby.us/",
        );
        $this->load->view('/home/favi',$data);
        //$this->load->view('home/'.$cate);
        //`$this->load->view('home/main');
        //$this->load->view('home/kakaostory');
        //$this->load->view('home/snsfb');
        //$this->load->view('home/home');
        //$this->load->view('home/head');
    }
    function comp() {
        $data['cs'] = array(
            "업무포탈" => "http://portal.tmoncorp.com/",
            "메일" => "http://mail.tmoncorp.com/"
        );
        $this->load->view('home/comp', $data);
    }
    function mail() {
        $this->load->view('home/ready');
    }
    function family() {
        $this->load->view('home/ready');
    }
    function snsfb() {
        $this->load->view('home/snsfb');
    }
    function kakao() {
        $this->load->view('home/kakaostory');
    }
    function lt() {
        $this->load->view('home/lt');
    }
    function lts() {
        $ns = array_unique($_POST['ns']);
        $ns = array_filter($ns);
        if(count($ns) < 6) {
            $stop = true;
        }

        foreach($ns as $k => $v) {
            if($v > 45) {
                $stop = true;
            }   
            echo $v.", ";
        }

        if($stop) {
            echo "번호확인";
            die;
        }

        $ttolo = array(
            array(9,10,13,24,33,38,28),
            );

        foreach($ttolo as $k => $v) {
            for($i=0;$i<6;$i++) {
                $tolo = $v; 
                unset($tolo[$i]);
                sort($tolo);
                $ttolo[] = $tolo;
            }   
        }

        foreach($ttolo as $k => $v) {
            unset($v[6]); //bonus 제외
            foreach($ns as $row) {
                if(in_array($row, $v)) {
                    $success[$k]['num'] = $v; 
                    $success[$k]['suc']++;
                }   
            }   
        }

        foreach($success as $row) {
            if($row['suc'] == 3) $s3++;
            if($row['suc'] == 4) $s4++;
            if($row['suc'] == 5) $s5++;
            if($row['suc'] == 6) $s6++;
            $cho .= "<br>".$row['suc']." 건 | ";
            foreach($row['num'] as $k) {
                $cho .= $k." ";
            }   
        }

        echo "<br> 총 ".number_format(count($ttolo))." 개 중<br>";
        echo "<br> 3개 맞음 : ".$s3."<br>";
        echo " 4개 맞음 : ".$s4."<br>";
        echo " 5개 맞음 : ".$s5."<br>";
        echo " 6개 맞음 : ".$s6."<br>";
        echo $cho;
    }
    function youtb() {
        //$command = "df -h";
        //$feedback = shell_exec($command);
        //$this->common->debug($feedback);
        //$this->load->view('home/youtb');
    }
}
?>
