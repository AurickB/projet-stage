<?php
require_once 'frontend/header.php';?>

<?php
echo '<section id="actualite">';
echo '<div class="content-wrapper">';
echo '<h1 class="page-header">Actualités</h1>';
echo '<div class="item-list">';
echo '<ul class="">';
foreach($posts as $post) {
  echo  '<li class="">';
  echo  '<div class="zone-actu">';
  echo  '<div class="update-actu">';
  echo  '<div class="date-actus">' .$post['created_at']. '</div>';
  echo  '<p>Cabinet Les Pyrénnées - Actualites</p>';
  echo  '</div>';
  echo  '<div class="titre-actus"><h1>' . $post['title'] . '</h1></div>';
  echo  '<div class="content-actus"><p>' . $post['content']. '</p></div>';
  echo  '<div class="btn-actu"><a href="index.php?page=actualite"><p>Retour</p></a></div>';
  echo  '</div>';
  echo  '</li>';
};
echo '</ul>';
echo'</div>';
echo'</div>';
echo '</section>';
?>

<?php require_once 'frontend/footer.php';?>

