<?php 

function displayMain(){
    require 'view/main.php';
}

function displayContact(){
    require 'view/contact.php';
}

function displayActu(){
    require 'view/actualite.php';
}

// function displayPostContact(){
//     require 'view/post_contact.php';
// }

function displayPage(){
    switch ($_GET['page']) {
        case 'main':
            displayMain();
            break;
        case 'contact':
            displayContact();
            break;
        case 'actualite':
            displayActu();
            break;
        default:
            displayMain();
            break;
    }
}
?>