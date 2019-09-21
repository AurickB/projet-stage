<?php


$user_id = $_GET['id'];

$token = $_GET['token'];

require_once 'inc/bddConfig.php';

$pdo = connect();
$req = $pdo->prepare('SELECT * FROM user WHERE id = ?');
// On excute la requete avec l'id de l'utilisateur en paramètre.
$req->execute([$user_id]);
$user = $req->fetch();

session_start();
// On vérifie si on a un utilisateur et un token qui correspondent.
if($user && $user['confirmation_token'] == $token){
    // On empêche à l'utilisateur d'accéder de nouveau à cette page.
    $req = $pdo->prepare('UPDATE user SET confirmation_token = NULL, confirmed_at = NOW() WHERE id = ?'); 
    $req->execute([$user_id]);
    $_SESSION['auth'] = $user;
    header('Location: account.php');
    die('ok');
} else {
    $_SESSION['flash']['danger'] = "Ce token n'est plus valide";
    header('Location: login.php');
}