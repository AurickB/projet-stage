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

function displayNews(){
    // On met dans une variable le nombre d'article que l'on veut par page.
    $postParPage = 3;
    // On récupère les id de tous les article
    $postTotalReq = selectID();
    $postTotal = $postTotalReq->rowCount();
    // On compte le nombre de page total.
    $pageTotale = ceil($postTotal/$postParPage);

    if (isset($_GET['page']) && !empty($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $pageTotale){
        $_GET['page']=intval($_GET['page']); // On empêcher l'injection de caractère.
        $pageActuelle = $_GET['page'];
    } else {
        $pageActuelle = 1;
    }

    $limit = ($pageActuelle-1)*$postParPage;
    $posts = getNew($limit, $postParPage);
    
    require 'view/news.php';
}

function displayPage(){
    $page = $_GET['page'] ?? '404';
    switch ($page) {
        case 'account':
            displayAccount();
            break;
        case 'news':
            displayNews();
            break; 
        case 'register':
            displayRegister();
            break;
        case 'login':
            displayLogin();
            break; 
        case  $page > 0:
            displayNews();
            break;   
        default:
            displayAccount();
            break;
    }
}
?>