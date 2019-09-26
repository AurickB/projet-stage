<?php 
/**
 * On va permette à l'utilisateur de récupérer son mot de passe si celui-ci a été perdu
 * 
 * On vérifie l'existe du compte uniquement si l'utilisateur a entré des informations.
 */
if(!empty($_POST) && !empty($_POST['email'])){

    require_once 'inc/functions.php';
    require_once 'inc/bddConfig.php';

    $pdo = connect();
    $req = $pdo->prepare('SELECT * FROM user WHERE email = :email AND confirmed_at IS NOT NULL') ;
    $req->execute(['email' => $_POST['email']]);
    $user = $req->fetch();

    if($user){
        session_start();
        // Création d'un nouveau token
        $reset_token = str_random(60);
        // Modification de la base de données
        $pdo->prepare('UPDATE user SET reset_token = ? reset_at = NOW() WHERE id = ?')->execute([$reset_token,$user['id']]);
        $_SESSION['flash']['success'] = "Les instructions afin de changer votre mot de passe vous ont été envoyées par email";
        // On récupère l'id de l'utilisateur
        $user_id = $user['id']; 
        // Envoie du mail de rappel.
        $mail = mail($_POST['email'], 'Réinitialisation de votre mot de passe', "Afin de valider réinitialiser votre mot de passe merci de cliquer sur ce lien suivant :\n\nhttp://localhost:8888/projet_stage/workflow/admin/reset.php?id=$user_id&token=$reset_token");

        header('Location: account.php');
        exit();
    } else {
        $_SESSION['flash']['danger'] = "Aucun compte ne correspond a cette adresse email";
    }
}
?>
<?php require 'inc/header.php'?>

<h1>Mot de passe oublié</h1>
<form action='' method='post'>
    <div class="form-group">
        <label for="InputEmail">Email</label>
        <input type="email" class="form-control" name='email' id="InputEmail" aria-describedby="emailHelp"
            placeholder="Enter email">
    </div>
    <button type="submit" class="btn btn-primary">Me connecter</button>
</form>


<?php require 'inc/footer.php'?>