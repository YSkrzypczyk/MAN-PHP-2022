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

        \App\Utils\Security::redirectIfConnected();

        $user = new User();
        $formErrors = [];

        if(!empty($_POST) ){
            if(\App\Utils\Security::verifyCredentials($_POST["email"], $_POST["pwd"], $user )){
                $token = \App\Utils\Security::createToken();

                //Mise à jour de la bdd avec le token
                $user->setToken($token);
                $user->save();
                //Création de la session token
                $_SESSION["token"] = $token;
                $_SESSION["user"] = $user->getEmail();

                header("Location: ".Router::getUrl("Security","dashboard"));
            }else{
                $formErrors = ["email"=>"Identifiants incorrects"];
            }
        }

        $view = new View("login", "security/login");
        $view->assign("formLogin", $user->getLoginForm());
        $view->assign("formErrors", $formErrors);


    }

    public function logout(): void
    {
        unset($_SESSION["token"]);
        unset($_SESSION["user"]);
        header("Location: ".Router::getUrl("Security","login"));

    }

    public function register(): void
    {

        \App\Utils\Security::redirectIfConnected();

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
        //Vérification de l'authentification ?
        \App\Utils\Security::redirectIfNotConnected();

        $view = new View("back", "security/dashboard");
    }

}