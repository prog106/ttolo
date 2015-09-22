<?php
class Lt extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        if($_SERVER['SERVER_NAME'] == 'prog106.phps.kr') {
            redirect('http://ttolo.kr/', 'refresh');
            exit;
        }
        $this->commonurl = "/ci/lt";
        $this->load->model('ttolo', 'ttolo');
        $this->load->helper('cookie');
        $this->_user = ($this->input->cookie('_ttolokr_unique_srl_')) ? $this->input->cookie('_ttolokr_unique_srl_') : null;
        $this->isUseLayout = false;
    }

    function _remap($method) {
        $this->{$method}();
    }

    function index() {
        self::_userset();
        $this->isUseLayout = true; // 템플릿 미사용시 false , defalut : true;
        //$this->layout = 'default'; // 템플릿 교체시 사용 views/layouts/
        $data['mobile'] = ( BROWSER_TYPE == 'I' ) ? 'I' : ( ( BROWSER_TYPE == 'M') ? 'M' : 'W' ); // I : IOS MOBILE, M : ETC MOBILE, W : WEB
        $this->load->view('lt/index', $data);
    }

    function _userset() {
        if(empty($this->_user)) {
            $user = md5("t".time()."l");
            $_cookie = array(
                'name'   => '_ttolokr_unique_srl_',
                'value'  => $user,
                'expire' => 60*60*24*365*100,
                'domain' => 'ttolo.kr',
                'path'   => '/'
            );
            $uprm = array(
                'user'      => $user,
                'device'    => BROWSER_TYPE,
                'regdate'   => date('Y-m-d H:i:s'),
            );
            $this->ttolo->lt_usersave($uprm);
            $this->input->set_cookie($_cookie);
        }
    }

    function _ltt() {
        die;
        $result = $this->ttolo->lt_list();
        print_r($result);
        die;
        $cnt = 1;
        foreach($result as $k => $v) {
            $prm = null;
            $prm = array(
                'lotto1'     => $v[0],
                'lotto2'     => $v[1],
                'lotto3'     => $v[2],
                'lotto4'     => $v[3],
                'lotto5'     => $v[4],
                'lotto6'     => $v[5],
                'lotto7'     => $v[6],
                'regdate'   => date('Y-m-d H:i:s'),
            );
            $this->ttolo->ltins($prm);
        }
    }

    function dreamscometrue() {
        $ld = $this->input->post('ld');
        // 글자수
        $os = str_replace(" ", "lucky", $ld);
        $os = strlen($os);
        // 오늘날짜
        $ec = date('y') * date('m') * date('d') * date('H') * date('i');
        $return = null;
        for($i=1;$i<46;$i++) {
            $re = ($os * $ec) / $i;
            $ret = substr($re, -2);
            if($ret > 45) $ret = $ret - 45;
            if($ret > 45) $ret = $ret - 45;
            if($ret < 1) continue;
            $return[] = (int)$ret;
            $return = array_unique($return);
            if(count($return) == 6) break;
        }
        if(count($return) < 6) {
            for($i=1;$i<46;$i) {
                $rand = rand(1,45);
                $return[] = $rand;
                $return = array_unique($return);
                if(count($return) == 6) break;
            }
        }
        $return = implode(",",$return);
        echo $return;
    }

    function numbercometrue() {
        $nm = $this->input->post('nm');
        // 글자수
        $os = strlen($nm) * (int)$nm;
        // 오늘날짜
        $ec = date('y') * date('m') * date('d') * date('H');
        $return = null;
        for($i=1;$i<46;$i++) {
            $re = ($os * $ec) / $i;
            $ret = substr($re, -2);
            if($ret > 45) $ret = $ret - 45;
            if($ret > 45) $ret = $ret - 45;
            if($ret < 1) continue;
            $return[] = (int)$ret;
            $return = array_unique($return);
            if(count($return) == 6) break;
        }
        if(count($return) < 6) {
            for($i=1;$i<46;$i) {
                $rand = rand(1,45);
                $return[] = $rand;
                $return = array_unique($return);
                if(count($return) == 6) break;
            }
        }
        $return = implode(",",$return);
        echo $return;
    }

    function youcometrue() {
        // 오늘날짜
        $ec = date('y') * date('m') * date('d') * date('H');
        $ra = time();
        $return = null;
        for($i=1;$i<46;$i++) {
            $re = ($ra * $ec) / $i;
            $ret = substr($re, -2);
            if($ret > 45) $ret = $ret - 45;
            if($ret > 45) $ret = $ret - 45;
            if($ret < 1) continue;
            $return[] = (int)$ret;
            $return = array_unique($return);
            if(count($return) == 6) break;
        }
        if(count($return) < 6) {
            for($i=1;$i<46;$i) {
                $rand = rand(1,45);
                $return[] = $rand;
                $return = array_unique($return);
                if(count($return) == 6) break;
            }
        }
        $return = implode(",",$return);
        echo $return;
    }

    function lottosavelist() {
        $param['user'] = $this->_user;
        $rows = $this->ttolo->lt_savelist($param);
        foreach($rows as $k => $v) {
            $return[] = array($v['srl'], $v['lotto']);
        }
        echo json_encode($return);
    }

    function lottochoicelist() {
        $rows = array_reverse($this->ttolo->lt_list());
        $cnt = count($rows);
        $rows = array_slice($rows, 0, 100);

        foreach($rows as $k => $v) {
            $vv = null;
            for($i=0;$i<6;$i++) {
                $vv .= $v[$i].(($i<5)? ",":"");
            }
            $cnt--;
            $return[] = array($cnt, $vv, $v[6]);
        }
        echo json_encode($return);
    }

    function lottosave() {
        $ns = ($this->input->post('ns'))? $this->input->post('ns') : array();
        if(empty($ns)) {
            exit('NoData');
        }

        if(count($ns) != 6) {
            exit('NoNum');
        }

        $param['user'] = $this->_user;
        $param['lotto'] = implode(",",$ns);
        $param['regdate'] = date('Y-m-d H:i:s');

        $return = $this->ttolo->lt_checklist($param);
        if($return) exit('Sok');
        $result = $this->ttolo->lt_save($param);
        if($result) {
            exit('OK');
        } else {
            exit('Nok');
        }
    }

    function lottodel() {
        $ns = ($this->input->post('ns'))? $this->input->post('ns') : array();
        if(empty($ns)) {
            exit('NoData');
        }

        $param['status'] = 'N';
        $srl = $ns;

        $result = $this->ttolo->lt_del($param, $srl);
        if($result) {
            exit('OK');
        } else {
            exit('Nok');
        }
    }

    function analysis() {
        $ttolo = $this->ttolo->lt_list();
        $data['ttolo'] = $ttolo;
        $this->load->view('lt/analysis',$data);
    }
    function lt() {
        $ns = ($this->input->post('ns'))? $this->input->post('ns') : array();
        $ns = array_unique($ns);
        $ns = array_filter($ns);
        $st = $this->input->post('st');
        $stop = false;
        $success = null;
        if(count($ns) < 6) {
            $return = array('NoCount');
            echo json_encode($return);
            die;
        }

        $nb = null;
        foreach($ns as $k => $v) {
            $nb .= $v.(($k < 5)? ", ":"");
        }

        $ttolo = $this->ttolo->lt_list();

        // 보너스 번호 제거
        if($st == 'Y') {
            foreach($ttolo as $k => $v) {
                for($i=0;$i<6;$i++) {
                    $tolo = $v; 
                    unset($tolo[$i]);
                    sort($tolo);
                    $ttolo[] = $tolo;
                }   
            }
        }

        foreach($ttolo as $k => $v) {
            unset($v[6]); //bonus 제외
            $success[$k]['num'] = 0;
            $success[$k]['suc'] = 0;
            foreach($ns as $row) {
                if(in_array($row, $v)) {
                    $success[$k]['num'] = $v;
                    $success[$k]['suc']++;
                }
            }   
        }

        $cho = null;
        $s3 = null;
        $s4 = null;
        $s5 = null;
        $s6 = null;
        foreach($success as $row) {
            if($row['suc'] == 3) $s3++;
            if($row['suc'] == 4) $s4++;
            if($row['suc'] == 5) $s5++;
            if($row['suc'] == 6) $s6++;
            if($row['suc'] > 0) {
                $cho .= "<br>".$row['suc']." 건 | ";
                foreach($row['num'] as $k) {
                    $cho .= $k." ";
                }
            }
        }

        $return = array($nb, number_format(count($ttolo)), number_format($s3), number_format($s4), number_format($s5), number_format($s6));
        echo json_encode($return);
    }
}
?>
