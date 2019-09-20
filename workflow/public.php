<?php 

require_once 'controller/frontendController.php';

if (isset($_GET['page'])){
    displayPage();
} else {
    displayHome();
}



?>