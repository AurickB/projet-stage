<?php
if(session_status()==PHP_SESSION_NONE){ // La session va durer une journée
    session_start([
        'cookie_lifetime' => 86400,
    ]);
}
require_once "controller/frontendController.php";
require_once "inc/functions.php";

if (isset($_GET['sd'])){
    unset($_SESSION['auth']);
    setcookie('remember', NULL, -1);
    $_SESSION['flash']['success']= 'Vous êtes déconnecté';
    header ('Location: index.php');
} else if(isset($_GET['id']) && isset($_GET['token']) && $_GET['page'] == 'confirm'){
    require_once 'controller/backendController.php';
    $user_id = $_GET['id'];
    $token = $_GET['token'];
    confirm($user_id ,$token);
} else if(isset($_GET['id']) && isset($_GET['token']) && $_GET['page'] == 'reset'){
    require_once 'controller/backendController.php';
    $id = $_GET['id'];
    $reset_token = $_GET['token'];
    resetPassword($id ,$reset_token);
} else if (isset($_POST['email']) && $_GET['page'] == 'forget'){
    require_once 'controller/backendController.php';
    forget();
} else if (isset($_POST['title']) && isset($_POST['content'])){
    require_once 'controller/backendController.php';
    addPost();
} else if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['passConfirm'])){
    require_once 'controller/backendController.php';
    addUser();
} else if (isset($_POST['email']) && isset($_POST['password'])){
    require_once 'controller/backendController.php';
    login();
} else if(isset($_GET['page']) && !isset($_SESSION['auth']) && $_GET['page'] == 'account'){ // On redirige l'utilisateur vers la page login.php si celui-ci n'est pas authentifié.
    flash();
    displayLogin();
} else if (isset($_SESSION['auth']) && isset($_GET['page']) && $_GET['page'] == 'delete'){
    require_once 'controller/backendController.php';
    removePost($_GET['idpost']);
} else if (isset($_GET['page'])){
    displayPage();
} else {
    displayAccount();
}


