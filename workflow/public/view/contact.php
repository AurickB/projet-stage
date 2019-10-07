<?php
require_once 'frontend/header.php';
?>
<section id="contact-form">
	<div class="content-wrapper">
	<h1 class="page-header">Contact</h1>
		<?php if(isset($_SESSION['errors'])):
		// Si il y a une erreurs on affiche le message.   
		?>
		<div class="alert alert-danger">
			<?= implode('<br>', $_SESSION['errors']); ?>
		</div>
		<?php endif; ?>
		<?php if(isset($_SESSION['success'])==1): 
		// Si le message est envoyé sans erreur.   
		?>
		<div class="alert alert-success">
			<p>Votre message a bien été envoyé</p>
		</div>
		<?php endif; ?>
		
		<form action="view/post_contact.php" method="post">
			<div class="form-group">
				<label for="inputemail">Votre adresse e-mail</label>
				<input type="text" class="form-control" id="inputemail" name="email" aria-describedby="emailHelp" value="<?= isset(($_SESSION['inputs']['email'])) ? $_SESSION['inputs']['email'] : ''; ?>">
				<small id="emailHelp" class="form-text text-muted">Nous ne partagerons jamais votre courriel avec qui que ce soit d'autre.</small>
			</div>
			<div class="form-group">
				<label for="inputname">Votre nom</label>
				<input type="text" class="form-control" id="inputname" name="name" value="<?= isset(($_SESSION['inputs']['name'])) ? $_SESSION['inputs']['name'] : ''; ?>">
			</div>
			<div class="form-group">
				<label for="inputphone">Votre numéro de téléphone</label>
				<input type="text" class="form-control" id="inputphone" name="phone" spellcheck="false" value="<?= isset(($_SESSION['inputs']['phone'])) ? $_SESSION['inputs']['phone'] : ''; ?>" placeholder="Format accepté : 06 01 02 03 04, 0601020304, 06-01-02-03-04, 06.01.02.03.04">
				<small id="emailHelp" class="form-text text-muted">Nous ne partagerons jamais votre numéro de téléphone avec qui que ce soit d'autre.</small>
			</div>
			<div class="form-group">
				<label for="inputservice">Sélectionner un praticien</label>
				<select class="form-control" id="inputservice" name="service">
				<option selected>Choix...</option>
				<option value="0">Osthépathe</option>
				<option value="1">Infirmière - Jacquin</option>
				<option value="2">Infirmier - Camboulives</option>
				<option value="3">Infirmière - Papy</option>
				<option value="4">Sage-Femme</option>
				<option value="5">Psychologue</option>
				<option value="6">Réflexologue</option>
				<option value="7">Test</option>
				</select>
			</div>
			<div class="form-group">
				<label for="inputcontent">Votre message</label>
				<textarea class="form-control" id="inputcontent" name="content"><?= isset(($_SESSION['inputs']['content'])) ? $_SESSION['inputs']['content'] : ''; ?></textarea>
			</div>
			<button type="submit" class="btn">Envoyer</button>
		</form>
	</div>
</section>
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
require_once 'frontend/footer.php';
?>