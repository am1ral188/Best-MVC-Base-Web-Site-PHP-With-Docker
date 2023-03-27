<?php
function view($addr){
    include_once "./view/".$addr.".php";
}
function err404():string{
    return file_get_contents("./public/404.html");
}
?>