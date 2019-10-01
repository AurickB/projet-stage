<?php 
function debug($variable){
    echo '<pre>' . print_r($variable, true). '</pre>';
}

// fonction qui permet de créer un clé de 60 caractères aléatoires.
function str_random($lenght){
    $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
    return substr(str_shuffle(str_repeat($alphabet, $lenght)), 0, $lenght);
}


function removePost($id){
    deletePost($id);
    header ('Location: news.php');
}


function deletePost($id){
    require_once 'inc/bddConfig.php';
	$pdo = connect();

	$req='DELETE FROM post WHERE id = "'.$id.'"';

	$request = $pdo->prepare($req);

	$request->execute([
		$id => htmlentities(strip_tags($id))
	]);
}
