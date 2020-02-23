<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
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

<a href="index.php?action=blog&page=1" class="btn btn-outline-primary" id="prevButtonAddPostView"><i class="fas fa-home"></i>Page precedente</a>

<div id="formAddPost">
    <form action="index.php?action=addPost" method="post" id="addPostForm">
        <label for='title'>Titre de l'épisode : </label><br/>
            <input type="text" name="addPostTitle"/><br/>
        <label for='content'>Texte de l'épisode : </label><br/>
            <textarea id="mytextarea" name='addPostContent'></textarea><br/>
            <input type="submit" value="Ajouter" id="addPostViewButtonAdd">
    </form>
</div>



<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>