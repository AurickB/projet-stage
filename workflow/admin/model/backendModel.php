<?php 
require_once 'class/Database.php';
require_once 'class/App.php';

// fonction qui permet de selectionner un utilisateur en fonction de son email.
function getUserbyEmail($mail){
    $db = App::getDatabase();
    $user = $db->request('SELECT * FROM users WHERE email = ? AND confirmed_at IS NOT NULL', [$mail])->fetch();
    return $user;
}

function getUserById($user_id){
    $db = App::getDatabase();
    $user = $db->request('SELECT * FROM users WHERE id_user = ?', [$user_id])->fetch(PDO::FETCH_ASSOC);
    return $user;
}

// function qui permet d'inserer un utilisateur.
function setUser($password, $token){
    $db = App::getDatabase();
    $db->request("INSERT INTO users SET email = ?, password = ?, service = ?, confirmation_token = ?", [$_POST['email'],$password,$_POST['service'],$token]);
    $user_id = $db->lastInsertId();
    $mail = mail($_POST['email'], 'Confirmation de votre compte', "Afin de valider votre compte merci de cliquer sur ce lien suivant :\n\nhttp://localhost:8888/projet_stage/workflow/admin/index.php?page=confirm&id=$user_id&token=$token");
}

// function qui permet de créer un token au click après avoir check "se souvenir de moi".
function remember($id, $remember_token){
    $db = App::getDatabase();
    $db->request('UPDATE users SET remember_token = ? WHERE id_user = ?', [$remember_token, $id]);
}

function getPost(){
    $db = App::getDatabase();
    $post = $db->request('SELECT * FROM users', [])->fetch();
    return $post;
}

// function qui permet d'insérer un un post.
function setPost($id_user){
    $db = App::getDatabase();
    $db->request("INSERT INTO posts SET title = ?, content = ?, created_at = NOW(), id_user = $id_user", [$_POST['title'],$_POST['content']]);
}

// fonction qui permet de supprimer des posts de la table post
function deletePost($id){
    $db = App::getDatabase();
	$db->request("DELETE FROM posts WHERE id_post = ?", [$id]);
}

function verifyEmail(){
    $db = App::getDatabase();
    return $db->request('SELECT id_user FROM users WHERE email = ?', [$_POST['email']])->fetch();
}

function setToken($user_id){
    $db = App::getDatabase();
    $db->request('UPDATE users SET confirmation_token = NULL, confirmed_at = NOW() WHERE id_user = ?',[$user_id]);
}

?>