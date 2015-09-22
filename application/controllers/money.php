<?php
class Money extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('moneys', 'money');
        //$this->load->view('/home/_head');
        $this->isUseLayout = false;
        $this->_cate = ($this->input->cookie('_ttolokr_bugs_auth_')) ? $this->input->cookie('_ttolokr_bugs_auth_') : null;
    }

    public function parel() {
        $this->load->view('money/parel');
    }

    // 초기화면
    public function index() {
        $param['cate'] = "ttolobugs";
        $data['list'] = $this->money->getMoneyList($param);
        $data['sum'] = $this->money->getMoneySum($param);
        $this->load->view('money/list', $data);
    }

    // 관리자
    public function money() {
        if(empty($this->_cate)) {
            redirect('/money', 'refresh');
            exit;
        }
        $param['cate'] = $this->_cate;
        $data['list'] = $this->money->getMoneyList($param);
        $data['sum'] = $this->money->getMoneySum($param);
        $this->load->view('money/money', $data);
    }

    // 관리자 인증
    public function auth() {
        $_cookie = array(
            'name'   => '_ttolokr_bugs_auth_',
            'value'  => 'ttolobugs',
            'expire' => 60*60*24*30,
            'domain' => 'ttolo.kr',
            'path'   => '/'
        );
        $this->input->set_cookie($_cookie);
        redirect('/money/money', 'refresh');
    }

    // 내역 추가
    public function gomoney() {
        $prm['cate'] = "ttolobugs";
        $prm['comment'] = $this->input->post('nc');
        $prm['money'] = $this->input->post('mn');
        $prm['plusminus'] = $this->input->post('pm');
        $prm['regdate'] = date('Y-m-d H:i:s');
        $return = $this->money->moneySave($prm);
        if(!$return) {
            echo "NOK";
            die;
        }
        echo "OK";
    }

    // 내역 삭제
    public function moneydel() {
        $prm['status'] = 'N';
        $return = $this->money->moneyDel($prm, $this->input->post('srl'));
        echo "OK";
    }

    // 스포츠 토토
    public function toto() {
        $data['list'] = $this->money->totoList();
        $this->load->view('money/toto', $data);
    }
    public function totojoin($prm) {
        if(!$prm) {
            redirect('money/toto', 'refresh');
            die;
        }
        $data['list'] = $this->money->totoList($prm);
        $this->load->view('money/toto', $data);
    }
    public function totoauth() {
        $_cookie = array(
            'name'   => '_ttolokr_toto_auth_',
            'value'  => date('YmdHis'),
            'expire' => 60*60*24*30,
            'domain' => 'ttolo.kr',
            'path'   => '/'
        );
        $this->input->set_cookie($_cookie);
        redirect('/money/toto', 'refresh');
    }
    public function totolist() {
        $data['list'] = $this->money->totoList();
        $this->load->view('money/totolist', $data);
    }

    public function gototo() {
        $prm['user'] = $this->input->cookie('user');
        $prm['totoname'] = $this->input->post('toto');
        $prm['money'] = $this->input->post('mo');
        $prm['team1'] = $this->input->post('te1');
        $prm['team2'] = $this->input->post('te2');
        $prm['regdate'] = date('Y-m-d H:i:s');
        $return = $this->money->totoSave($prm);
        if(!$return) {
            echo "NOK";
            die;
        }
        echo "OK";
    }

}
?>
