<?php
class dash{
public function index(){
    include_once "model/log_user.php";
    if(!isset($_SESSION['user'])){
        header('Location: ./login_');
        die();
    }
    else{

        function is_adm():bool{
            $obj=new log_user();
            return $obj->get_user_ac($_SESSION['user']) === 'admin';
        }
        view("dash_admin");
    }
}
private function err_do_not_true_value(){
    header("Content-Type: application/json");
    echo json_encode(["status"=>"Nok","description"=>"bad values"]);
    die();


}
public function profile_image(){
    if (!isset($_SESSION["user"])){
        header("Location: ".site_root."login_");
        die();
    }
    $date = new DateTime('2000-01-01');
    $result = $date->format('Y-m-d H:i:s');
    $target_dir = SAVE_IMAGE_PATH;
    $target_file = $target_dir . basename($_SESSION['user']."_".$result."rand".random_int(1,200).random_int(200,1234).$_FILES["fileToUpload"]["name"]);;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {

            $uploadOk = 1;
        } else {
            echo json_encode(["status"=>"Nok","description"=>"file not image"]);
            $uploadOk = 0;
        }
    }

// Check if file already exists
    if (file_exists($target_file)) {
        json_encode(["status"=>"Nok","description"=>"please retry"]);
        $uploadOk = 0;
    }

// Check file size
    if ($_FILES["fileToUpload"]["size"] > 600000) {
        echo json_encode(["status"=>"Nok","description"=>"big image"]);
        $uploadOk = 0;
    }

// Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo json_encode(["status"=>"Nok","description"=>"not image"]);
        $uploadOk = 0;
    }

// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {

// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo json_encode(["status"=>"Ok","description"=>"image saved"]);
            $objsqlup=new log_user();
            $objsqlup->update_profile($_SESSION['user'],$_SESSION['pass'],$target_file);

        } else {
            echo json_encode(["status"=>"Nok","description"=>"server error"]);;
        }
    }
}
public function change(){
    if (!isset($_SESSION['user'])){
        die("donkey hi you can not hack my site ");
    }
    $objsql=new log_user();
    $username_=$_GET['username_'] ?? $this->err_do_not_true_value();
     (!preg_match("/^[a-z\d_]{2,20}$/i",$username_) ?  : $this->err_do_not_true_value());
    $newusername_=$_GET['username_'] ?? $this->err_do_not_true_value();
    (!preg_match("/^[a-z\d_]{2,20}$/i",$newusername_) ?  : $this->err_do_not_true_value());
    $pass=$_GET['pass'] ?? $this->err_do_not_true_value();
    (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/',$pass) ?  : $this->err_do_not_true_value());
    $newpass=$_GET['newpass'] ?? $this->err_do_not_true_value();
    (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/',$newpass) ?  : $this->err_do_not_true_value());
    if ($objsql->find_in_sql_login($username_,$pass)){
        $objsql->update_pass($username_,$pass,$newusername_,$newpass);
    }
}
}