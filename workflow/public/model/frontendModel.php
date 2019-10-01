<?php 
require_once 'bddConfig.php';

function getActualite(){
    $db = connect();

    $postTotalReq= $db -> query ('SELECT * FROM post ORDER BY created_at DESC');
    
    return $postTotalReq->fetchAll(PDO :: FETCH_ASSOC);
}

function getPost(){
    $db = connect();
    $req = $db->prepare('SELECT * FROM post WHERE id = :id');
    $req->execute([
        ':id' => $_GET['id']
    ]);

    return $posts = $req->fetchAll();
}
?>   