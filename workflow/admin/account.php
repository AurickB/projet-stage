<?php
if(session_status()==PHP_SESSION_NONE){ // La session va durer une journée
    session_start([
        'cookie_lifetime' => 86400,
    ]);
}
require_once 'inc/functions.php';
require_once 'inc/header.php';
// On empêche l'accès à la page account.php si l'utilisateur ne s'est pas connecté avec ses identifiants.
if(!isset($_SESSION['auth'])){
    $_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'être sur cette page. Veuillez vous connecter";
	header('Location: login.php');
}

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
	<form action="post_account.php" method="post" enctype="multipart/form-data" class="">
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
require 'inc/footer.php';?>