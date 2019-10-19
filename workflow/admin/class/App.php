<?php 

class App{
    
    static function getDatabase(){
        return new Database('cabinet_medical_V2', 'root', 'root');
    }
}