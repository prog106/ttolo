<?
class Rpc extends CI_Controller {
    public function index() {
        //$this->common->debug($_SERVER);
        //$this->common->debug($_POST);
        //$this->common->debug($_GET);
        $return = array('request' => 'hahaha', 'post' => $_POST, 'get' => $_GET);
        print_r(json_encode($return));
    }
}
?>
