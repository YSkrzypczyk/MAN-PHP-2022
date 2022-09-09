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

        $this->PDO = SingletonSql::getInstance();

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
            $columns["date_inserted"]=date('Y-m-d H:i:s');

            $queryPrepared = $this->PDO->prepare("INSERT INTO ".$this->table." 
            (".implode(",",array_keys($columns)).")
            VALUES
            (:".implode(",:",array_keys($columns)).")");

            $queryPrepared->execute($columns);

        }else{
            $columns["date_updated"]=date('Y-m-d H:i:s');

            foreach ($columns as $column=>$value)
                $sql[] =$column."=:".$column;

            $queryPrepared = $this->PDO->prepare("UPDATE ".$this->table." 
             SET ".implode(",", $sql)."
             WHERE id=:id");
            $queryPrepared->execute($columns);


        }

    }

    final public function getOneBy( array $params): bool|object
    {
        //$params = ["column"=>"value","column"=>"value", ...]

        foreach ($params as $column=>$value)
            $sql[] =$column."=:".$column;

        $queryPrepared = $this->PDO->prepare("SELECT * FROM ".$this->table." WHERE ".implode(" AND ", $sql));
        $queryPrepared->execute($params);
        return $queryPrepared->fetchObject(get_called_class());

    }


}