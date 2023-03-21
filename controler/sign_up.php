<?php

include_once "../model/sql_helpers.php";
if (isset($_SESSION['user'])) {
    header('Location: ../dash');

//    echo "a";
    die("");
}
if (!(isset($_POST['user']) && isset($_POST['pass']))) {

    echo file_get_contents('./View/login.html');
    die();
} else {


    if (find_in_sql_login($_POST['user'], $_POST['pass'])) {
        $response__header = ['status' => 'Nok','info'=>"username already exists "];
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($response__header, true);


//        session_start();
//        $_SESSION['user'] = $_GET['user'];
//        $_SESSION['pass'] = $_GET['pass'];
//
//
//        $response__header = ['status' => 'ok'];
//        header('Content-Type: application/json; charset=utf-8');
//        echo json_encode($response__header, true);

    } else {
        session_start();
        $_SESSION['user'] = $_POST['user'];
        $_SESSION['pass'] = $_POST['pass'];


        $response__header = ['status' => 'ok'];
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($response__header, true);
        $response__heade = ['status' => 'ok','info'=>"you are signed"];
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($response__heade, true);
    }
}


?>