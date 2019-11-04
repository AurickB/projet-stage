<?php 
require_once 'class/Database.php';
require_once 'class/App.php';

// fonction qui permet de récupérer un utilisateur en fonction de son email.
function getUser($mail){
    $db = App::getDatabase();
    $user = $db->request('SELECT * FROM users WHERE email = ? AND confirmed_at IS NOT NULL', [$mail])->fetch();
    return $user;
}

// fonction qui permet de récupérer un utilisateur en fonction de son id.
function getUserById($user_id){
    $db = App::getDatabase();
    $user = $db->request('SELECT * FROM users WHERE id_user = ?', [$user_id])->fetch(PDO::FETCH_ASSOC);
    return $user;
}

function getUserForReset($id ,$reset_token){
    $db = App::getDatabase();
    $user = $db->request('SELECT * FROM users WHERE id_user = ? AND reset_token = ? AND reset_at > DATE_SUB(NOW(), INTERVAL 30 MINUTE)', [$id ,$reset_token])->fetch(PDO::FETCH_ASSOC);
    return $user;
}

// function qui permet de créer un token au click après avoir check "se souvenir de moi".
function remember($id, $remember_token){
    $db = App::getDatabase();
    $db->request('UPDATE users SET remember_token = ? WHERE id_user = ?', [$remember_token, $id]);
}

// function qui permet d'inserer un utilisateur.
function setUser($password, $token){
    $db = App::getDatabase();
    $db->request("INSERT INTO users SET email = ?, password = ?, service = ?, confirmation_token = ?", [$_POST['email'],$password,$_POST['service'],$token]);
    $user_id = $db->lastInsertId();
    $mail = mail($_POST['email'], 'Confirmation de votre compte', "Afin de valider votre compte merci de cliquer sur ce lien suivant :\n\nhttp://localhost:8888/projet_stage/workflow/admin/index.php?page=confirm&id=$user_id&token=$token");
}

// function qui permet d'insérer un post.
function setPost($post){
    $db = App::getDatabase();
    $db->request("INSERT INTO posts SET title = ?, content = ?, img = ?, created_at = NOW(), id_user = ?", [$_POST['title'],$_POST['content'], $post[1], $post[0]]);
}

// fonction qui permet de supprimer des posts de la table post
function deletePost($id){
    $db = App::getDatabase();
	$db->request("DELETE FROM posts WHERE id_post = ?", [$id]);
}

function selectPostIdForDelete($id){
    $db = App::getDatabase();
	return $db->request("SELECT * FROM posts WHERE id_post = ?", [$id])->fetch();
}

function verifyEmail($mail){
    $db = App::getDatabase();
    return $db->request('SELECT * FROM users WHERE email = ?', [$mail])->fetch();
}

function setToken($user_id){
    $db = App::getDatabase();
    $db->request('UPDATE users SET confirmation_token = NULL, confirmed_at = NOW() WHERE id_user = ?',[$user_id]);
}

function setPassword($reset_token, $id){
    $db = App::getDatabase();
    $db->request('UPDATE users SET reset_token = ?, reset_at = NOW() WHERE id_user= ?', [$reset_token, $id]);
    mail($_POST['email'], 'Réinitialisation de votre mot de passe', "Afin de réinitialiser votre mot de passe merci de cliquer sur ce lien suivant :\n\nhttp://localhost:8888/projet_stage/workflow/admin/index.php?page=reset&id=$id&token=$reset_token");
}

function modifyPassword($password, $id){
    $db = App::getDatabase();
    $db->request('UPDATE users SET password = ? WHERE id_user= ?', [$password, $id]);
}

?>