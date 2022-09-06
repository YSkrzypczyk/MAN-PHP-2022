<?php
namespace App\Controller;
use App\Utils\Security as Secu;


class Security
{

    public function login(): void
    {
        if( Secu::isLogged() ){
            echo "Vous êtes déjà connecté";
        }else{
            echo "login";
        }
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