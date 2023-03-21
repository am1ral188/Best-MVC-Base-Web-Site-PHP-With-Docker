<?php
include_once "urls.php";
include_once "pages_render.php";
$url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'], '/')) : '/';
$urls1=[
    "login"=>"login",
    "dashboard"=>"dashboard",
    "logout"=>"logout"

];
//echo var_dump($url);
if (in_array($url[0],$urls1)){
    $pr=$urls1[$url[0]];

    (str_replace("'", "", $pr))()();
}else if ($url[0]==="/"){

dashboard();
}
else{
err404();
}

?>