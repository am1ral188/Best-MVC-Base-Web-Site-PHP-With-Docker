<?php
include_once "model/sql_helpers.php";
if (isset($_SESSION['user'])){
//    header('Location: ../logout.php');

//    echo "a";
    die("");
}
    if(!(isset($_GET['user'])&&isset($_GET['pass']))){

        echo file_get_contents('./View/index.html');
        die();
    }else{



        if (find_in_sql_login($_GET['user'],$_GET['pass'])){


                session_start();
                $_SESSION['user']=$_GET['user'];
                $_SESSION['pass']=$_GET['pass'];



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

