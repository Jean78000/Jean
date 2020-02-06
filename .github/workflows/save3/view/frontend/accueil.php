<?php $title = 'Accueil'; ?>

<?php ob_start(); ?>






<h1 class="titreAccueil">Bienvenue sur le blog de Jean Forteroche</h1>
    <h2 class="titreAccueil2">Acteur et Ècrivain</h2>


<ul class="bmenu">
	<li><a href="index.php?action=accueil">Accueil</a></li>
	<li><a href="#">À propos</a></li>
	<li><a href="index.php?action=blog">Mon Blog</a></li>
    <li><a href="#">Contact</a></li>
    <li><a href="index.php?action=login">Connexion</a></li>
</ul>


<?php $content = ob_get_clean(); ?>


<?php require('view/template.php'); ?>
