<?php
namespace App\Utils;

class Router
{
    private String $file = "routes.yml";
    private String $fileCache = "routes.json";
    private array $routes = [];
    private static Router $_instance;

    private function __construct()
    {
        if(file_exists($this->file)) {
            if(file_exists("Cache/".$this->fileCache))
            {
                $this->routes = json_decode(file_get_contents("Cache/".$this->fileCache), true);
            }else{
                $this->routes = $this->createCache();
            }
        }
        else
            die("Le fichier ".$this->file." n'existe pas");
    }

    private function createCache(): array
    {
        $array = yaml_parse_file($this->file);
        $routes = json_encode($array);
        Cache::createFile($this->fileCache, $routes);
        return $array;
    }

    public static function getInstance(): Router
    {
        if(empty(self::$_instance))
        self::$_instance = new Router();

        return self::$_instance;

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