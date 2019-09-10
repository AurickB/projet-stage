<?php 
session_start ();
require_once 'controller/frontendController.php';


// if (isset($_POST['title']) && isset($_POST['content'])){
//     displayPostContact();
// }
// else 
if (isset($_GET['page'])){
    displayPage();
} else {
    displayMain();
}

?>