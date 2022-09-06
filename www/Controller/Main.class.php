<?php
namespace App\Controller;

use App\Utils\View;

class Main
{
    public function home(): void
    {
        $view = new View("front", "main/home");
    }


}