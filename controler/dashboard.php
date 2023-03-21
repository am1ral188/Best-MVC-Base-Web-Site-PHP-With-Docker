<?php
include_once "model/sql_helpers.php";
if(!isset($_SESSION['user'])){
    header('Location: ../login');
    die();
}
else{
    if (get_user_ac($_SESSION['user'])==='admin'){
        echo file_get_contents("View/index2.html");

    }else{
        echo file_get_contents("View/index.html");

    }

}
?>