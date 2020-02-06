<?php $title = 'Modifier un article'; ?>



<?php ob_start();?>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<meta http-equiv="Content-Security-Policy" content="default-src 'none'; script-src 'self' *.tinymce.com *.tiny.cloud; 
    connect-src 'self' *.tinymce.com *.tiny.cloud blob:; img-src 'self' *.tinymce.com *.tiny.cloud data: blob:;
     style-src 'self' 'unsafe-inline' *.tinymce.com *.tiny.cloud; font-src 'self' *.tinymce.com *.tiny.cloud;" /> -->
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <!--taper l'api key à la place de no api key -->
    <script>
      tinymce.init({
        selector: '#mytextarea',
        height: 500
      });
    </script>

  </head>


    <p><a href="index.php">Retour à la liste des billets</a></p>
<div id="formUpdatePost">
    <form action="index.php?action=editPost&amp;id=<?=$_GET['id']?>" method="post">
        <label for='title'>Titre de l'épisode : </label><br/>
            <input name="nv_title" type="text" value="<?=htmlspecialchars($post['title'])?>"/><br/>
        <label for='title'>Date et heure de l'épisode : </label><br/>
            <input name="nv_date" type="text" value="<?=htmlspecialchars($post['creation_date_fr'])?>"/><br/>
        <label for='content'>Texte de l'épisode : </label><br/>
            <textarea id="mytextarea" name='nv_content'><?=$post['content']?></textarea><br/>
            <input type="submit" value="Edit">
    </form>
</div>


<?php $content = ob_get_clean(); ?>

<?php require 'view/template.php';?>