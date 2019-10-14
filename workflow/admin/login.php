<?php
session_start();
require_once 'inc/header.php';

// On vérifie si le compte existe uniquement si l'utilisateur a entré les informations.
if(!empty($_POST) && !empty($_POST['email']) && !empty($_POST['password'])){
    require_once 'inc/functions.php';
    require_once 'inc/bddConfig.php';
    $pdo = connect();
    // Avant la connexion on vérifie si l'utilisateur a bien valider son compte
    $req = $pdo->prepare('SELECT * FROM users WHERE email = :email AND confirmed_at IS NOT NULL');
    $req->execute(['email' => $_POST['email']]);
    $user = $req->fetch();
    // On vérifie si le mot de passe entré par l'utilisateur est le même que celui présent dans la base de données.
    if(password_verify($_POST['password'],$user['password'])){
        $_SESSION['auth'] = $user;
        $_SESSION['flash']['success'] = "Vous êtes bien connecté";
        // Création des cookies
        if (isset($_POST['remember'])){
            $remenber_token = str_random(250);
            $pdo->prepare('UPDATE users SET rermenber_token = ? WHERE id_user = ?')->execute([$remenber_token, $user['id']]);
            setcookie('remember', $remenber_token . sha1($user['id'] . 'totolelapin'), time() + 60 * 20);
        }
        header('Location: account.php');
        exit();
    } else {
        $_SESSION['flash']['danger'] = "Identifiant ou mot de passe incorrect";
    }
}
?>
<h1>Se connecter</h1>
<form action='' method='post'>
    <div class="form-group">
        <label for="InputEmail">Email</label>
        <input type="text" class="form-control" name='email' id="InputEmail" aria-describedby="emailHelp"
            placeholder="Enter email">
    </div>
    <div class="form-group">
        <label for="InputPassword">Mot de passe <a href="forget.php">(Mot de passe oublié)</a></label>
        <input type="password" class="form-control" name='password' id="InputPassword" placeholder="Password">
    </div>
    <div class="form-group pb-2">
        <label>
            <input type="checkbox" name="remember" value="1"> Se souvenir de moi
        </label>    
    </div>
    <button type="submit" class="btn btn-primary">Me connecter</button>
</form>


<?php require 'inc/footer.php'?>