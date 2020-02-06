<?php $title = htmlspecialchars($post['title']);?>

<?php ob_start();?>

<h1>Mon super blog !</h1>
    <p><a href="index.php">Retour à la liste des billets</a></p>

    <div class="news">
        <h3>
            <?=htmlspecialchars($post['title'])?>
            <em>le <?=$post['creation_date_fr']?></em>
        </h3>

        <p>
            <?=nl2br($post['content'])?>
        </p>
    </div>

<h2>Commentaires</h2>
    <form action="index.php?action=addComment&amp;id=<?=$post['id']?>" method="post">
        <div>
            <label for="author">Auteur</label><br />
            <input type="text" id="author" name="author" />
        </div>
        <div>
            <label for="comment">Commentaire</label><br />
            <textarea rows="10" cols="75" id="comment" name="comment"></textarea>
        </div>
        <div>
            <input type="submit" />
        </div>
    </form>

<?php
while ($comment = $comments->fetch()) {
?>
    <p><strong><?=htmlspecialchars($comment['author'])?></strong> le <?=$comment['comment_date_fr']?></p>
    <p><?=nl2br(htmlspecialchars($comment['comment']))?></p>
    <button class="button"><a href="index.php?action=modifierView&amp;id=<?=$post['id']?>&amp;idComment=<?=$comment['id']?>">Modifier</a></button>
    <button class="button"><a href="index.php?action=delete&amp;id=<?=$post['id']?>&amp;idComment=<?=$comment['id']?>">Supprimer</a></button>
<?php
}
?>

<?php $content = ob_get_clean();?>

<?php require 'view/template.php';?>

