<?php 
require_once 'inc/header.php';
?>
<div style="padding-top :100px;">
<?php 
if (!empty($_POST)){
    $errors =array();

    if (empty($_POST['email']) || !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
        $errors['email']= "Votre adresse email n'est pas valide";
    }

    if (empty($_POST['password']) || $_POST['password'] != $_POST['passConfirm'] ){
        $errors['email']= "Vous devez rentrer un mot de passe valide";
    }


    if (empty($errors)){
        require_once 'inc/bddConfig.php';
        $pdo = connect();
        $req = $pdo->prepare("INSERT INTO user SET email = ?, password = ?");
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $req->execute ([
            $_POST['email'], 
            $password
        ]);
        die('Le compte a bien été crée.');
     }
    
    var_dump ($errors);
}
?>
</div>

<section id="login">
    <div class="content-wrapper">
        <h1>S'inscrire</h1>
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

<?php 
require_once 'inc/footer.php';
?>

