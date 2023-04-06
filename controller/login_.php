<?php

class  login_
{
    public function index()
    {
        if (!isset($_SESSION["user"])) {
            view("login_page");
        } else {
            header("Location: ./dash");
        }


    }

    public function login()
    {

        include_once "model/log_user.php";
        $log_ = new log_user();
        if (isset($_SESSION['user'])) {
            header('Location: ./dash');

//       view("user/login_page");
            die("");
        }

        if ((($_GET['user'] === null) || ($_GET['pass'] === null))) {

            view("login_page");
            die();
        } else {


            $msp = hash('sha256', $_GET['pass']);

            if ($log_->find_in_sql_login($_GET['user'], $msp)) {


                $response__header = ['status' => 'ok'];
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response__header, true);
                session_start();

                $_SESSION['user'] = $_GET['user'];
                $_SESSION['pass'] = $_GET['pass'];

            } else {
                $response__heade = ['status' => 'Nok'];
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response__heade, true);
            }
        }
    }

    public function signup()
    {

        include_once "./model/log_user.php";
        if (isset($_SESSION['user'])) {
            header('Location: ./dash');

//    echo "a";
            die("");
        }
        if (!(isset($_GET['user']) && isset($_GET['pass']))) {

            view("login_page");
            die();
        } else {
            $log = new log_user();

            if ($log->find_in_sql_login2($_GET['user'])) {
                $response__header = ['status' => 'Nok', 'info' => "username already exists "];
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

                $msp2 = hash('sha256', $_GET['pass']);

                $log->insert_in_sql_login($_GET['user'], $msp2);
                session_start();
                $_SESSION['user'] = $_GET['user'];
                $_SESSION['pass'] = $_GET['pass'];


                header('Content-Type: application/json; charset=utf-8');

                $response__heade = ['status' => 'ok', 'info' => "you are signed"];
                echo json_encode($response__heade, true);
            }
        }

    }
}

?>