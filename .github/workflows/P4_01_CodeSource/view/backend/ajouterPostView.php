<?php $title = 'Ajouter un article'; ?>

<?php ob_start();?>

<a href="index.php?action=blog&page=1" class="btn btn-outline-primary" id="prevButtonAddPostView"><i class="fas fa-home"></i>Page precedente</a>

    <form action="index.php?action=addPost" method="post" id="addPostForm">
        <label for='title'>Titre de l'épisode : </label><br/>
            <input type="text" name="addPostTitle"/><br/>
        <label for='content'>Texte de l'épisode : </label><br/>
            <textarea id="mytextarea" name='addPostContent'></textarea><br/>
            <input type="submit" value="Ajouter" id="addPostViewButtonAdd">
    </form>



<?php $content = ob_get_clean(); ?>

<?php require 'view/template.php';?>