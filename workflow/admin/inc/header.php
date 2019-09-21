<?php 
// Si il n'y a pas de session ouverte on en démarre une.
if (session_status() == PHP_SESSION_NONE){
    session_start();
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="../assets/css/style1.css">
    <link rel="stylesheet" href="../assets/css/style2.css">
    <link rel="stylesheet" href="../assets/css/style3.css">
    <title>Administration</title>
</head>
<body>
<section id="top">
    <div class="content-wrapper">
        <nav class="navbar navbar-fixed-top">
            <h1 class="logo"><a href="#">
                    <div>centre <br>paramédical <br><i>les pyrénées - Muret</i></div>
                    </a></h1>
            <ul class="content">
                <li class="">
                    <a href="register.php">
                        <h1>S'inscrire</h1>
                    </a></li>
                <li class="">
                    <a href="login.php" class="js-scrollTo">
                        <h1>Se connecter</h1>
                    </a></li>
            </ul>
        </nav>
        <button role="button" type="button" class="menu-toggle" aria-label="navigation">&#9776</button>
    </div>
</section>

<div class="container">

    <?php if (isset($_SESSION['flash'])): ?>
        <?php  foreach ($_SESSION['flash'] as $key => $message) : ?>
            <div class="alert alert-<?= $type;?>">
                <?= $message?>;
            </div>
        <?php endforeach; ?>
        <!-- On supprime les messages d'erreur -->
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>
      

    
  
