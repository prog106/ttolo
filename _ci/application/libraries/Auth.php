<?
class Auth {
    function __construct() {
        $ci = &get_instance();
        $this->cookiekey = $ci->config->item('Cookie_KEY');
    }
    public function login($param) {
        $user = array(
            'prog106' => array(
                'pwd' => 'e10adc3949ba59abbe56e057f20f883e', //123456
                'name' => 'lsk',
                'srl' => '1234',
            ),
        );

        if(empty($user[$param['email']])) {
            return array('status' => 'FAIL', 'result' => '이메일 없음');
        }
        if($user[$email]['pwd'] != $param['pwd']) {
            return array('status' => 'FAIL', 'result' => '비밀번호 틀림');
        }
        return array('status' => 'OK', 'result' => array('usersrl' => $user[$param['email']]['srl']));
    }
}
?>
