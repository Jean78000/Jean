<?php $title = 'Contact'; ?>


<?php ob_start();?>

<a href="index.php?action=accueil" class="btn btn-outline-primary" id="contactAccueilButton"><i class="fas fa-home"></i>Retour à l'accueil</a>

<?php 


?> 

    <h2 class="formContactTitle">Formulaire de contact</h2>
    <form action="index.php?action=contactPost" method="post" id="contactForm">
        <label class="contactFormLabel">Pseudo</label>
            <input type="text" name="pseudo" class="contactFormInput" maxlength="20" value="<?= !empty($pseudo) ? $pseudo : null ?>" /><br />
        <label class="contactFormLabel">Email</label><br />
            <input type="email" name="email" class="contactFormInput"  value="<?= !empty($email) ? $email : null ?>" /><br />
        <label class="contactFormLabel">Sujet du message</label><br />
            <input type="text" name="subject" class="contactFormInput" maxlength="35" value="<?= !empty($subject) ? $subject : null ?>"/><br />
        <label class="contactFormLabel">Saisir votre message</label><br />
            <textarea id="contactContent" name="content" maxlength="255" value="<?= !empty($content) ? $content : null ?> "></textarea>
        <input type="submit" value="Envoyer" id="contactSubmit" />
    </form>



    <div id="myContactBody">
    </div>






<?php $content = ob_get_clean(); ?>

<?php require 'view/template.php';?>



