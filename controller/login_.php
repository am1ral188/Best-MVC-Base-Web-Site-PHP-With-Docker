<?php

class  login_
{
    private $sql_login;

    public function __construct($mdl)
    {
        $this->sql_login = $mdl;
    }

    public function index()
    {
        if (!isset($_SESSION["user"])) {
            view("login_view");
        } else {
            header("Location: ./dash");
        }


    }
    private function err_do_not_true_value($description){
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(["status"=>"Nok","description"=>$description]);
        die();
    }
    public function login()
    {

        $log_ = $this->sql_login;
        if (isset($_SESSION['user'])) {
            header('Location: ./dash');

//       view("user/login_view");
            die("");
        }

        if ((($_GET['user'] === null) || ($_GET['pass'] === null))) {

            view("login_view");
            die();
        } else {
            (preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,22}$/', $_GET["pass"]) ?: $this->err_do_not_true_value("bad value"));
            (preg_match('/^[a-z\d_]{2,20}$/i', $_GET["user"]) ?: $this->err_do_not_true_value("bad value"));


            $msp = hash('sha256', $_GET['pass']);

            if ($log_->find_in_sql_login($_GET['user'], $msp)) {


                $response__header = ['status' => 'ok'];
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response__header, true);


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


        if (isset($_SESSION['user'])) {
            header('Location: ./dash');

//    echo "a";
            die("");
        }
        if (!(isset($_GET['user']) && isset($_GET['pass']))) {

            view("login_view");
            die();
        } else {
            $log = $this->sql_login;
//            (preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,22}$/', $_GET["pass"]) ?: $this->err_do_not_true_value("bad value"));
            (preg_match('/^[a-z\d_]{2,20}$/i', $_GET["user"]) ?: $this->err_do_not_true_value("bad value"));
            if ($log->find_in_sql_login2($_GET['user'])) {
                $response__header = ['status' => 'Nok', 'info' => "username already exists "];
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($response__header, true);




            } else {

                $msp2 = hash('sha256', $_GET['pass']);

                $log->insert_in_sql_login($_GET['user'], $msp2);

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