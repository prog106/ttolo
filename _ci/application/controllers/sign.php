<?
class Sign extends CI_Controller {
    function __construct() {
        parent::__construct();
        //$split = explode('/', $_SERVER['HTTP_REFERER'], 4);
        //$this->referer = ($split[4])? $split[4] : 'start';
    }
    public function login() {
        $data['email'] = $_POST['login_email'];
        $data['pwd'] = md5($_POST['login_pwd']);

        $res = $this->auth->login($data);
        if($res['status'] != 'OK') {
            //header('Location: /start/info');
            $result = array('ret' => 'NOK');
            echo json_encode($result);
            die;
        }
        $return = $res['result'];
        $this->load->helper('cookie');
        $cookie_array = array(
            'name' => 'is_login',
            'value' => $this->encrypt->encode($return['usersrl'].$this->config->item('Cookie_KEY').$data['email']),
            'expire' => 60 * 60 * 24 * 1,
            'domain' => 'prog106.phps.kr',
            'path' => '/',
            'prefix' => '',
            'secure' => false,
        );
        $this->input->set_cookie($cookie_array);
        //header('Location: /start');
        $result = array('ret' => 'OK');
        echo json_encode($result);
    }
    public function logout() {
        $this->load->helper('cookie');
        $cookie_array = array(
            'name' => 'is_login',
            'domain' => 'localhost',
            'path' => '/',
            'prefix' => '',
        );
        delete_cookie($cookie_array);
        header('Location: /start');
    }
    public function register() {
        $postkey = array('nick', 'birth');
        foreach($postkey as $k => $v) {
            $data[$v] = $_POST[$v];
        }

        // db insert
        $this->load->model('Member', 'member');
        $ret = $this->member->signin($data);
        $result = array('ret' => 'OK', 'msg' => $ret);
        echo json_encode($result);
    }
}
?>
