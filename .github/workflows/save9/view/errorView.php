<?php $title = 'Erreur' ?>
 
<?php ob_start(); ?>
    <div id="error">       
        <h2>Cette page n'existe pas</h2>
        <p><a href="index.php">Retour à la liste des billets</a></p>
    </div>
<?php $content = ob_get_clean(); ?>