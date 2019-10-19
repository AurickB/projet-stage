<?php
if(session_status()==PHP_SESSION_NONE){
    session_start();
}

require_once 'controller/frontendController.php';

if (isset($_GET['page']) && $_GET['page'] == 'actualites'){
    displayPost($_GET['id']);
} else if (isset($_GET['page'])){
    displayPage();
} else {
    displayHome();
}
?>