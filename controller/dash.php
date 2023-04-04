<?php

class dash
{
    public function index()
    {
        include_once "model/log_user.php";
        if (!isset($_SESSION['user'])) {
            header('Location: ./login_');
            die();
        } else {

            function is_adm(): bool
            {
                $obj = new log_user();
                return $obj->get_user_ac($_SESSION['user']) === 'admin';
            }

            view("dash_admin");
        }
    }

    private function err_do_not_true_value($dis)
    {
        header("Content-Type: application/json");
        echo json_encode(["status" => "Nok", "description" => $dis]);
        die();


    }

    public function profile_image()
    {
        if (!isset($_SESSION["user"])) {
            header("Location: " . site_root . "login_");
            die();
        }
        $date = new DateTime('2000-01-01');
        $result = $date->format('Y-m-d H:i:s');
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
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            echo json_encode(["status" => "Nok", "description" => "not image"]);
            $uploadOk = 0;
        }

// Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {

// if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                echo json_encode(["status" => "Ok", "description" => "image saved"]);
                $objsqlup = new log_user();
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
        if (!isset($_SESSION['user'])) {
            die("go lose ");
        }
        $objsql = new log_user();

        $newusername_ = $_GET['username_'] ?? $this->err_do_not_true_value("bad value");
        (!preg_match("/^[a-z\d_]{2,20}$/i", $newusername_) ?: $this->err_do_not_true_value("bad value"));
        $pass = $_GET['pass'] ??$this->err_do_not_true_value("bad value");
        (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,22}$/', $pass) ?: $this->err_do_not_true_value("bad value"));
        $newpass = $_GET['newpass'] ?? $this->err_do_not_true_value("bad value");
        (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,22}$/', $newpass) ?: $this->err_do_not_true_value("bad value"));
        if ($objsql->find_in_sql_login($_SESSION['user'], $pass)) {
            if (!$objsql->find_in_sql_login2($newusername_)){
                $objsql->update_pass($_SESSION['user'], $pass, $newusername_, $newpass);
            }else{
                echo "a";
            }

        }else{
            echo "b";
        }
    }

    public function add_user()
    {
        if (!isset($_SESSION['user'])) {
            die("go lose ");
        }
        $objsql = new log_user();
        $username_ = $_GET['username_'] ?? $this->err_do_not_true_value("bad value");
        (!preg_match("/^[a-z\d_]{2,20}$/i", $username_) ?: $this->err_do_not_true_value("bad value"));
        $acs = $_GET['username_'] ?? $this->err_do_not_true_value("bad value");
        (!preg_match("/^[a-z\d_]{2,20}$/i", $acs) ?: $this->err_do_not_true_value());
        $newusername_ = $_GET['username_'] ?? $this->err_do_not_true_value("bad value");
        (!preg_match("/^[a-z\d_]{2,20}$/i", $newusername_) ?: $this->err_do_not_true_value("bad value"));
        $pass = $_GET['pass'] ?? $this->err_do_not_true_value("bad value");
        (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,22}$/', $pass) ?: $this->err_do_not_true_value());
        $newpass = $_GET['newpass'] ?? $this->err_do_not_true_value("bad value");
        (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,22}$/', $newpass) ?: $this->err_do_not_true_value("bad value"));
        if ($objsql->find_in_sql_login2($username_)) {
            $this->err_do_not_true_value("user already exist");
        } else {
            $objsql->insert_in_sql($newusername_, $newpass,$acs);
            header("Content-Type: application/json");
            echo json_encode(["status"=>"ok","description"=>"user inserted "]);
        }
    }

    public function delete_user()
    {
        $objsql = new log_user();
        if (!isset($_SESSION['user']) || ($objsql->get_user_ac($_SESSION['user']) != 'admin')) {
            die("go lose ");
        }
        $objsql = new log_user();
        $username_ = $_GET['username_'] ?? $this->err_do_not_true_value("bad value");
        (!preg_match("/^[a-z\d_]{2,20}$/i", $username_) ?: $this->err_do_not_true_value("bad value"));


        if ($objsql->find_in_sql_login2($username_)) {
            $objsql->delete_from_sql_dash_adm($username_);
        } else {
            header("Content-Type: application/json");
            echo json_encode(["status"=>"ok","description"=>"user deleted "]);
        }
    }
}