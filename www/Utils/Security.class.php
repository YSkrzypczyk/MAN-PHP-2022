<?php
namespace App\Utils;

use App\Model\User;

class Security
{

    public static function isLogged(): bool
    {
        if(!empty($_SESSION["token"]) && !empty($_SESSION["user"]) ){
            $user = new User();
            if(!empty($user->getOneBy(["email"=>$_SESSION["user"], "token"=>$_SESSION["token"]]) )){
                return true;
            }
        }
        return false;
    }

    public static function redirectIfNotConnected(): void
    {
        if(!self::isLogged()){
            header("Location: ".Router::getUrl("Security", "login"));
        }
    }
    public static function redirectIfConnected(): void
    {
        if(self::isLogged()){
            header("Location: ".Router::getUrl("Security", "dashboard"));
        }
    }

    public static function createToken(): string
    {
        return substr(md5(uniqid().SALT),0, -1);
    }

    public static function verifyCredentials(string $email, string $pwd, &$user): bool
    {
        $result = $user->getOneBy(["email"=>$email]);
        if(!$result) return false;
        $user = $result;
        return ($user && password_verify($pwd, $user->getPwd()));
    }

}