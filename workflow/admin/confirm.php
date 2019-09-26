<?php
session_start();

$user_id = $_GET['id'];

$token = $_GET['token'];

require_once 'inc/bddConfig.php';

$pdo = connect();
$req = $pdo->prepare('SELECT * FROM user WHERE id = ?');
// On excute la requete avec l'id de l'utilisateur en paramètre.
$req->execute([$user_id]);
$user = $req->fetch();
 
/**
 * On vérifie si on a un utilisateur et un token qui correspondent.
 * On permet qu'une utilisation du token.
 */
if($user && $user['confirmation_token'] == $token){
    $req = $pdo->prepare('UPDATE user SET confirmation_token = NULL, confirmed_at = NOW() WHERE id = ?'); 
    $req->execute([$user_id]);
    $_SESSION['flash']['success']= 'Votre compte est confirmé';
    $_SESSION['auth'] = $user;
    header('Location: account.php');
    die('ok');
} else {
    $_SESSION['flash']['danger'] = "Ce token n'est plus valide";
    header('Location: login.php');
}