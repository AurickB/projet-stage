<?php 
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style1.css">
    <link rel="stylesheet" href="css/style2.css">
    <title>Site du stage</title>
</head>

<body data-spy="scroll" data-target=".navbar" data-offset="50">
    <header id="top">
        <div class="content-wrapper">
            <nav class="navbar navbar-fixed-top">
                <h1 class="logo"><a href="index.php?page=home">
                        <div>centre <br>paramédical <br><i>les pyrénées</i></div>
                    </a></h1>
                <ul class="content">
                    <li class="">
                        <a href="#actualites" class="js-scrollTo">actualités</a></li>
                    <li class="">
                        <a href="#osteopathe" class="js-scrollTo">ostéopathe</a></li>
                    <li class="">
                        <a href="#infirmier" class="js-scrollTo">infirmiers libéraux</a></li>
                    <li class="">
                        <a href="#sage-femme" class="js-scrollTo">sage femme</a></li>
                    <li class="">
                        <a href="#psychologue" class="js-scrollTo">psychologue</a></li>
                    <li class="">
                        <a href="#reflexologue" class="js-scrollTo">reflexologue</a></li>
                    <li class="">
                        <a href="#contact" class="js-scrollTo">contact</a></li>
                </ul>
            </nav>
            <button role="button" type="button" class="menu-toggle" aria-label="navigation">&#9776</button>
        </div>
    </header>
    <?= $content;?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="script.js"></script>
</body>

</html>