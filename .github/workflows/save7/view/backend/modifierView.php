<?php $title = 'Modifier le commentaire'; ?>


<?php ob_start();?>

<h2>Modifier</h2>

<a href="index.php?action=post&amp;id=<?= $_GET['id'] ?>" class="btn btn-outline-primary"><i class="fas fa-home"></i>Page precedente</a>


<form action="index.php?action=edit&amp;id=<?=$_GET['id']?>&amp;idComment=<?=$_GET['idComment']?>" method="post">
    <div>
        <label for="author">Auteur</label><br />
        <input type="text" id="nv_author" name="nv_author" value="<?=$comment['author']?>" />
    </div>
    <div>
        <label for="comment">Commentaire</label><br />
        <textarea id="nv_comment" name="nv_comment"><?=$comment['comment']?></textarea>
    </div>
    <div>
        <input type="submit" value="Edit" id="submitModifyComment">
    </div>
</form>

<?php $content = ob_get_clean(); ?>

<?php require 'view/template.php';?>
