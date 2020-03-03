  
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link href="public/css/style.css" rel="stylesheet" />
<link rel="shortcut icon" type="image/png" href="public/images/favicon.png" />
<title>Login</title>

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
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


<?php $content = ob_get_clean(); ?>


<?php require('view/template.php'); ?>