<?php
namespace App\Utils;

class DotEnv
{
    private String $file = ".env";

    public function __construct()
    {
        $this->run();
    }

    public function run(): void
    {
        $text = file_get_contents($this->file);
        $lines = explode("\n", $text);
        foreach ($lines as $line){
            if(!empty(trim($line))){
                $data = explode("=", $line);
                $name = strtoupper(trim($data[0]));
                $value = trim(trim($data[1]), "'\"");

                if(!defined($name))
                define($name, $value);

            }
        }
    }

}