<?php 
session_start();

// Tableau d'erreurs.
$errors=[]; 
$emails=['travostinopierre@gmail.com', 'bene.j31@gmail.com','m_camboulives@orange.fr','celine-papy@hotmail.fr','eleonore.helle@hotmail.fr','m.scafont@yahoo.fr','corentin.reflexologie@gmail.com', 'aurickbelenus@gmail.com'];

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

$telephone = $_POST['phone'];
if (preg_match("#^0[1-68]([-. ]?[0-9]{2}){4}$#", $telephone))
{ // On vérifie que la variable $telephone respecte la REGEX

    $meta_carac = array("-", ".", " ");
    // On enlève les caractères - et . ainsi que les espaces.
    $telephone = str_replace($meta_carac, "", $telephone);
    // On remet en forme le numéro de téléphone en ajoutant un espace tous les deux caractères.
	$telephone = chunk_split($telephone, 2, "\r");
}
else
    $errors['phone'] = "Veuillez rentrer un numéro de téléphone valide";

// Si on a des erreurs on redirige vers la page précédente.
if(!empty($errors)){
    // On envoie le tableau qui contient les erreurs.
    $_SESSION['errors'] = $errors;
    // On sauvegarde tous les champs renseignés afin de facilité l'utilisation.
    $_SESSION['inputs'] = $_POST;
    header('Location: ../public.php?page=contact');
// Si il n'y a pas d'erreurs on traite les informations.
} else {
    // Expéditeur du message.
    $to = $emails[$_POST['service']];
    // Sujet
    $subject = 'Formulaire de contact de ' . $_POST['name'];
    // Contenu du message.
    $message = $_POST['content'];
    mail($to, $subject, $message);
    // On retourne à la page contact
    header('Location: ../public.php?page=contact');
    // Envoie de message réussi
    $_SESSION['success']=1;
}
die();

?>