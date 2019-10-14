<?php 
function debug($variable){
    echo '<pre>' . print_r($variable, true). '</pre>';
}

// fonction qui permet de créer un clé de 60 caractères aléatoires.
function str_random($lenght){
    $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
    return substr(str_shuffle(str_repeat($alphabet, $lenght)), 0, $lenght);
}

// fonction qui appelle la fonction deletePost() en fonction de l'id de l'article et renvoie sur la page news.php après suppression du post.
function removePost($id){
    deletePost($id);
    header ('Location: news.php');
}

// fonction qui permet de supprimer des posts de la table post
function deletePost($id){
    require_once 'inc/bddConfig.php';
	$pdo = connect();

	$req='DELETE FROM posts WHERE id_post = "'.$id.'"';

	$request = $pdo->prepare($req);

	$request->execute([
		$id => htmlentities(strip_tags($id))
	]);
}
