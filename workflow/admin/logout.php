<?php
if(session_status()==PHP_SESSION_NONE){ // La session va durer une journée
    session_start([
        'cookie_lifetime' => 86400,
    ]);
}

unset($_SESSION['auth']);
// On déruit le cookie.
setcookie('remember', NULL, -1);

$_SESSION['flash']['success']= 'Vous êtes déconnecté';

header('Location: login.php');