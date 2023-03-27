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
}

?>