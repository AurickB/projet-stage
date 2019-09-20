<?php 
require_once 'bddConfig.php';

function getActualite(){
    $db = connect();

    $postTotalReq= $db -> query ('SELECT * FROM post ORDER BY created_at DESC');
    
    return $postTotalReq->fetchAll(PDO :: FETCH_ASSOC);
}


?>   