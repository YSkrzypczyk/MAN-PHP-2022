<?php
namespace App\Controller;
use App\Utils\Security as Secu;
use App\Utils\View;


class Security
{

    public function login(): void
    {

        $view = new View("back", "security/login");
    }

    public function logout(): void
    {
        echo "logout";
    }

    public function register(): void
    {
        echo "register";
    }

    public function forget(): void
    {
        echo "forget";
    }

}