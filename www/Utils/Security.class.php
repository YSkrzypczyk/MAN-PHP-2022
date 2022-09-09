<?php
namespace App\Utils;

use App\Model\User;

class Security
{

    public static function isLogged(): bool
    {
        return true;
    }

    public static function createToken(): string
    {
        return substr(md5(uniqid().SALT),0, -1);
    }

    public static function verifyCredentials(string $email, string $pwd, &$user): bool
    {
        $user = $user->getOneBy(["email"=>$email]);
        return ($user && password_verify($pwd, $user->getPwd()));
    }

}