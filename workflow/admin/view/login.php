<?php
require_once 'frontend/header.php';

// On permet de conserver le cookie malgrés la suppression de la session si l'utilisateur a cliquer le bouton "Se souvenir de moi"

?>
<h1>Se connecter</h1>
<form action='' method='post'>
    <div class="form-group">
        <label for="InputEmail">Email</label>
        <input type="text" class="form-control" name='email' id="InputEmail" aria-describedby="emailHelp"
            placeholder="Entrer votre email">
    </div>
    <div class="form-group">
        <label for="InputPassword">Mot de passe <a href="index.php?page=forget">(Mot de passe oublié)</a></label>
        <input type="password" class="form-control" name='password' id="InputPassword" placeholder="Entrer votre mot de passe">
    </div>
    <div class="form-group pb-2">
        <label>
            <input type="checkbox" name="remember" value="1"> Se souvenir de moi
        </label>    
    </div>
    <button type="submit" class="btn btn-primary">Me connecter</button>
</form>


<?php require_once 'frontend/footer.php'?> 