<?php
$url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'], '/')) : '/';
include_once "config.php";
include_once "helpers/cont.php";
if($url[0]==="/"){
    include_once "controller/main_Page.php";
    $_Main=new main_Page();
    $_Main->index();
}else{
    $aaa="controller/".$url[0].".php";
if (file_exists($aaa)){
    include_once $aaa;
    $cont=new  $url[0];
if(isset($url[1])&&$url[1]!==""){
    if (method_exists($url[0],$url[1])){
//        $reflection = new ReflectionFunction('');
//        $params = $reflection->getParameters();
//        $num_of_args=1;
//       if ($reflection->getNumberOfParameters()>=1){
//           $code = $url[0].$url[1]."(";
//
//           foreach ($params as $param) {
//               $num_of_args+=1;
//               $code.=",".$url[$num_of_args];
//           }
//           $code.=")";
//
//           eval($code);
//
//           if(isset($url[$num_of_args])){
//               $cont->$url[1]();
//           }
//       }else{
//
//       }
//    $cont->$url[1]();

        call_user_func(array($cont, $url[1]));



    }else{
        echo "404";
    }
}else{
    $cont->index();

}
}else{
    echo "404";

}}

?>