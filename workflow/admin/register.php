<?php
session_start();
require_once 'inc/functions.php';

if (!empty($_POST)){
    $errors=[];
    require_once 'inc/bddConfig.php';
    $pdo = connect();
    // Vérification des erreurs.
    if (empty($_POST['email']) || !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
        $errors['email']= "Votre adresse email n'est pas valide";
    } else {
        // On vérifie si l'email n'est pas déjà utilisé pour un autre compte.
        $req = $pdo->prepare('SELECT id FROM user WHERE email = ?');
        $req->execute([$_POST['email']]);
        $user = $req -> fetch(); 
        if ($user){
            $errors['email'] = 'Cet email est déjà utilisé';
        }
    }

    if (empty($_POST['password']) || $_POST['password'] != $_POST['passConfirm'] ){
        $errors['email']= "Vous devez rentrer un mot de passe valide";
    }

    // Si il n'y a pas d'erreur on ajoute l'utilisateur à la base de données.
    if (empty($errors)){
        $req = $pdo->prepare("INSERT INTO user SET email = ?, password = ?, confirmation_token = ?");
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        // Déclaration d'un indentificateur d'une longueur de 60 caractère.
        $token = str_random(60);
        $req->execute ([
            $_POST['email'], 
            $password,
            $token
        ]);
        // Permet de récupérer le dernier ID généré par $pdo.
        $user_id = $pdo->lastInsertId(); 
        // Envoie du mail de validation avec comme paramètre l'id et le token de l'utilisateur.
        $mail = mail($_POST['email'], 'Confirmation de votre compte', "Afin de valider votre compte merci de cliquer sur ce lien suivant :\n\nhttp://localhost:8888/projet_stage/workflow/admin/confirm.php?id=$user_id&token=$token");
        $_SESSION['flash']['success']= 'Un email de confirmation vous a été envoyé pour valider votre compte';
        header('Location: login.php');
        exit();
    }
}
?>

<?php require_once 'inc/header.php';?>

<section id="login">
    <div class="content-wrapper">
        <h1>S'inscrire</h1>
        <!-- Affichage des différents messages d'erreurs généré par l'utilisateur -->
        <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <p>Vous n'avez pas rempli le formulaire correctement</p>
            <ul>
                <?php  foreach($errors as $error){
                    ?>
                    <li><?=$error; ?></li>
                <?php 
                }
                ?>
            </ul>
        </div>

    <?php endif; ?>
        <form action='' method='post'>
            <div class="form-group">
                <label for="InputEmail">Email</label>
                <input type="text" class="form-control" name='email' id="InputEmail" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="InputPassword">Mot de passe</label>
                <input type="password" class="form-control" name='password' id="InputPassword" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="ConfirmPassword">Confirmer votre mot de passe</label>
                <input type="password" class="form-control" name='passConfirm' id="ConfirmPassword" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary">M'inscrire </button>
        </form>
    </div>
</section>

<?php require_once 'inc/footer.php';?>

