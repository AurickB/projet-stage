<?php 
if(session_status()==PHP_SESSION_NONE){ // La session va durer une journée
    session_start([
        'cookie_lifetime' => 86400,
    ]);
}

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
    header('Location: account.php');
} else if (isset($_POST['envoi_form']) 
	&& $_POST['randomformOK']==$_SESSION['randomOk']){ // On envoie les données récupérées dans le formulaire dans la base de données avec une technique pour empêcher le renvoi du formulaire par actualisation de la page.
    require_once 'inc/functions.php';
	require_once 'inc/bddConfig.php';
	$id_user = $_SESSION['auth']['id_user'];
    $pdo = connect();
    $req = $pdo->prepare("INSERT INTO posts SET title = ?, content = ?, created_at = NOW(), id_user = $id_user");
    $req->execute([
        $_POST['title'],
        $_POST['content']
	]);
	$_SESSION['flash']['success'] = "L'article a bien été créé avec succès";	
	$_SESSION['randomOk'] = rand(100000,999999);
	unset($_POST);
	/**
	 * $_SESSION['randomOk'] contient un nombre aléatoire.
	 * Il est mis dans un input hidden du formulaire => il sera alors récupéré via $_POST['randomformOK'].
	 * Si on recharge la page $_SESSION['randomOk'] est modifié mais $_POST['randomformOK'] non.
	 */
    header('Location: news.php');
}
?>