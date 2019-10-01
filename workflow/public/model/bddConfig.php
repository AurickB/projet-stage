<?php 
require_once 'config.php';
    
function connect(){
    global $acces, $login,$pwd;
    try {
            $db = new PDO ($acces, $login,$pwd);
            return $db;
        } catch (Exception $e) {
    
            die('Error :' .$e->getMessage());
        }
}