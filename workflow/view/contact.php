<?php 
ob_start();

// session_start();

?>
<section id="contact">
    <div class="content-wrapper">
        
        <!-- <?php if(isset($_SESSION['errors'])): 
        // Si il y a une erreurs on affiche le message.   
        ?>
        <div class="alert alert-danger">
            <?= implode('<br>', $_SESSION['errors']); ?>
        </div>
        <?php endif; ?>
        <?php if(isset($_SESSION['success'])): 
        // Si il y a une erreurs on affiche le message.   
        ?>
        <div class="alert alert-success">
            <p>Votre message a bien été envoyé</p>
        </div>
        <?php endif; ?> -->
        
        <form action="view/post_contact.php" method="post">
            <div class="form-group">
                <label for="inputemail">Adresse Email</label>
                <input type="text" class="form-control" id="inputemail" name="email" aria-describedby="emailHelp" value="<?= isset(($_SESSION['inputs']['email'])) ? $_SESSION['inputs']['email'] : ''; ?>">
                <small id="emailHelp" class="form-text text-muted">Nous ne partagerons jamais votre courriel avec qui que ce soit d'autre.</small>
            </div>
            <div class="form-group">
                <label for="inputname">Nom</label>
                <input type="text" class="form-control" id="inputname" name="name" value="<?= isset(($_SESSION['inputs']['name'])) ? $_SESSION['inputs']['name'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="selectprac">Selectionner un practicien</label>
                <select class="form-control" id="selectprac" name="select">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                </select>
            </div>
            <div class="form-group">
                <label for="inputcontent">Votre message</label>
                <textarea class="form-control" id="inputcontent" name="content"><?= isset(($_SESSION['input']['content'])) ? $_SESSION['input']['content'] : ''; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
        <h2>Debug :</h2>
        <?php var_dump($_SESSION);?>
    </div>
</section>


<?php 

// // Suppression des informations
// unset($_SESSION['inputs']);
// unset($_SESSION['success']);
// unset($_SESSION['errors']);

$content = ob_get_clean();

require_once 'frontend/template.php';
?>