<?php
if(session_status()==PHP_SESSION_NONE){ // La session va durer une journée
    session_start([
        'cookie_lifetime' => 86400,
    ]);
}
require_once 'inc/header.php';
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

// On vérifie si le compte existe uniquement si l'utilisateur a entré les informations.
if(!empty($_POST) && !empty($_POST['email']) && !empty($_POST['password'])){
    require_once 'inc/functions.php';
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
        if ($_POST['remember']){ 
            $remember_token = str_random(250);
            $pdo->prepare('UPDATE users SET remember_token = ? WHERE id_user = ?')->execute([$remember_token, $user['id_user']]);
            setcookie('remember', $user['id_user'] . '==' . $remember_token . sha1($user['id_user'] . 'totolelapin'), time() + 60 * 60 * 24 * 7);
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


<?php require 'inc/footer.php'?>