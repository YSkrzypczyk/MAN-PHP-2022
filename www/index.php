<?php
    namespace App;

    session_start();

    use App\Utils\DotEnv;
    use App\Utils\Router;
    use App\Utils\Security;

    spl_autoload_register(function($class)
    {
        // App\Utils\Security
        // Utils/Security.class.php
        $array = explode("\\", $class);
        unset($array[0]);
        $class = implode("/", $array);
        if(file_exists($class.".class.php")){
            include $class.".class.php";
        }
        else if(file_exists($class.".interface.php")){
            include $class.".interface.php";
        }
    });


    if(file_exists("Cache/Constants.php")){
        include "Cache/Constants.php";
    }else {
        new DotEnv();
    }


    Security::createToken();


    $uri = strtolower(trim($_SERVER["REQUEST_URI"]));
    $uri = explode("?", $uri)[0];


    $router = Router::getInstance();
    $routing = $router->getController($uri);



    $c = $routing["controller"];
    $a = $routing["action"];

if( file_exists("Controller/".$c.".class.php")){
    include "Controller/".$c.".class.php";
    $c = "App\\Controller\\".$c;
    if(class_exists($c)){

        $cObject = new $c();
        if(method_exists($cObject, $a)){
            //Security->login();
            $cObject->$a();
        }else{
            die("L'action ".$a." n'existe pas");
        }

    }else{
        die("La classe ".$c." n'existe pas");
    }


}else{
    die("Le fichier Controller/".$c.".class.php");
}
