<?php
require_once 'class/Database.php';
require_once 'class/App.php';

function getNew($limit, $postParPage) {
    $db = App::getDatabase();
    $new = $db->request("SELECT * FROM posts JOIN users ON posts.id_user = users.id_user ORDER BY created_at DESC LIMIT $limit,$postParPage", [])->fetchAll();
    return $new;
}

function selectID(){
    $db = App::getDatabase();
    $id = $db->request('SELECT id_post FROM posts');
    return $id;
}
?>