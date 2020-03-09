<?php $title = 'Modifier un article'; ?>

<?php ob_start();?>

  <a href="index.php?action=blog&page=1"class="btn btn-outline-primary" id="modifyPostBackButton"><i class="fas fa-home"></i>Retour à la liste des billets</a>
  <div id="formUpdatePost">
    <form action="index.php?action=editPost&amp;id=<?=$_GET['id']?>" method="post" id="modifyPostForm">
        <label for='title'>Titre de l'épisode : </label><br/>
            <input name="nv_title" type="text" value="<?=$post['title']?>"/><br/>
        <label for='title'>Date et heure de l'épisode : </label><br/>
            <input name="nv_date" type="text" value="<?=$post['creation_date_fr']?>"/><br/>
        <label for='content'>Texte de l'épisode : </label><br/>
            <textarea id="mytextarea" name='nv_content'><?=$post['content']?></textarea><br/>
            <input type="submit" value="Edit" id="editPostButton">
    </form>
  </div>


<?php $content = ob_get_clean(); ?>

<?php require 'view/template.php';?>

