<?php $title = 'Contact'; ?>


<?php ob_start();?>

<a href="index.php?action=accueil" class="btn btn-outline-primary" id="contactAccueilButton"><i class="fas fa-home"></i>Retour à l'accueil</a>

<?php if (isset($_SESSION['admin']) || isset($_SESSION['user'])) { ?> 

    <h2 class="formContactTitle">Formulaire de contact</h2>
    <form action="index.php?action=contactPost" method="post" id="contactForm">
        <label class="contactFormLabel">Pseudo</label>
            <input type="text" name="contactName" class="contactFormInput" required/><br />
        <label class="contactFormLabel">Email</label><br />
            <input type="email" name="email" class="contactFormInput" required /><br />
        <label class="contactFormLabel">Sujet du message</label><br />
            <input type="text" name="contactContentTitle" class="contactFormInput" required/><br />
        <label class="contactFormLabel">Saisir votre message</label><br />
            <textarea rows="6" cols="75" id="contactContent" name="contactContent" required></textarea>
        <input type="submit" value="Envoyer" id="contactSubmit" />
    </form>

<?php } else { ?>

    <h2 class="formContactTitle">Vous devez etre inscrit pour utiliser le formulaire de contact</h2>
    <div id="myContactBody">
    </div>

<?php } ?>


<?php $content = ob_get_clean(); ?>

<?php require 'view/template.php';?>



