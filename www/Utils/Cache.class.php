<?php
namespace App\Utils;

class Cache
{

    public static function createFile(String $name,String $data): void
    {
        if(!file_exists("Cache"))
            mkdir("Cache");
        $handle = fopen("Cache/".$name, 'w');
        fwrite($handle,$data);
        fclose($handle);

    }


}