<?php require_once 'frontend/header.php';?>

<section id="login">
    <div class="content-wrapper">
        <h1>S'inscrire</h1>
        <!-- Affichage des différents messages d'erreurs généré par l'utilisateur -->
        <?php if (isset($_SESSION['errors'])): ?>
        <div class="alert alert-danger">
            <p>Vous n'avez pas rempli le formulaire correctement</p>
            <?= implode('<br>', $_SESSION['errors']); ?>
        </div>

        <?php endif; ?>
        <form action='' method='post'>
            <div class="form-group">
                <label for="InputEmail">Email</label>
                <input type="text" class="form-control" name='email' value="<?= isset(($_SESSION['inputs']['email'])) ? $_SESSION['inputs']['email'] : ''; ?>", id="InputEmail" aria-describedby="emailHelp" placeholder="Entrer votre email">
            </div>
            <div class="form-group">
                <label for="InputPassword">Mot de passe</label>
                <input type="password" class="form-control" name='password' id="InputPassword" placeholder="Entrer votre mot de passe : 6 caracteres minimum" >
            </div>
            <div class="form-group">
                <label for="ConfirmPassword">Confirmer votre mot de passe</label>
                <input type="password" class="form-control" name='passConfirm' id="ConfirmPassword" placeholder="Confirmer votre mot de passe">
            </div>
            <div class="form-group">
				<label for="inputservice">Sélectionner un service</label>
				<select class="form-control" id="inputservice" name="service">
				<option selected>Choix...</option>
				<option value="Osthépathe">Osthépathe</option>
				<option value="Infirmier">Infirmier</option>
				<option value="Sage-Femme">Sage-Femme</option>
				<option value="Psychologue">Psychologue</option>
				<option value="Reflexologue">Reflexologue</option>
				</select>
			</div>
            <button type="submit" class="btn btn-primary">M'inscrire </button>
        </form>
    </div>
</section>

<?php
if(isset($_SESSION['inputs'])){
	unset($_SESSION['inputs']);
}
if(isset($_SESSION['success'])){
	unset($_SESSION['success']);
}
if(isset($_SESSION['errors'])){
	unset($_SESSION['errors']);
} 
require_once 'frontend/footer.php';?>

