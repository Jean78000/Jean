<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>

<h1>Mon super blog !</h1>
<p>Articles les plus récent :</p>


<?php

while ($data = $posts->fetch()) {
?>
    <div class="news">
        <h3>
            <?= $data['title'] ?>
            <em>le <?= $data['creation_date_fr'] ?></em>
        </h3>
        
        <p>
            <?= $data['content'] ?>
            <br />
            <em><a href="index.php?action=post&amp;id=<?= $data['id'] ?>">Voir les Commentaires</a></em>
            <em><a id="editPostLien" href="index.php?action=modifierPostView&amp;id=<?= $data['id'] ?>">Modifier l'article</a></em>
            <em><a id="addPost" href="index.php?action=selectAddPostView">Ajouter un article</a></em>
            <!--<em><a id="accueil" href="index.php?action=accueil">Accueil</a></em>  -->

        </p>
    </div>
<?php } ?>

<div id="pagin">
<?php
    for ($i = 1; $i <= $numberOfPages; $i++) {
        if ($i == $_GET['page']) {
            echo $i . ' '; //  enléve le lien sur la page sur laquelle on est pour se reperer visuelement
        } else {
            echo '<a href="index.php?action=listPosts&page=' . $i . '">' . $i . '</a> ';
          }
    }
?>
</div>

<?php
$posts->closeCursor();
?>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>




