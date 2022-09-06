<?php
namespace App\Controller;

use App\Utils\View;

class Main
{
    public function home(): void
    {
        //Depuis la bdd user
        $firstname = "Yves";

        $view = new View("front", "main/home");
        //$view->assign("firstname", $firstname);
        //$view->assign("lastname", "SKRZYPCZYK");
        $view->assignMultiple([
            "firstname"=>"yves",
            "lastname"=>"SKRZYPCZYK"
        ]);
    }


}