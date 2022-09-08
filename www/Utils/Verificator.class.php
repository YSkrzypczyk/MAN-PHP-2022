<?php
namespace App\Utils;


class Verificator
{

    public static function checkForm(array $config, array $data): array
    {
        $errors = [];



        return $errors;
    }

    public static function checkMin(String $string,Integer $length): bool
    {
        return true;
    }

    public static function checkMax(String $string,Integer $length): bool
    {
        return true;
    }

    public static function checkUnicity(): bool
    {
        return true;
    }

    public static function checkEmail(String $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public static function checkPwd(String $pwd): bool
    {
        return true;
    }

    public static function checkNotEmpty(String $string): bool
    {
        return true;
    }





}