<?php 
require_once 'bddConfig.php';

function getActualite(){
    $db = connect();

    $req= $db -> query ('SELECT * FROM posts JOIN users ON posts.id_user = users.id_user ORDER BY created_at DESC');
    
    return $req->fetchAll(PDO :: FETCH_ASSOC);
}


function getPost(){
    $db = connect();
    $req = $db->prepare('SELECT * FROM posts WHERE id_post = :id');
    $req->execute([
        ':id' => $_GET['id']
    ]);

    return $posts = $req->fetchAll();
}
?>   