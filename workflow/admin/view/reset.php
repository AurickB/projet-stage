<?php 
require_once 'frontend/header.php';

// On permet de conserver le cookie malgrés la suppression de la session si l'utilisateur a cliquer le bouton "Se souvenir de moi"

?>
<h1>Réinitialiser mon mot de passe</h1>
<form action='' method='post'>
    <div class="form-group">
        <label for="InputPassword">Mot de passe</label>
        <input type="password" class="form-control" name='password' id="InputPassword" placeholder="Entrer votre mot de passe : 6 caracteres minimum" >
    </div>
    <div class="form-group">
        <label for="ConfirmPassword">Confirmer votre mot de passe</label>
        <input type="password" class="form-control" name='passConfirm' id="ConfirmPassword" placeholder="Confirmer votre mot de passe">
    </div>
    <button type="submit" class="btn btn-primary">Valider</button>
</form>


<?php require_once 'frontend/footer.php'?> 
