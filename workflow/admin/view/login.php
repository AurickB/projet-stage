<?php
require_once 'frontend/header.php';
require_once 'inc/bddConfig.php'; 

// On permet de conserver le cookie malgrés la suppression de la session si l'utilisateur a cliquer le bouton "Se souvenir de moi"
if (isset($_COOKIE['remember'])){
    $remember_token = $_COOKIE['remember']; 
    $array = explode("==", $remember_token);
    $user_id = $array[0];
    $pdo = connect();
    $req = $pdo->prepare('SELECT * FROM users WHERE id_user = ?');
    $req->execute([$user_id]);
    $user = $req->fetch();
    if ($user){
        $expected = $user_id . '==' . $user['remember_token'] . sha1($user_id . 'totolelapin');
        if ($expected == $remember_token){
            $_SESSION['auth'] = $user;
            header('Location: account.php');  
        }
    }
}
?>
<h1>Se connecter</h1>
<form action='' method='post'>
    <div class="form-group">
        <label for="InputEmail">Email</label>
        <input type="text" class="form-control" name='email' id="InputEmail" aria-describedby="emailHelp"
            placeholder="Entrer votre email">
    </div>
    <div class="form-group">
        <label for="InputPassword">Mot de passe <a href="forget.php">(Mot de passe oublié)</a></label>
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