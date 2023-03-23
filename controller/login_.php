<?php
class  login_{
   public function index(){
      if (!isset($_SESSION["user"])){
          view("user/login_page");
      }else{
          header("Location: ./dash");
      }



    }
    public function login(){
        include_once "model/log_user.php";
        $log_=new log_user();
        if (isset($_SESSION['user'])){
            header('Location: ./dash');

//       view("user/login_page");
            die("");
        }
        if(!(isset($_POST['user'])&&isset($_POST['pass']))){

            echo file_get_contents('./View/login.html');
            die();
        }else{



            if ($log_->find_in_sql_login($_POST['user'],    $password = password_hash($_POST['pass'], PASSWORD_DEFAULT))){


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
    }
    public function signup(){

        include_once "./model/log_user.php";
        if (isset($_SESSION['user'])) {
            header('Location: ./dash');

//    echo "a";
            die("");
        }
        if (!(isset($_POST['user']) && isset($_POST['pass']))) {

            echo file_get_contents('./View/login.html');
            die();
        } else {
                $log=log_user();

            if ($log->find_in_sql_login($_POST['user'], $_POST['pass'])) {
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

    }
}
?>