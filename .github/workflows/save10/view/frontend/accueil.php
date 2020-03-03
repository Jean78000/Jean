<?php $title = 'Accueil'; ?>

<?php ob_start(); ?>

<div id="alertSuccess" class="alert alert-success alert-dismissible" role="alert">
    <strong>Felicitation, votre compte est creer</strong>
    <button type="button" class="close" data-dismiss="alert">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div id="adminLogin" class="alert alert-success alert-dismissible" role="alert">
        <strong>Bienvenue Admin</strong>
        <button type="button" class="close" data-dismiss="alert">
            <span aria-hidden="true">&times;</span>
        </button>
</div>

<div id="userLogin" class="alert alert-success alert-dismissible" role="alert">
        <strong>Bienvenue Utilisateur</strong>
        <button type="button" class="close" data-dismiss="alert">
            <span aria-hidden="true">&times;</span>
        </button>
</div>

<div id="mailAlert" class="alert alert-success alert-dismissible" role="alert">
        <strong>Email Envoyé</strong>
        <button type="button" class="close" data-dismiss="alert">
            <span aria-hidden="true">&times;</span>
        </button>
</div>

<h1 class="titreAccueil">Billet simple pour l'Alaska</h1>
<h2 class="titreAccueil">JEAN FORTEROCHE</h2>



<ul class="menu">
	<li><a href="index.php?action=propos">À propos</a></li>
	<li><a href="index.php?action=blog&page=1">Articles</a></li>
  <li><a href="index.php?action=contact">Contact</a></li>
  <li><a href="index.php?action=login">Connexion</a></li>
</ul>

<div id="bodyMobileAccueil">

</div>

<?php $content = ob_get_clean(); ?>


<?php require('view/template.php'); ?>
