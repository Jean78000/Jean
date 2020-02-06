<!DOCTYPE html>
<html>
<head>
<link href="public/css/style.css" rel="stylesheet" /> 

  <script src="https://cdn.tiny.cloud/1/wakzdvc9fgy125bmu64guhp92ugc4domazpwj9hnwnoew9hu/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
</head>
<body>
  <script>
    tinymce.init({
    selector: '#mytextarea',
      plugins: 'a11ychecker advcode casechange formatpainter linkchecker lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
      toolbar: 'a11ycheck addcomment showcomments casechange checklist code formatpainter pageembed permanentpen table',
      toolbar_drawer: 'floating',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
    });
  </script>

<p><a href="index.php">Retour à la liste des billets</a></p>

<div id="formAddPost">
    <form action="index.php?action=addPost" method="post">
        <label for='title'>Titre de l'épisode : </label><br/>
            <input type="text" name="addPostTitle"/><br/>
        <label for='content'>Texte de l'épisode : </label><br/>
            <textarea id="mytextarea" name='addPostContent'></textarea><br/>
            <input type="submit" value="Ajouter">
    </form>
</div>


</body>
</html>