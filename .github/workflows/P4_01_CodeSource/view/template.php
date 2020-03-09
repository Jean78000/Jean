<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title><?= $title ?></title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link href='http://fonts.googleapis.com/css?family=Josefin+Slab' rel='stylesheet' type='text/css' />
        <link href="public/css/style.css" rel="stylesheet" /> 
        <link rel="shortcut icon" type="image/png" href="public/images/favicon.png" />
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <script src="https://cdn.tiny.cloud/1/wakzdvc9fgy125bmu64guhp92ugc4domazpwj9hnwnoew9hu/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <!--taper l'api key à la place de no api key -->
    <script>
      tinymce.init({
        selector: '#mytextarea',
        forced_root_block : '',
        force_br_newlines : true,
        force_p_newlines : false,
      });
    </script>

    </head>
    <body>

        <div class="page-content">

            <?= $content ?>

        </div>

        <script src="https://kit.fontawesome.com/4965c6fdf8.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

        <script>
            AOS.init();
        </script>    
    <footer>
        <p id="myFooter">Ce site est un projet de la formation Developpeur Web d'OpenClassrooms <br>
            © Copyright 2020 - Réaliser en PHP, POO et architecture MVC -</p>
    </footer>

    </body>

</html>