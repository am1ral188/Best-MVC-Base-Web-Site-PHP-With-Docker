<?php

include_once "config.php";
include_once "helpers/cont.php";
$url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'], '/')) : '/';

if ($url[0] === "/") {
    include_once "controller/main_Page.php";
    $_Main = new main_Page();
    $_Main->index();
} else {
    $aaa = "controller/" . $url[0] . ".php";
    if (file_exists($aaa)) {
        include_once $aaa;
        $cont = new  $url[0];
        $fa = $url[1] ?? "index";
        $pa = ($fa === "" ? "index" : $fa);
        if (method_exists($url[0], $pa)) {
            call_user_func(array($cont, $pa));
        } else {
            echo err404();
        }
    } else {
        echo err404();
    }


}

