<?php 
ob_start();
?>

<div id="data"></div>
<div id="page"></div>

<?php 

$content = ob_get_clean();


require_once 'frontend/template.php';

?>
