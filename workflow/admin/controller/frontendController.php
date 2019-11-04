<?php
require_once 'model/frontendModel.php';

function flash(){
    $_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'être sur cette page. Veuillez vous connecter";
}

function displayLogin(){
    require 'view/login.php';
}

function displayAccount(){
    if(isset($_SESSION['auth'])){
        require 'view/account.php';
    } else {
        displayLogin();
    }
}

function displayRegister(){
    require 'view/register.php';
}

function displayPost(){
    // On met dans une variable le nombre d'articles que l'on souhaite afficher par page.
    $limit = 3;
    // On récupère les id de tous les articles
    $postTotalReq = selectPostId();
    // On retourne le nombre de lignes affectées par la dernière requête
    $postTotal = $postTotalReq->rowCount();
    // On compte le nombre de page total.
    $pageTotale = ceil($postTotal/$limit);
    if (isset($_GET['page']) && !empty($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $pageTotale){
        $_GET['page']=intval($_GET['page']); // On empêcher l'injection de caractère.
        $page = $_GET['page'];
    } else {
        $page = 1;
    }
    // On calcul le numéro du premier élément à appeler
    $start = ($page-1)*$limit;
    // La variable $posts récupère en valeur le tableau contenant toutes les lignes de la base de données
    $posts = getPost($start, $limit);
    require 'view/news.php';
}

function displayForget(){
    require 'view/forget.php';
}

function displayReset(){
    require 'view/reset.php';
}

function displayPage(){
    $page = $_GET['page'] ?? '404';
    switch ($page) {
        case 'account':
            displayAccount();
            break;
        case 'news':
            displayPost();
            break; 
        case 'register':
            displayRegister();
            break;
        case 'login':
            displayLogin();
            break; 
        case 'forget':
            displayForget();
            break;
        case  $page > 0:
            displayPost();
            break;   
        default:
            displayAccount();
            break;
    }
}
?>