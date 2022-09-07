<?php
namespace App\Controller;
use App\Model\User;
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

        $user = new User();

        $user->setId(4)
             ->setFirstname("Tutu")
             ->setLastname("")
             ->setPwd("Test1234")
             ->setEmail("y.skrzypczyk@gmail.com")
             ->save();

        $view = new View("login", "security/register");
    }

    public function forget(): void
    {
        echo "forget";
    }

}