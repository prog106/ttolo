<?php
class Start extends CI_Controller {
	function __construct() {
        parent::__construct();
        self::logincheck();
        $this->load->model('dental', 'dental');
        $this->load->view('start/_head');
        $data['menu'] = array('home', 'blog', 'love', 'health', 'rpc', 'info', 'like', 'favorite', 'facebook');
        $data['menu'] = array('home', 'health', 'info', 'facebook', 'favorite');
        $data['user'] = array(
            'usersrl' => $this->usersrl,
            'username' => $this->username,
        );
        $this->load->view('start/menu', $data);
    }
    private function object2array($object) {
        return @json_decode(@json_encode($object),1);
    }
    public function xml2array($url="http://rss.egloos.com/blog/color106") {
        $xmlread = file_get_contents($url);
        return self::object2array(simplexml_load_string($xmlread, 'SimpleXMLElement', LIBXML_NOCDATA));
    }
    private function imagegetext($fn) {
        $ft = mime_content_type($fn);
        $mt = explode('/',$ft);
        if($mt[0] != 'image') return false;
        $ft_array = array('jpeg' => 'jpg', 'vnd.microsoft.icon' => 'ico');
        if(array_key_exists($mt[1], $ft_array)) $mt[1] = $ft_array[$mt[1]];
        return $mt[1];
    }
    public function logincheck() {
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
    function index() {
        //$this->common->debug($_SERVER);
        $this->load->view('start/main');
    }
    function rpc() {
        $this->load->library('xmls');
        $data['name'] = 'lsk';
        $data['wife'] = 'lhm';
        $data['son'] = 'ljy';
        $res = $this->xmls->getData('rpc_get', $data);
        if($res['status'] != 'OK') {
            $this->common->debug($res);
        }
        $this->common->debug($res['result']);
    }
    function info() {
        if(empty($this->usersrl)) {
            $this->load->view('start/login');
        } else {
            $this->load->view('start/logout');
        }
    }
    function facebook() {
        /*$checkurl = 'http://developers.facebook.com/docs/plugins';
        $checkurl = 'http://google.com/';
        $checkurl = 'http://www.ticketmonster.co.kr/';
        $res = file_get_contents('http://graph.facebook.com/?id='.$checkurl);
        $this->common->debug($res);*/
        $this->load->view('start/fb');
    }
    function like() {
        $this->load->view('start/like');

    }
    function love() {
        //$dir = "/Volumes/PENDRIVE/photo/";
        if(is_dir($dir)) {
            if($opendir = opendir($dir)) {
                while(false !== ($row = readdir($opendir))) {
                    if($row != '.' && $row != '..') {
                        $result = self::imagegetext($dir.$row);
                        if(!$result) continue;
                        $fn = md5(serialize(time().basename($dir.$row, '.'.$result))).'.'.$result;
                        print_r($fn);
                        echo "<br>";
                    }
                }
                closedir($opendir);
            }
        }
        $this->load->view('start/love');
    }
    function health() {
        $list = $this->dental->md_list();
        print_r('<pre>');
        print_r($list);
        print_r('</pre>');
        $this->load->view('start/health');
    }
    function favorite() {
        $this->load->view('start/favorite');
    }
    function blog() {
        $xml = self::xml2array('http://rss.egloos.com/blog/color106');
        $data['item'] = $xml['channel']['item'];
        $data['info'] = $xml['channel']['image'];
        $this->load->view('start/blog', $data);
    }
}
?>
