
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8=" crossorigin="anonymous"></script>

<?php
use \OpenClassrooms\Blog\Model\PostManager;
use \OpenClassrooms\Blog\Model\CommentManager;
use \OpenClassrooms\Blog\Model\AdminManager;

// Chargement des classes
require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/AdminManager.php');

function listPosts($page) {

    $postManager = new PostManager(); 
    $numberOfChapters = $postManager->getNumberOfChapters(); 

    $numberOfChapterPerPage = 5;  
    $numberOfPages = ceil($numberOfChapters / $numberOfChapterPerPage); 

    $start = ($page - 1) * $numberOfChapterPerPage;
    $posts = $postManager->getPosts($start, $numberOfChapterPerPage); 

    require('view/frontend/blog.php');
}

function post() {

    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    if ($post) { 
    require('view/frontend/postView.php');
    }
    else  //vue error 404
    { echo "Le chapitre n'existe pas";}
}

function addPostView() {

    require('view/backend/ajouterPostView.php');
}

function addPost($title, $content) {

    $postManager = new PostManager();
    $posted = $postManager->postArticle($title, $content);
    //$sucess = "<div class='alert alert-success'>Commentaire modifier</div>";

    header('Location: index.php');
}

function addComment($postId, $author, $comment) {

    $commentManager = new CommentManager();
    $affectedLines = $commentManager->postComment($postId, $author, $comment);

    //$sucess = "<div class='alert alert-success'>Commentaire ajouter</div>";
    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}

function selectPost($postId) {

    $postManager = new PostManager();
    $post = $postManager->getPost($_GET['id']);
    require('view/backend/modifierPostView.php');
}

function updatePost($title, $content, $creation_date, $postid) {

    $postManager = new PostManager();
    $update = $postManager->getUpdatePost($title, $content, $creation_date, $postid);

    header('Location: index.php?action=post&id=' . $_GET['id']);
    require('view/backend/modifierPostView.php');
}

function selectComment($postId, $idComment) {

    $commentManager = new CommentManager();
    $comment = $commentManager->getComment($postId, $idComment);  // on recupere le commentaires
    
    require('view/backend/modifierView.php');
}

function editComment($author, $comment,$comment_date, $idComment) {

    $commentManager = new CommentManager();
    $update = $commentManager->getModifyComment($author, $comment, $comment_date, $idComment);

    // $sucess = "<div class='alert alert-success'>Commentaire modifier</div>";
    header('Location: index.php?action=post&id=' . $_GET['id']);
    require('view/backend/modifierView.php');
}

function deleteComment($idComment) {

    $commentManager = new CommentManager();
    $delete = $commentManager->getDeleteComment($idComment);

    header('Location: index.php?action=post&id=' . $_GET['id']);
    require('view/backend/modifierView.php');
}

//function listPostAccueil() {

 //   header('Location: index.php?action=listPosts&page=1');
  //  require('view/frontend/accueil.php');
//}

function accueil() {

    require('view/frontend/accueil.php');
  //  header('Location: index.php?action=accueil');
  //  require('view/frontend/accueil.php');
}

function logIn() {
    require('view/backend/login.php');
}

function compare($username, $password) {
    $adminManager = new AdminManager();
    $admin = $adminManager->signIn();

    if (($_POST['username'] == $admin['pseudo']) && ($_POST['password'] == $admin['password'] )) {
        $_SESSION['admin'] = 'adminCo';
        require('view/frontend/accueil.php');
    }
    else {?>
    <script>
        $(window).ready(function() {
            $('#alertLogin').show();
        });
    </script>
  <?php require('view/backend/login.php');
    }
}

//function blogView() {
//    require('view/frontend/blog.php');
//}

function aProposView() {
    require('view/frontend/propos.php');
}

function register($pseudo, $mdp) {
    $adminManager = new AdminManager();
    $admin = $adminManager->subscribe($pseudo, $mdp); 

    require('view/frontend/accueil.php'); ?>
        <script>
        $(window).ready(function() {
            $('#alertSuccess').show();
        });
    </script>
    <?php

}

function logOut() {
    $_SESSION = array();
    session_destroy();
    accueil();
}

function showReport() {
    $adminManager = new AdminManager();
    $reported = $adminManager->getReportList(); 

    require('view/backend/reportList.php');
}

function report($idComment) {
    $adminManager = new AdminManager();
    $reported = $adminManager->doReport($idComment); 
    
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    require('view/frontend/postView.php');
    ?>
        <script>
            $(window).ready(function() {
                $('#successReport').show();
            });
        </script>
    <?php
}

function killTheReport($idComment) {
    $adminManager = new AdminManager();
    $kill = $adminManager->killReport($idComment);

    $adminManager = new AdminManager();
    $reported = $adminManager->getReportList(); 

    require('view/backend/reportList.php');
}









?>
