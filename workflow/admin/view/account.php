<?php
//require_once 'inc/functions.php';
require_once 'frontend/header.php';

//debug($_SESSION['auth']);
if(isset($_SESSION['errors'])){ // Si il y a une erreurs on affiche le message.
?>
	<div class="alert alert-danger">
		<?= implode('<br>', $_SESSION['errors']); ?>
	</div>
<?php 
}
?>

<h1>Bienvenue <?= $_SESSION['auth']['email']?></h1>

<?php //debug($_SESSION)?>

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
		<button type="submit" name="envoi_form" class="btn btn-primary">Créer un article</button>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<input type="hidden" name="randomformOK" value="<?php echo $_SESSION['randomOk']; ?>" />
		</form>
	</form>
</div>

<?php
// Suppression des informations
if(isset($_SESSION['inputs'])){
	unset($_SESSION['inputs']);
}
if(isset($_SESSION['success'])){
	unset($_SESSION['success']);
}
if(isset($_SESSION['errors'])){
	unset($_SESSION['errors']);
}
require 'frontend/footer.php';?>