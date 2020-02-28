<?php $title = 'Mes articles'; ?>

<?php ob_start(); ?>

    <h1 id="blogTitle">Blog de Jean Forteroche</h1>
        <p id="blogP">Voici les articles les plus récents !</p>
        <a href="index.php?action=accueil" id="backAccueil" class="btn btn-outline-primary"><i class="fas fa-home"></i>Retour à l'accueil</a>
        <?php if (isset($_SESSION['admin']) || isset($_SESSION['user'])) { ?> 
            <a href="index.php?action=deconnexion" id="decoButton" class="btn btn-outline-warning"><i class="fas fa-sign-out-alt"></i>Deconnexion</a>
        <?php } ?>
        <?php if (isset($_SESSION['admin'])) { ?> 
        <a href="index.php?action=selectAddPostView" id="addPostButton" class="btn btn-outline-success"><i class="fas fa-feather-alt"></i>Créer un article</a>
        <?php } ?>
        <?php if (isset($_SESSION['admin'])) { ?> 
        <a href="index.php?action=seeReport" id="reportButton" class="btn btn-outline-info"><i class="fas fa-flag"></i>Signalement</a>
        <?php } ?>
        <?php if (isset($_SESSION['admin'])) { ?> 
        <a href="index.php?action=seeRole" id="roleButton" class="btn btn-outline-light"><i class="fas fa-user-tag"></i>Rôles</a>
        <?php } ?>
<?php

while ($data = $posts->fetch()) {
?>
<div data-aos="flip-left"
     data-aos-easing="ease-out-cubic"
     data-aos-duration="2000">
<div class="container-fluid">
    <div class="row">
    <div class="news">
        <h3>
            <?= $data['title'] ?>
            <em>le <?= $data['creation_date_fr'] ?></em>
        </h3>
        
        <p class="col-md-10">
            <?= $data['content'] ?>
            <br />
            <a href="index.php?action=post&amp;id=<?= $data['id'] ?>" class="btn btn-outline-success"><i class="fas fa-search"></i>Voir l'article et les Commentaires</a>
        <?php if (isset($_SESSION['admin'])) { ?> 
            <a href="index.php?action=deletePost&amp;id=<?= $data['id'] ?>" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i>Supprimer l'article</a>
                                        <?php } // var_dump($_SESSION); ?>
        <?php if (isset($_SESSION['admin'])) { ?> 
            <a href="index.php?action=modifierPostView&amp;id=<?= $data['id'] ?>" class="btn btn-outline-secondary"><i class="fas fa-edit"></i>Modifier l'article</a>
                                        <?php } // var_dump($_SESSION); ?>
        </p>
    </div>
</div>
</div class="row">

</div class="container-fluid">

<?php 
}
?>

<div id="pagin">
    <?php
        for ($i = 1; $i <= $numberOfPages; $i++) {
            if ($i == $_GET['page']) {
                echo '<font color="#d77d73"><b>['.$i.']</font>&nbsp;'; //  enléve le lien sur la page sur laquelle on est pour se reperer visuelement
            } else {
                echo '<a href="index.php?action=blog&page=' . $i . '">' . $i . '</a> ';
            }
        }
    ?>
</div>

<?php
$posts->closeCursor();
?>


<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>



