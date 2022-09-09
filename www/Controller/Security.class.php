<?php
namespace App\Controller;
use App\Model\User;
use App\Utils\Router;
use App\Utils\Security as Secu;
use App\Utils\Verificator;
use App\Utils\View;


class Security
{

    public function login(): void
    {

        $user = new User();

        $view = new View("login", "security/login");
        $view->assign("formLogin", $user->getLoginForm());
        //$view->assign("formErrors", $errors);
    }

    public function logout(): void
    {
        echo "logout";
    }

    public function register(): void
    {

        $user = new User();
        $errors = [];

        if( !empty($_POST) && Verificator::checkForm($user->getRegisterForm(), $_POST, $errors)){

            $user
             ->setFirstname($_POST["firstname"])
             ->setLastname($_POST["lastname"])
             ->setPwd($_POST["pwd"])
             ->setEmail($_POST["email"])
             ->save();

            header("Location: ".Router::getUrl("Security","login"));
        }

        $view = new View("login", "security/register");
        $view->assign("formRegister", $user->getRegisterForm());
        $view->assign("formErrors", $errors);
    }

    public function forget(): void
    {
        echo "forget";
    }

    public function dashboard(): void
    {
        $view = new View("back", "security/dashboard");
    }

}