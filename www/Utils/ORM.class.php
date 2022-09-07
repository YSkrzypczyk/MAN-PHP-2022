<?php
namespace App\Utils;

abstract class ORM
{
    abstract public function setId(?Int $id): object;
    abstract public function getId(): ?Int;
    abstract public function getDateInserted(): ?String;
    abstract public function getDateUpdated(): ?String;

    private \PDO $pdo;

    //Mettre en place un singleton (Design pattern)
    public function __construct()
    {
        try {
            $this->PDO = new \PDO("pgsql:host=" . DBHOST . ";dbname=" . DBNAME, DBUSER, DBPWD);
            $this->PDO->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->PDO->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
        }catch(\Exception $e){
            die("Erreur SQL : ".$e->getMessage());
        }
    }

    final public function save():void
    {
        //Est-ce un insert ou un update
        if(){
            //Récupérer le nom de la table, exemple esgi_user
            //Récupérer toutes les colonnes de la table
            //Générer une requête préparée

            $queryPrepared = $this->PDO->prepare('......');
            $queryPrepared->execute([
                                "firstname"=>"Yves"
                            ]);

        }else{

        }

    }


}