<?php
session_start();

unset($_SESSION['auth']);
// On déruit le cookie.
setcookie('remember', NULL, -1);

$_SESSION['flash']['success']= 'Vous êtes déconnecté';

header('Location: login.php');