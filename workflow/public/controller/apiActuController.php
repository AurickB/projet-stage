<?php
require_once '../model/frontendModel.php';
// Récupère les données de la bdd est les renvoie en json.
$actus = getActualite();

echo json_encode($actus);
?>