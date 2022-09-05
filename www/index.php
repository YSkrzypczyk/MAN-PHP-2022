<?php
    namespace App;

    //Récupérer l'url, exemple /login
    $uri = strtolower(trim($_SERVER["REQUEST_URI"]));
    $uri = explode("?", $uri)[0];
    //Ouverture de notre fichier de routing
    if(file_exists("routes.yml")){
        $routes = yaml_parse_file("routes.yml");
    }else{
        die("Le fichier routes.yml n'existe pas");
    }

    //Récupérer le controller et l'action pour l'url
    // exemple /login controller: Security et l'action login

    //Créer une instance de la class controller
    //Appeler la méthode action

    //Exemple :
    // $controller = new Security();
    // $controller->login();

if( !isset($routes[$uri]) ) die("La route n'existe pas");
if( !isset($routes[$uri]["controller"]) ) die("Il n'y a pas de controller pour cette route");
if( !isset($routes[$uri]["action"]) ) die("Il n'y a pas d'action pour cette route");

$c = $routes[$uri]["controller"];
$a = $routes[$uri]["action"];

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