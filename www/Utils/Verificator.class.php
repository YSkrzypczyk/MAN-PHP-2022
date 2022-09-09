<?php
namespace App\Utils;


class Verificator
{

    public static function checkForm(array $config, array $data, array &$errors): bool
    {

        //Vérification du nb de post/inputs et des clé des posts
        //Tentative de Hack
        if (empty(array_diff_key($config["inputs"], $data)) ) {

            //Pour chaque $_POST :
            foreach ($data as $name=>$value) {
                //Vérification des longueurs (required, min, max)
                if(
                    !empty($config["inputs"][$name]["min"]) &&
                    !self::checkMin($value, $config["inputs"][$name]["min"])
                ){
                    $errors[$name] = $config["inputs"][$name]["error"];
                }
                if(
                    !empty($config["inputs"][$name]["max"]) &&
                    !self::checkMax($value, $config["inputs"][$name]["max"])
                ){
                    $errors[$name] = $config["inputs"][$name]["error"];
                }
                if(
                    !empty($config["inputs"][$name]["required"]) &&
                    !self::checkNotEmpty($value)
                ){
                    $errors[$name] = $config["inputs"][$name]["error"];
                }


                //Vérification du format email

                if(
                    $config["inputs"][$name]["type"]=="email" &&
                    !self::checkEmail($value)
                ){
                    $errors[$name] = $config["inputs"][$name]["error"];
                }

                //Vérification du mot de passe
                if(
                    $config["inputs"][$name]["type"]=="password" &&
                    !self::checkPwd($value)
                ){
                    $errors[$name] = $config["inputs"][$name]["error"];
                }

                //Vérification de la confirmation

                if(
                    !empty($config["inputs"][$name]["confirm"]) &&
                    $value != $data[$config["inputs"][$name]["confirm"]]
                ){
                    $errors[$name] = $config["inputs"][$name]["error"];
                }

                //Vérification de l'unicity que s'il n'y a pas d'erreur sur le champs
                if(
                    empty($errors[$name]) && 
                    !empty($config["inputs"][$name]["unicity"]) &&
                    !self::checkUnicity($value,$config["inputs"][$name]["unicity"])
                ){
                    $errors[$name] = $config["inputs"][$name]["unicity"]["error"];

                }


            }

        } else {
            die("Tentative de HACK");
        }
        return empty($errors);
    }

    public static function checkMin(String $string,Int $length): bool
    {
        return strlen($string)>=$length;
    }

    public static function checkMax(String $string,Int $length): bool
    {
        return strlen($string)<=$length;
    }

    public static function checkUnicity(string $data, array $info): bool
    {
        $class = "App\\Model\\".$info["class"]; //user
        $prop = $info["prop"];
        $data = strtolower(trim($data));

        $object = new $class();
        $result = $object->getOneBy([$prop => $data]);

        return empty($result);
    }

    public static function checkEmail(String $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    //Min 8 caractères, Minuscule, Majscule et Chiffre
    public static function checkPwd(String $pwd): bool
    {
        return self::checkMin($pwd, 8) &&
                preg_match("#[0-9]#", $pwd) &&
                preg_match("#[a-z]#", $pwd) &&
                preg_match("#[A-Z]#", $pwd);
    }

    public static function checkNotEmpty(String $string): bool
    {
        return !empty(trim($string));
    }





}