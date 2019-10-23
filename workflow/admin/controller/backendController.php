<?php
require_once 'model/backendModel.php';
require_once 'model/frontendModel.php';


function login(){
    if(!empty($_POST) && !empty($_POST['email']) && !empty($_POST['password'])){
        $user = getUserByEmail($_POST['email']);
    }
    if ($user){
        if(password_verify($_POST['password'],$user['password'])){
            $_SESSION['auth'] = $user;
            $_SESSION['flash']['success'] = "Vous êtes bien connecté";
            if ($_POST['remember']){
                $remember_token = str_random(250);
                remember($user['id_user'], $remember_token);
                setcookie('remember', $user['id_user'] . '==' . $remember_token . sha1($user['id_user'] . 'totolelapin'), time() + 60 * 60 * 24 * 7);
            }
            displayAccount();  
            exit();
        } else {
            $_SESSION['flash']['danger'] = "Identifiant ou mot de passe incorrect";
            displayLogin();
        }
    } else {
        displayLogin();
    }  
}

function addPost(){
    $errors=[];

    if(!isset($_POST['title']) || $_POST['title'] == ''){
        $errors['title'] = 'Vous n\'avez pas renseigné de titre';
    }

    if(!isset($_POST['content']) || $_POST['content'] == ''){
        $errors['content'] = 'Vous n\'avez pas renseigné de contenu';
    }

    if (!empty($errors)){
        // On envoie le tableau qui contient les erreurs.
        $_SESSION['errors'] = $errors;
        // On sauvegarde tous les champs renseignés afin de facilité l'utilisation.
        $_SESSION['inputs'] = $_POST;
        displayAccount();
    } else if (isset($_POST['envoi_form']) 
        && $_POST['randomformOK']==$_SESSION['randomOk']){ // On envoie les données récupérées dans le formulaire dans la base de données avec une technique pour empêcher le renvoi du formulaire par actualisation de la page.
        $id_user = $_SESSION['auth']['id_user'];
        setPost($id_user);
        $_SESSION['flash']['success'] = "L'article a bien été créé avec succès";	
        $_SESSION['randomOk'] = rand(100000,999999);
        unset($_POST);
        /**
         * $_SESSION['randomOk'] contient un nombre aléatoire.
         * Il est mis dans un input hidden du formulaire => il sera alors récupéré via $_POST['randomformOK'].
         * Si on recharge la page $_SESSION['randomOk'] est modifié mais $_POST['randomformOK'] non.
         */
        displayNews();
    }
}

// fonction qui appelle la fonction deletePost() en fonction de l'id de l'article et renvoie sur la page news.php après suppression du post.
function removePost($id){
    deletePost($id);
    header ('Location: index.php?page=news');
}

function addUser(){
    if (!empty($_POST)){
        $errors=[];
    
        // Vérification des erreurs.

        if (empty($_POST['email']) || !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
            $errors['email']= "Votre adresse email n'est pas valide";
        } else { // On vérifie si l'email n'est pas déjà utilisé pour un autre compte.
            $user = verifyEmail();
            if ($user){
                $errors['email'] = 'Cet email est déjà utilisé';
            }
        }
    
        if (empty($_POST['password']) || $_POST['password'] != $_POST['passConfirm'] || strlen($_POST['password'])< 6){
            $errors['password']= "Vous devez rentrer un mot de passe valide";
        }

        if (!empty($errors)){ 
            // On envoie le tableau qui contient les erreurs.
            $_SESSION['errors'] = $errors;
            // On sauvegarde tous les champs renseignés afin de facilité l'utilisation.
            $_SESSION['inputs'] = $_POST;
            header('Location: index.php?page=register');
        } else { // Si il n'y a pas d'erreur on ajoute l'utilisateur à la base de données.
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            // Déclaration d'un indentificateur d'une longueur de 60 caractère.
            $token = str_random(60);
            setUser($password, $token);            
            $_SESSION['flash']['success']= 'Un email de confirmation vous a été envoyé pour valider votre compte';
            header('Location: index.php?page=login');
            exit();
        }
    }
}

function confirm($user_id ,$token){
    $user = getUserById($user_id);
    if($user && $user['confirmation_token'] == $token){
        setToken($user_id);
        $_SESSION['flash']['success']= 'Votre compte est confirmé';
        $_SESSION['auth'] = $user;
        displayAccount();
    } else {
        $_SESSION['flash']['danger'] = "Ce token n'est plus valide";
        displayLogin();
    }
}


?>