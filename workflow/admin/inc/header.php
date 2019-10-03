<?php
if(session_status()==PHP_SESSION_NONE){
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
    <title>Administration</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="logout.php">Administation</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <?php if(isset($_SESSION['auth'])): ?>
                <li class="nav-item">
                <a class="nav-link" href="news.php">Articles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Déconnexion</a>
                </li>
                <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="register.php">S'inscrire</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Se connecter</a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <div class="container">

        <?php if (isset($_SESSION['flash'])): ?>
        <?php  foreach ($_SESSION['flash'] as $type => $message) : ?>
        <div class="alert alert-<?= $type;?>">
            <?= $message?>;
        </div>
        <?php endforeach; ?>
        <!-- On supprime les messages d'erreur -->
        <?php unset($_SESSION['flash']); ?>
        <?php endif; ?>