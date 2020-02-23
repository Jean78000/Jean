<?php $title = 'Signalement'; ?>


<?php ob_start();?>
<div id="myBody">        

<?php
if (!empty($reported)) { ?>
    <h2 class="reportListTitle"> Il n'y a pas de commentaire signalés</h2>
<?php
} else { ?>  
    <h2 class="reportListTitle">Voici la liste des commentaires signalés</h2>
<?php 
}
?>

<a href="index.php?action=accueil" class="btn btn-outline-primary" id="reportListAccueilButton"><i class="fas fa-home"></i>Accueil</a>

<?php
while ($isReport = $reported->fetch()) {  
?>
    <div id="reportedComment">
        <h2>Ce commentaire a été signalé <?=$isReport['report']?> fois </h2>
        <h2>Auteur</h2><br />
            <p><?=$isReport['author']?></p>
        <h2>Commentaire</h2><br />
            <p><?=$isReport['comment']?></p>
        <div id="reportListButton">    
            <a href="index.php?action=delete&amp;id=<?=$isReport['post_id']?>&amp;idComment=<?=$isReport['id']?>"class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i>Supprimer</a>
            <a href="index.php?action=validate&amp;id=<?= $isReport['post_id']?>&amp;idComment=<?=$isReport['id']?>" class="btn btn-outline-success"><i class="fas fa-check"></i>Valider le commentaire</a>
        </div>
    </div>
<?php 
} 
?>
</div>
<?php $content = ob_get_clean(); ?>

<?php require 'view/template.php';?>