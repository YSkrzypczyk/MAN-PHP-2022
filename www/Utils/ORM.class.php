<?php
namespace App\Utils;

abstract class ORM
{
    abstract public function setId(?Int $id): object;
    abstract public function getId(): ?Int;
    abstract public function getDateInserted(): ?String;
    abstract public function getDateUpdated(): ?String;

    private \PDO $PDO;
    private String $table;

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

        $calledClass = explode("\\",get_called_class());
        $this->table = DBPREFIXE.strtolower(end($calledClass));
    }

    final public function save():void
    {
        $columns = array_diff_key(
            get_object_vars($this),
            get_class_vars(get_class())
        );

        if( is_null($this->getId())){
            unset($columns["id"]);
            $columns["date_inserted"]=time();

            $queryPrepared = $this->PDO->prepare("INSERT INTO ".$this->table." 
            (".implode(",",array_keys($columns)).")
            VALUES
            (:".implode(",:",array_keys($columns)).")");

            $queryPrepared->execute($columns);

        }else{


        }


    }


}