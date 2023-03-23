<?php
$url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'], '/')) : '/';
include_once "config.php";
include_once "helpers/cont.php";
if($url[0]==="/"){
    include_once "controller/main_Page.php";
    $_Main=new main_Page();
    $_Main->index();
}else{
if (file_exists("controller/".$url[0]."php")){
    include_once "controller/".$url[0];
    $cont=new  $url[0];
if(isset($url[1])){
    if (method_exists($url[0],$url[1])){



        $reflection = new ReflectionFunction($url[1]);
        $params = $reflection->getParameters();
        $num_of_args=1;
        $code = $url[0].$url[1]."(";

        foreach ($params as $param) {
            $num_of_args+=1;
            $code.=",".$url[$num_of_args];
        }
        $code.=")";

        eval($code);

        if(isset($url[$num_of_args])){
            $cont->$url[1]();
        }


    }else{
        echo "404";
    }
}else{
    $cont->idex();

}
}else{
    echo "404";

}}

?>