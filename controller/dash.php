<?php
class dash{
public function index(){
    include_once "model/log_user.php";
    if(!isset($_SESSION['user'])){
        header('Location: ../login_');
        die();
    }
    else{
        $obj=new log_user();
        if ($obj->get_user_ac($_GET['user'])==='admin'){
            view("dash_admin");

        }else{
            view("dash_user.php");

        }

    }
}
}
?>