<?php
namespace App\Utils;

class SingletonSql
{
    private static ?SingletonSql $_instance = null;
    private \PDO $PDO;

    private function __construct()
    {
        try {
            $this->PDO = new \PDO("pgsql:host=" . DBHOST . ";dbname=" . DBNAME, DBUSER, DBPWD);
            $this->PDO->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->PDO->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
        }catch(\Exception $e){
            die("Erreur SQL : ".$e->getMessage());
        }
    }

    public static function getInstance()
    {
        if(is_null(self::$_instance))
        self::$_instance = new SingletonSql();

        return self::$_instance->PDO;
    }

}