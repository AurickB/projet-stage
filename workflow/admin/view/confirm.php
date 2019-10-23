<?php
require_once '/inc/bddConfig.php';

$user_id = $_GET['id'];
$token = $_GET['token'];

$pdo = connect();
$req = $pdo->prepare('SELECT * FROM users WHERE id_user = ?');
$req->execute([$user_id]);
$user = $req->fetch();
 
/**
 * On vérifie si on a un utilisateur et un token qui correspondent.
 * On permet qu'une utilisation du token.
 */
if($user && $user['confirmation_token'] == $token){
    $req = $pdo->prepare('UPDATE users SET confirmation_token = NULL, confirmed_at = NOW() WHERE id_user = ?'); 
    $req->execute([$user_id]);
    $_SESSION['flash']['success']= 'Votre compte est confirmé';
    $_SESSION['auth'] = $user;
    displayAccount();
    die('ok');
} else {
    echo 'déjà fait';
    $_SESSION['flash']['danger'] = "Ce token n'est plus valide";
    displayLogin();
}