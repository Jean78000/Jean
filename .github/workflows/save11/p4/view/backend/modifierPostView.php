<?php $title = 'Modifier un article'; ?>



<?php ob_start();?>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<meta http-equiv="Content-Security-Policy" content="default-src 'none'; script-src 'self' *.tinymce.com *.tiny.cloud; 
    connect-src 'self' *.tinymce.com *.tiny.cloud blob:; img-src 'self' *.tinymce.com *.tiny.cloud data: blob:;
     style-src 'self' 'unsafe-inline' *.tinymce.com *.tiny.cloud; font-src 'self' *.tinymce.com *.tiny.cloud;" /> -->
    <script src="https://cdn.tiny.cloud/1/wakzdvc9fgy125bmu64guhp92ugc4domazpwj9hnwnoew9hu/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <!--taper l'api key à la place de no api key -->
    <script>
      tinymce.init({
        selector: '#mytextarea',
        forced_root_block : '',
        force_br_newlines : true,
        force_p_newlines : false,
      });
    </script>

  </head>


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

