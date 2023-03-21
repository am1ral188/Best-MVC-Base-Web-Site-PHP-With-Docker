<?php
include_once "../model/sql_helpers.php";
if (isset($_SESSION['user'])){
    header('Location: ../dash');

//    echo "a";
    die("");
}
    if(!(isset($_POST['user'])&&isset($_POST['pass']))){

        echo file_get_contents('./View/login.html');
        die();
    }else{



        if (find_in_sql_login($_POST['user'],    $password = password_hash($_POST['pass'], PASSWORD_DEFAULT))){


                session_start();
                $_SESSION['user']=$_POST['user'];
                $_SESSION['pass']=$_POST['pass'];



            $response__header=['status'=>'ok'];
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response__header, true);

        }else{
            $response__heade=['status'=>'Nok'];
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response__heade, true);
        }
    }


?>

