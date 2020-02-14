<?php $title = 'Error 404'; ?>


<?php ob_start();?>

<div id="myBody3">

    <h1>404</h1>



    <p>Desole mais Jean n'a pas encore écris la page que vous cherchez :)</p>



    <p style="font-size:100px">&#128549;</p>







</div>

<?php $content = ob_get_clean(); ?>

<?php require 'view/template.php';?>
