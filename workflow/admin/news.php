<?php
if(session_status()==PHP_SESSION_NONE){ // La session va durer une journée
    session_start([
        'cookie_lifetime' => 86400,
    ]);
}
require_once 'inc/header.php';
require_once 'inc/bddConfig.php';

$pdo = connect();
// On met dans une variable le nombre d'article que l'on veut par page.
$postParPage = 3;
// On récupère tout les article
$postTotalReq = $pdo->query('SELECT id_post FROM posts');
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


$req = $pdo->query("SELECT * FROM posts JOIN users ON posts.id_user = users.id_user ORDER BY created_at DESC LIMIT $limit,$postParPage");
$posts = $req->fetchAll();

require_once 'inc/functions.php';
// debug($posts);

/**
 * Disposition des articles.
 */

echo '<section id=postAdmin>';
echo '<div class="container">';
if (empty($posts)){
    echo '</br></br></br><p>aucun article, la base de données est vide...</p>';
}
foreach ($posts as $post){
    // if ($post['img'] != null){
    //     echo '<div><img src="view/images/' . $travel['img'] . '"></div></br></br>' ;
    // }
    echo '<h2>' . $post['title'] . '</h2></br>';
    echo '<p>' . $post['content'] . '</p></br>';
    echo '<a href="news.php?idpost='.$post['id_post']. '&page=delete">Supprimer article</a><br>';
    echo '<br>';
}
echo '</div>';
echo '</section>';

if (isset($_GET['page']) && $_GET['page'] == 'delete'){
    require_once 'inc/functions.php';
    removePost($_GET['idpost']);
} 

/**
 *  Apparence de la pagination
 */

echo '<ul class="pagination">';
if ($pageActuelle!=1){ // Si la page actuelle est différente de 1 on crée la variable $precedent égale à $pageActuelle-1
    $precedent=$pageActuelle-1;
    echo '<li class="page-item">
    <a class="page-link" href="news.php?page='.$precedent.'" aria-disabled="true">Précédent</a>
    </li>';
}
for ($i=1; $i<=$pageTotale; $i++){
    echo '<li class="page-item"><a class="page-link" href="news.php?page='.$i.'">'.'page '.$i.'</a></li>';
}
if ($pageActuelle<$pageTotale){ // Tant que $pageActuelle est inférieur à $pageTotal on crée la variable $suivant.
    $suivant=$pageActuelle+1;
    echo' <li class="page-item">
    <a class="page-link" href="news.php?page='.$suivant.'" >Suivant</a>
    </li>';
}
echo '</ul>';
?>


<?php require_once 'inc/footer.php';?>