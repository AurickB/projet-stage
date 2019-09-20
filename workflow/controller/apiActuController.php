<?php 

// Récupère les données de la bdd est les renvoie en json.

require_once '../model/frontendModel.php';

$actus = getActualite();

echo json_encode($actus);

?>