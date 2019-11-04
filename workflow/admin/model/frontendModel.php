<?php
require_once 'class/Database.php';
require_once 'class/App.php';

function getPost($start, $limit) {
    $db = App::getDatabase();
    $new = $db->request("SELECT * FROM posts JOIN users ON posts.id_user = users.id_user ORDER BY created_at DESC LIMIT $start,$limit", [])->fetchAll();
    return $new;
}

function selectPostId(){
    $db = App::getDatabase();
    $id = $db->request('SELECT id_post FROM posts');
    return $id;
}
?>