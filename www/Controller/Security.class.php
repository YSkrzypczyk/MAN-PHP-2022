<?php
namespace App\Controller;
use App\Utils\Security as Secu;
use App\Utils\View;


class Security
{

    public function login(): void
    {

        $view = new View("login", "security/login");
    }

    public function logout(): void
    {
        echo "logout";
    }

    public function register(): void
    {
        $view = new View("login", "security/register");
    }

    public function forget(): void
    {
        echo "forget";
    }

}