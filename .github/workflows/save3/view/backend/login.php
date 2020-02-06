<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link href="public/css/style.css" rel="stylesheet" /> 
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8=" crossorigin="anonymous"></script>


<div id="container">
    <form id="test" action="index.php?action=adminLogin" method="POST">
        <h1>Connexion</h1>
            <label><b>Nom d'utilisateur</b></label>
                <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>
            <label><b>Mot de passe</b></label>
                <input type="password" placeholder="Entrer le mot de passe" name="password" required>
                <input type="submit" id='submit' value='LOGIN' >
    </form>
</div>

<script type="text/javascript">

    $(window).click(function() {                                                 // permet de revenir sur la page d'accueil
        window.location.replace("index.php?action=accueil");                        // quand l'utilisateur click en dehors du formulaire
    });
    
    $('#test').click(function(event) {
    event.stopPropagation();
    });


</script>

<div id="alertLogin" class="alert alert-danger" role="alert">
  <strong>Utilisateur ou mot de passe incorrecte</strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

