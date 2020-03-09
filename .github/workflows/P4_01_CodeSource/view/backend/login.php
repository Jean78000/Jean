  
<?php $title = 'Login'; ?>

<?php ob_start(); ?>

<div id ="myBody2">
    <a href="index.php?action=accueil" id="back" class="btn btn-outline-primary"><i class="fas fa-home"></i>Retour à l'accueil</a>
    <div class="container">
        <form action="index.php?action=adminLogin" method="POST" id="loginForm">
            <h1>Connexion</h1>
                <label><b>Nom d'utilisateur</b></label>
                    <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>
                <label><b>Mot de passe</b></label>
                    <input type="password" placeholder="Entrer le mot de passe" name="password" required>
                    <input type="submit" id='submit' value='LOGIN' >
        </form>
    </div>
    <div id="alertLogin" class="alert alert-danger alert-dismissible" role="alert">
        <strong>Utilisateur ou mot de passe incorrecte</strong>
        <button type="button" class="close" data-dismiss="alert">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="container">
        <form action="index.php?action=subscribe" method="POST">
            <h1>Inscription</h1>
                <label><b>Nom d'utilisateur</b></label>
                    <input type="text" placeholder="Nom d'utilisateur" name="subscribeName" required>
                <label><b>Mot de passe</b></label>
                    <input type="password" placeholder="Mot de passe" name="subscribePw" required>
                <label><b>Email</b></label>
                    <input type="email" id="emailSubscribe" placeholder="Email" name="email" required>
                        <input type="submit" id='subscribe' value='INSCRIPTION' >
        </form>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require 'view/template.php';?>