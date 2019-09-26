<?php 
session_start();

// Tableau d'erreurs.
$errors=[]; 
$emails=['aurickbelenus@gmail.com', 'bene.j31@gmail.com','celine-papy@hotmail.fr'];

// Vérification des informations contenues dans le formulaire.
if(!isset($_POST['name']) || $_POST['name'] == ''){
    $errors['name'] = 'Vous n\'avez pas renseigné votre nom';
}

if(!isset($_POST['email'])  || $_POST['email'] == '' || !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
    $errors['email'] = 'Vous n\'avez pas renseigné un email valide';
}

if(!isset($_POST['content'])  || $_POST['content'] == ''){
    $errors['content'] = 'Vous n\'avez pas renseigné votre message';
}

if (!isset($_POST['service']) || !isset($emails[$_POST['service']])){
    $errors['service'] = 'Le service que vous demandez n\'existe pas';
}

// Si on a des erreurs on redirige vers la page précédente.
if(!empty($errors)){
    // On envoie le tableau qui contient les erreurs.
    $_SESSION['errors'] = $errors;
    // On sauvegarde tous les champs renseignés afin de facilité l'utilisation.
    $_SESSION['inputs'] = $_POST;
    header('Location: ../public.php?page=contact');
// Si il n'y a pas d'erreurs on traite les informations.
} else {
    // Contenu du message.
    $message = $_POST['content'];
    // Expéditeur du message.
    $headers = 'FROM: ' . $_POST['email'];
    mail($emails[$_POST['service']], 'Formulaire de contact de ' . $_POST['name'], $message, $headers);
    // On retourne à la page contact
    header('Location: ../public.php?page=contact');
    // Envoie de message réussi
    $_SESSION['success']=1;
}
die();

?>