<?php 

function debug($variable){
    echo '<pre>' . print_r($variable, true). '</pre>';
}

// fonction qui permet de créer un clé de 60 caractères aléatoires.
function str_random($lenght){
    $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
    return substr(str_shuffle(str_repeat($alphabet, $lenght)), 0, $lenght);
}