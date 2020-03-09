<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="public/css/style.css" rel="stylesheet" />
    <link rel="shortcut icon" type="image/png" href="public/images/favicon.png" />
    <title>A propos</title>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>

<body>
<a href="index.php?action=accueil" class="btn btn-outline-primary" id="proposAccueilBtn"><i class="fas fa-home"></i>Retour à l'accueil</a>

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-pause="false">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100" src="public/images/image1.jpg" alt="1er slide image d'une aurore boreale">
            <div class="carousel-caption d-none d-md-block">
                <h5>Jean Forteroche est un acteur ecrivain originaire d'Alaska</h5>
                <a href="index.php?action=accueil" class="btn btn-outline-primary"><i class="fas fa-home"></i>Retour à l'accueil</a>
            </div>
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="public/images/image2.jpg" alt="image de montagne d'Alaska, glacier">
            <div class="carousel-caption d-none d-md-block">
                <h5>"Billet simple pour l'Alaska", son livre, vous fera voyagé à travers ses magnifiques paysages</h5>
                <a href="index.php?action=accueil" class="btn btn-outline-primary"><i class="fas fa-home"></i>Retour à l'accueil</a>
            </div>
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="public/images/image3.jpg" alt="paysage d'Alaska">
            <div class="carousel-caption d-none d-md-block">
                <h5>et vous fera decouvrir ce lieu oû la nature a encore toute sa place,</h5>
                <a href="index.php?action=accueil" class="btn btn-outline-primary"><i class="fas fa-home"></i>Retour à l'accueil</a>
            </div>
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="public/images/image4.jpg" alt="Chien loup husky">
            <div class="carousel-caption d-none d-md-block">
                <h5>si ces quelques mots vous donne envie, n'attendez plus, </h5>
                <a href="index.php?action=accueil" class="btn btn-outline-primary"><i class="fas fa-home"></i>Retour à l'accueil</a>
            </div>
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="public/images/image5.jpg" alt="Paysage d'Alaska mer et glacier">
            <div class="carousel-caption d-none d-md-block">
                <h5>et laissez vous guider, venez lire les articles</h5>
                <a href="index.php?action=accueil" class="btn btn-outline-primary"><i class="fas fa-home"></i>Retour à l'accueil</a>
            </div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<script>
    $('.carousel').carousel({
        interval: 4000,
    });
</script>

</body>


</html>