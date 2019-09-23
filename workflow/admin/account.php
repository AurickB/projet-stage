<?php 
session_start();
require 'inc/functions.php';
require 'inc/header.php';

if(!isset($_SESSION['auth'])){
    $_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'être sur cette page";
    header('Location: login.php');
}
?>

<h1>Bienvenue</h1>

<div class="container">
	<form action="" method="post" enctype="multipart/form-data" class="">
		<div class="form-group">
			<label for="title">Titre</label>
			<input class="form-control" id="title" type="text" name="title">
		</div>
		<div class="form-group">
			<label for="content">Contenu</label>
			<textarea id="content" type="textarea" name="content" class="form-control"></textarea>
		</div>
		<div class="form-group">
			<label for="img">Image</label>
			<div class="">
				<input id="img" type="file" name="img" style="width : 100%;">
			</div>
		</div>
		<button type="submit" class="btn btn-primary">Créer un article</button>
	</form>
</div>

<?php require 'inc/footer.php'?>