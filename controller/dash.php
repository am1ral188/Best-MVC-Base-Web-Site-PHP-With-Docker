<?php
class dash{
public function index(){
    include_once "model/log_user.php";
    if(!isset($_SESSION['user'])){
        header('Location: ./login');
        die();
    }
    else{
        $obj=new log_user();
        if ($obj->get_user_ac($_GET['user']==='admin')){
            view("pages/dash_admin");

        }else{
            view("pages/dash_user.php");

        }

    }
}
}
?>