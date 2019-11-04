<?php
require_once 'frontend/header.php';?>

<?php
echo '<section id="actualite">';
echo '<div class="content-wrapper">';
echo '<div class="item-list">';
echo '<ul class="">';
foreach($posts as $post) {
  echo '<div class="post-header-full" style="background-image: url(../images/' . $post['img'] . ');"><h1>' . $post['title'] . '</h1><div class="date-actus">' .$post['created_at']. '</div></div>';
  echo  '<li class="">';
  echo  '<div class="zone-actu">';
  echo  '<div class="update-actu">';
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

