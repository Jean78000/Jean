
<?php $title = 'Welcome Admin'; ?>
<?php ob_start(); ?>


<div class="shadow-lg p-3 mb-5 bg-white rounded">
    <h1 id="titleWelcomeAdmin">Bienvenue Admin</h1>
    <h2 id="sousTitreWelcomeAdmin">Voici vos actions possible :</h2>
</div>


<ul class="menu-admin">
    <li class="ma-item"><a href="index.php?action=accueil">Retour Accueil du blog</a></li>
    <li class="ma-item"><a href="index.php?action=selectAddPostView">Créer un Article</a></li>
    <li class="ma-item"><a href="#">Modifier un Article</a></li>
    <li class="ma-item"><a href="#">Supprimer un Article</a></li>
    <li class="ma-item"><a href="#">Voir les Signalements</a></li>
</ul>


<h3 id="dernierTitreAdmin">Pour supprimer un article un bouton prévu à cet effet vous est reservé</h3>










<?php $content = ob_get_clean(); ?>
<?php require 'view/template.php';?>




