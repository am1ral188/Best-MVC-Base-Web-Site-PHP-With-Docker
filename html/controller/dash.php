<?php

class dash
{
    private $model;
    public function __construct($mdl)
    {
        $this->model=$mdl;
    }

    public function index()
    {

        if (!isset($_SESSION['user'])) {
            header('Location: ./login');
            die();
        } else {



            view("dash_view");
        }
    }

    private function err_do_not_true_value($description){
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(["status"=>"Nok","description"=>$description]);
        die();
    }

    public function profile_image()
    {

        if (!isset($_SESSION["user"])) {
            header("Location: " . site_root . "login");
            die();
        }
        $result = date("yyyy:mm:dd");
        $target_dir = SAVE_IMAGE_PATH;
        $target_file = $target_dir . basename($_SESSION['user'] . "_" . $result . "rand" . random_int(1, 200) . random_int(200, 1234) . $_FILES["file"]["name"]);;
        $uploadOk = 1;
        $imageFileType = $_FILES['file']['type'];

// Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["file"]["tmp_name"]);
            if ($check !== false) {

                $uploadOk = 1;
            } else {
                echo json_encode(["status" => "Nok", "description" => "file not image"]);
                $uploadOk = 0;
            }
        }

// Check if file already exists
        if (file_exists($target_file)) {
            json_encode(["status" => "Nok", "description" => "please retry"]);
            $uploadOk = 0;
        }

// Check file size
        if ($_FILES["file"]["size"] > 600000) {
            echo json_encode(["status" => "Nok", "description" => "big image"]);
            $uploadOk = 0;
        }

// Allow certain file formats
        if ($imageFileType != "image/jpg" && $imageFileType != "image/png" && $imageFileType != "image/jpeg"
            && $imageFileType != "gif") {
            echo json_encode(["status" => "Nok", "description" => "not image"]);
            $uploadOk = 0;
        }

// Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {

// if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                echo json_encode(["status" => "ok", "description" => "image saved"]);
                $objsqlup = $this->model;
                $objsqlup->update_profile($_SESSION['user'], $_SESSION['pass'], $target_file);
                $img = new Imagick($target_file);
                $img->stripImage();
                $img->writeImage($target_file);

            } else {
                echo json_encode(["status" => "Nok", "description" => "server error"]);;
            }
        }
    }

    public function change()
    {

        header('Content-Type: application/json; charset=utf-8');

        if (!isset($_SESSION['user'])) {
            die("go lose ");
        }
        $objsql = $this->model;

        $newusername_ = $_GET['username_'] ?? $this->err_do_not_true_value("bad value1");
        (preg_match("/^[a-z\d_]{2,20}$/i", $newusername_) ?: $this->err_do_not_true_value("bad value2"));
        $pass = $_GET['pass'] ??$this->err_do_not_true_value("bad value3");
        (preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,22}$/', $pass) ?: $this->err_do_not_true_value("bad value4"));
        $newpass = $_GET['newpass'] ?? $this->err_do_not_true_value("bad value77");
        (preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,22}$/', $newpass) ?: $this->err_do_not_true_value("bad value6"));


        if ($objsql->find_in_sql_login($_SESSION['user'],hash('sha256',$pass) )) {

            if ($objsql->find_in_sql_login2($newusername_)===false||$newusername_===$_SESSION['user']){
                $objsql->update_pass($_SESSION['user'], hash('sha256',$pass), $newusername_, hash('sha256',$newpass));
                $_SESSION['user']=$newusername_;
                $_SESSION['pass']=$newpass;
                echo json_encode(['status'=>"ok","description"=>"changed"]);
            }else{
                echo json_encode(['status'=>"Nok","description"=>"user already exist"]);
            }

        }else{
//            echo hash('sha256',$pass);

            echo json_encode(['status'=>"Nok","description"=>"password is not right "]);

        }
    }

    public function add_user()
    {

        if (!isset($_SESSION['user'])) {
            die("go lose ");
        }
        $objsql = $this->model;

        $acs = $_GET['acs'] ?? $this->err_do_not_true_value("bad value1");
        if ($acs!=='admin'&&$acs!="user"){
            $this->err_do_not_true_value("bad value1");
        }

    $newusername_ = $_GET['username_'] ?? $this->err_do_not_true_value("bad value3");
        (preg_match("/^[a-z\d_]{2,20}$/i", $newusername_) ?: $this->err_do_not_true_value("bad value4"));
        $pass = $_GET['pass'] ?? $this->err_do_not_true_value("bad value5");
        (preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,22}$/', $pass) ?: $this->err_do_not_true_value("bad value 6 "));

        if ($objsql->find_in_sql_login2($newusername_)) {
            $this->err_do_not_true_value("user already exist");
        } else {
            $objsql->insert_in_sql($newusername_, hash('sha256',$pass),$acs);
            header("Content-Type: application/json");
            echo json_encode(["status"=>"ok","description"=>"user inserted "]);
        }
    }

    public function delete_user()
    {

        $objsql = $this->model;
        if (!isset($_SESSION['user']) || ($objsql->get_user_ac($_SESSION['user']) != 'admin')) {
            die("go lose ");
        }
        $objsql = $this->model;
        $username_ = $_GET['username_'] ?? $this->err_do_not_true_value("bad value");
        (preg_match("/^[a-z\d_]{2,20}$/i", $username_) ?: $this->err_do_not_true_value("bad value"));


        if ($objsql->find_in_sql_login2($username_)&&$_SESSION['user']!=$username_) {
            $objsql->delete_from_sql_dash_adm($username_);
            header("Content-Type: application/json");
            echo json_encode(["status"=>"ok","description"=>"user deleted 1 "]);
        } else {
            header("Content-Type: application/json");
            echo json_encode(["status"=>"Nok","description"=>"user not deleted "]);
        }
    }
    public function log_out(){
        if(!isset($_SESSION['user'])){
            header("Location:".site_root ."login");
            die();

        }
        session_destroy();
        session_unset();
        header("Location : ".site_root."login");
}
}