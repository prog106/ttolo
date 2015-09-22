<?php
class Imgctrl extends CI_Controller {
    function __construct() {
        parent::__construct();
    }
    function index() {
        $this->imageinsert();
    }
    function imagemacham() {
        $time = time();
        $savefolder = "/home/prog106/ci/static/upload/";
        $checktoken = md5('prog106'.$this->input->post('timestamp'));
        if(!empty($_FILES) && $this->input->post('token') == $checktoken) {
            $tmpfile = $_FILES['photo']['tmp_name'][0];
            $fileTypes = array('jpg', 'gif', 'png');
            $fileParts = pathinfo($_FILES['photo']['name'][0]);
            $savefilename = md5('img'.$time).".".$fileParts['extension'];

            if(in_array($fileParts['extension'], $fileTypes)) {
                move_uploaded_file($tmpfile, '/home/prog106/ci/static/uploadready/'.$savefilename);
                $result['returnname'] = $savefilename;
                echo json_encode($result);
            } else {
                echo "Check File Type, Please";
            }
        }
    }
    function imagemachamdrop() {
        $imgsrc = $this->input->post('imgsrc');
        $savefolder = "/home/prog106/ci/static/upload/";
        if(file_exists($savefolder.$imgsrc)) unlink($savefolder.$imgsrc);
        return true;
    }
    function imageinsert() {
        $time = time();
        $savefolder = "/home/prog106/ci/static/upload/";
        $checktoken = md5('prog106'.$_POST['timestamp']);
        if(!empty($_FILES) && $_POST['token'] == $checktoken) {
            $tmpfile = $_FILES['Filedata']['tmp_name'];
            $fileTypes = array('jpg', 'gif', 'png');
            $fileParts = pathinfo($_FILES['Filedata']['name']);
            $savefilename = md5('img'.$time).".".$fileParts['extension'];

            if(in_array($fileParts['extension'], $fileTypes)) {
                move_uploaded_file($tmpfile, '/home/prog106/ci/static/upload/'.$savefilename);
                echo $savefilename;
            } else {
                echo "Check File Type, Please";
            }
        }
    }
}
?>
