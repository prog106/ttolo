<?
class Err extends CI_Controller {
    public function index() {
        //$this->common->debug($_SERVER);
        //$this->common->debug($_POST);
        //$this->common->debug($_GET);
        $errmsg = array('errno' => '404', 'errstr' => 'No page!');
        print_r(json_encode($errmsg));
    }
}
?>
