<?php
namespace App\Utils;
use App\Utils\Cache;

class DotEnv
{
    private string $file = ".env";
    private array $data = [];

    public function __construct()
    {
        $this->parse($this->file);
        $php = $this->persist();
        Cache::createFile("Constants.php","<?php ".$php);
    }

    public function parse($file): void
    {
        if(!file_exists($file)) die("Le fichier ".$file." n'existe pas");

        $text = file_get_contents($file);
        $lines = explode("\n", $text);
        $data = [];
        foreach ($lines as $line){
            if(!empty(trim($line))){
                $lineExploded = explode("=", $line);
                $name = strtoupper(trim($lineExploded[0]));
                $value = trim(trim($lineExploded[1]), "'\"");
                $data[$name]=$value;
            }
        }

        $this->data = array_merge($this->data, $data);

        if(!empty($data["ENV"]))$this->parse($this->file.".".$data["ENV"]);


    }

    public function persist(): String
    {
        $string = "";
        foreach ($this->data as $key=>$data){
            define($key,$data);
            $string .= "define('$key','$data');";
        }

        return $string;
    }

}