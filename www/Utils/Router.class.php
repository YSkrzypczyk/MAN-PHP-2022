<?php
namespace App\Utils;

class Router
{
    private String $file = "routes.yml";
    private array $routes = [];

    public function __construct()
    {
        if(file_exists($this->file))
            $this->routes = yaml_parse_file($this->file);
        else
            die("Le fichier ".$this->file." n'existe pas");
    }

    public function getController(String $uri): array
    {
        if( !isset($this->routes[$uri]) ) die("La route n'existe pas");
        if( !isset($this->routes[$uri]["controller"]) ) die("Il n'y a pas de controller pour cette route");
        if( !isset($this->routes[$uri]["action"]) ) die("Il n'y a pas d'action pour cette route");

        return [
            "controller"=>$this->routes[$uri]["controller"],
            "action" =>$this->routes[$uri]["action"]
        ];
    }

}