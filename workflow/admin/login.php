<?php 
session_start(); 
require 'inc/functions.php';
require 'inc/header.php'
?>

<?php 
// On vérifie si le compte existe uniquement si l'utilisateur a entré les informations.
if(!empty($_POST) && !empty($_POST['email']) && !empty($_POST['password'])){
    debug($_POST);
    require 'inc/bddConfig.php';
    $pdo = connect();
    $req = $pdo->prepare('SELECT * FROM user WHERE email = :email AND  password = :password confirmed_at IS NOT NULL');
    $req->execute([
        'password' => $_POST['password'],
		'email' => $_POST['email']  
    ]);
    $user = $req->fetch();

    $_SESSION['auth'] = $user;
    $_SESSION['flash']['success'] = 'Vous êtes connecté';
    header('Location: account.php');
    
    // if (password_verify($_POST['password'], $user->password)){
    //     $_SESSION['auth'] = $user;
    //     $_SESSION['flash']['success'] = 'Vous êtes connecté';
    //     header('Location: account.php');
    //     exit();

    // } else {
    //     $_SESSION['flash']['danger'] = 'Mot de passe ou identifiant incorrect';
    // }
     
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
        <label for="InputPassword">Mot de passe</label>
        <input type="password" class="form-control" name='password' id="InputPassword" placeholder="Password">
    </div>
    <button type="submit" class="btn btn-primary">Me connecter</button>
</form>


<?php require 'inc/footer.php'?>