<?php ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <base href="/url_rewriting/"> -->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="assets/css/pagination.css"> -->
    <link rel="stylesheet" href="assets/css/style1.css">
    <link rel="stylesheet" href="assets/css/style2.css">
    <link rel="stylesheet" href="assets/css/style3.css">
    <title>Public</title>
</head>

<body>
    <section id="top-navbar">
        <nav class="navbar navbar-fixed-top">
                <?php 
                if(isset($_GET['page']) || isset($_GET['page']) === 'actualite' || isset($_GET['page']) === 'contact'){
                ?>
                <h1 class="logo"><a href="public.php">
                        <div>centre <br>médical &<br> paramédical<br><i>les pyrénées - Muret</i></div>
                    </a></h1>
                <ul class="content">
                    <li class="">
                        <a href="public.php">
                            <h1>accueil</h1>
                        </a></li>
                    <li class="">
                        <a href="public.php?page=actualite">
                            <h1>actualités</h1>
                        </a></li>
                    <li class="">
                        <a href="public.php?page=contact">contact</a></li>
                </ul>
                <?php
                } else {
                    ?>
                <h1 class="logo"><a href="public.php">
                        <div>centre <br>médical &<br> paramédical <br><i>les pyrénées - Muret</i></div>
                    </a></h1>
                <ul class="content">
                    <li class="">
                        <a href="public.php?page=actualite">
                            <h1>actualités</h1>
                        </a></li>
                    <li class="">
                        <a href="#osteopathe" class="js-scrollTo">
                            <h1>ostéopathe</h1>
                        </a></li>
                    <li class="">
                        <a href="#infirmier" class="js-scrollTo">
                            <h1>infirmiers libéraux</h1>
                        </a></li>
                    <li class="">
                        <a href="#sage-femme" class="js-scrollTo">
                            <h1>sage femme</h1>
                        </a></li>
                    <li class="">
                        <a href="#psychologue" class="js-scrollTo">
                            <h1>psychologue</h1>
                        </a></li>
                    <li class="">
                        <a href="#reflexologue" class="js-scrollTo">
                            <h1>reflexologue</h1>
                        </a></li>
                    <li class="">
                        <a href="public.php?page=contact">contact</a></li>
                </ul>
                <?php
                }
                ?>
            </nav>
            <button role="button" type="button" class="menu-toggle" aria-label="navigation">&#9776</button>
       
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="assets/pagination.js"></script>
    <script type="text/javascript" src="assets/script.js"></script>
</body>

</html>