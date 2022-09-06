<?php
namespace App\Controller;

class Tool
{

    public function cleanCache(): void
    {
        exec("rm -Rf Cache");
        die("Le cache a bien été supprimé.");
    }

}