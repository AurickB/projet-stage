<?php  
require_once 'frontend/header.php';

?>
<h1>Mot de passe oublié</h1>
<form action='' method='post'>
    <div class="form-group">
        <label for="InputEmail">Email</label>
        <input type="email" class="form-control" name='email' id="InputEmail" aria-describedby="emailHelp"
            placeholder="Entrer votre email">
    </div> 
    <button type="submit" class="btn btn-primary">Valider</button>
</form>

<?php require_once 'frontend/footer.php'?> 
  