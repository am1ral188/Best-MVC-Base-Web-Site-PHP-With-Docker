<?php
function login(){
    include_once "controler/login.php";
}
function dashboard(){

    include_once "controler/dashboard.php";
}
function logout(){
    include_once "controler/logout.php";
}
function err404(){
    echo file_get_contents("View/404.html");
}
?>