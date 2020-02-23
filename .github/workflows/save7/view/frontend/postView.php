<?php $title = htmlspecialchars($post['title']);?>

<?php ob_start();?>

<div id="successReport" class="alert alert-warning alert-dismissible" role="alert">
  <strong>Le commentaire a été signaler</strong>
    <button type="button" class="close" data-dismiss="alert">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div id="isAlreadyReport" class="alert alert-danger alert-dismissible" role="alert">
  <strong>Vous avez deja signaler ce commentaire</strong>
    <button type="button" class="close" data-dismiss="alert">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<a href="index.php?action=blog&page=1" class="btn btn-outline-primary" id="postViewBackButton"><i class="fas fa-list"></i>Retour à la liste des billets</a>

<?php if (isset($_SESSION['admin']) || isset($_SESSION['user'])) { ?> 
            <a href="index.php?action=deconnexion" id="decoButton" class="btn btn-outline-warning"><i class="fas fa-sign-out-alt"></i>Deconnexion</a>
<?php } ?>

<h1 id="postViewTitle"><?= $post['title']?></h1>
    <div data-aos="fade-down"
        data-aos-easing="linear"
        data-aos-duration="1200">
       <div id="postAndCommentsView">
            <h3>
                <?=htmlspecialchars($post['title'])?>
                <em>le <?=$post['creation_date_fr']?></em>
            </h3>

            <p>
                <?=nl2br($post['content'])?>
            </p>
        </div>
    </div>
    
<?php

var_dump($_SESSION['report']);

var_dump($_SESSION['admin']);


var_dump($_SESSION['user']);

while ($comment = $comments->fetch()) { ?>
    <div data-aos="fade-up"data-aos-duration="2000">
        <div id="commentDiv">

            <p><strong><?=htmlspecialchars($comment['author'])?></strong> le <?=$comment['comment_date_fr']?></p>
            <p><?=nl2br(htmlspecialchars($comment['comment']))?></p>
            
   

            <?php
            if (!isset($_SESSION['user'])) {
                $_SESSION['user'] = null;
            }
            if ((($_SESSION['user']) === ($comment['author'])) OR isset($_SESSION['admin'])) { ?>

                <a href="index.php?action=modifierView&amp;id=<?=$post['id']?>&amp;idComment=<?=$comment['id']?>"class="btn btn-outline-secondary"><i class="fas fa-edit"></i>Modifier</a>
                <a href="index.php?action=delete&amp;id=<?=$post['id']?>&amp;idComment=<?=$comment['id']?>"class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i>Supprimer</a>
           <?php  
           if ($_SESSION['report'] != $comment['id']) { ?>
                <a href="index.php?action=signaler&amp;id=<?=$post['id']?>&amp;idComment=<?=$comment['id']?>"class="btn btn-outline-info"><i class="fas fa-flag"></i></i>Signaler</a>
            <?php } ?>
            <?php } ?>
        </div>
    </div>
<?php 
}

if (isset($_SESSION['user']) OR isset($_SESSION['admin'])) { ?>

    <div data-aos="flip-down">
        <form id="sendCommentForm" action="index.php?action=addComment&amp;id=<?=$post['id']?>" method="post">
            <fieldset class="border p-2">
                <legend class="w-auto">Envoyez votre commentaire :</legend>
                <div>
                    <label for="author" id="labelAuthor">Auteur</label><br />
                    <input type="text" id="author" name="author" />
                </div>
                <div>
                    <label for="comment">Commentaire</label><br />
                    <textarea rows="6" cols="75" id="comment" name="comment"></textarea>
                </div>
                <div>
                    <input type="submit" value="Envoyer"/>
                </div>
            </fieldset>
        </form>
    </div>

<?php } ?>

<?php $content = ob_get_clean();?>

<?php require('view/template.php'); ?>

