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

    public static function getInstance(): Router
    {
        if(empty(self::$_instance))
            self::$_instance = new Router();

        return self::$_instance;

    }

    private function createCache(): array
    {

        $array["uri"] = yaml_parse_file($this->file);
        foreach ($array["uri"] as $uri=>$info){
            $array["controller"][$info["controller"]][$info["action"]] = $uri;
        }
        $routes = json_encode($array);
        Cache::createFile($this->fileCache, $routes);
        return $array;
    }


    public function getController(String $uri): array
    {
        if( !isset($this->routes["uri"][$uri]) ) die("La route n'existe pas");
        if( !isset($this->routes["uri"][$uri]["controller"]) ) die("Il n'y a pas de controller pour cette route");
        if( !isset($this->routes["uri"][$uri]["action"]) ) die("Il n'y a pas d'action pour cette route");

        return [
            "controller"=>$this->routes["uri"][$uri]["controller"],
            "action" =>$this->routes["uri"][$uri]["action"]
        ];
    }

    public static function getUrl(String $controller, String $action): String
    {
        $url = "";

        $instance = self::$_instance;

        if(empty($instance->routes["controller"][$controller]) || empty($instance->routes["controller"][$controller][$action]))
            die("L'url n'existe pas pour ".$controller." -> ".$action);


        return trim(URL,"/").$instance->routes["controller"][$controller][$action];
    }

}