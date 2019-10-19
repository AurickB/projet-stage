<?php 

class Database {
    
    private $pdo;

    public function __construct($database_name, $login, $pwd){
        try {
            $this->$pdo = new PDO ("mysql:host=localhost;port=8889;dbname=$database_name;charset=utf8", $login, $pwd); 
        } catch (Exception $e) {
            die('Error :' .$e->getMessage());
        }
    }

    public function query($query, $params = false){
        if ($params){ // si $param = true alors on fait une requête préparée
            $req = $this->$pdo->prepare($query);
            $req->execute($params);
        }else{
            $req = $this->$pdo->query($query);
        }
        return $req;
    }
}