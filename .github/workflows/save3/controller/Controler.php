<?php namespace OpenClassrooms\Blog\Controller; ?>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8=" crossorigin="anonymous"></script>

<?php

use \OpenClassrooms\Blog\Model\PostManager;
use \OpenClassrooms\Blog\Model\CommentManager;
use \OpenClassrooms\Blog\Model\AdminManager;

require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/AdminManager.php');


class Controller {

    public function __construct() {

        $this->postManager = new PostManager();
        $this->commentManager = new CommentManager();
        $this->adminManager = new AdminManager();
    }

        function listPosts($page) {

            $numberOfChapters = $this->postManager->getNumberOfChapters(); 

            $numberOfChapterPerPage = 5;  
            $numberOfPages = ceil($numberOfChapters / $numberOfChapterPerPage); 

            $start = ($page - 1) * $numberOfChapterPerPage;
            $posts = $this->postManager->getPosts($start, $numberOfChapterPerPage); 

            require('view/frontend/blog.php');
        }

        function post() {



            $post = $this->postManager->getPost($_GET['id']);
            $comments = $this->commentManager->getComments($_GET['id']);

            if ($post) { 
            require('view/frontend/postView.php');
            }
            else  
            require('error.php');                        // faire un throw new exeption
        }

        function addPostView() {

            require('view/backend/ajouterPostView.php');
        }

        function addPost($title, $content) {

            $posted = $this->postManager->postArticle($title, $content);

            header('Location: index.php');
        }

        function addComment($postId, $author, $comment) {

            $affectedLines = $this->commentManager->postComment($postId, $author, $comment);

            if ($affectedLines === false) {
                throw new Exception('Impossible d\'ajouter le commentaire !');
            }
            else {
                header('Location: index.php?action=post&id=' . $postId);
            }
        }

        function selectPost($postId) {

            $post = $this->postManager->getPost($_GET['id']);
            require('view/backend/modifierPostView.php');
        }

        function updatePost($title, $content, $creation_date, $postid) {

            $update = $this->postManager->getUpdatePost($title, $content, $creation_date, $postid);

            header('Location: index.php?action=post&id=' . $_GET['id']);
            require('view/backend/modifierPostView.php');
        }

        function selectComment($postId, $idComment) {

            $comment = $this->commentManager->getComment($postId, $idComment);  
            
            require('view/backend/modifierView.php');
        }

        function editComment($author, $comment,$comment_date, $idComment) {

            $update = $this->commentManager->getModifyComment($author, $comment, $comment_date, $idComment);

            header('Location: index.php?action=post&id=' . $_GET['id']);
            require('view/backend/modifierView.php');
        }

        function deleteComment($idComment) {

            $delete = $this->commentManager->getDeleteComment($idComment);

            header('Location: index.php?action=post&id=' . $_GET['id']);
            require('view/backend/modifierView.php');
        }

        function accueil() {

            require('view/frontend/accueil.php');
        }

        function logIn() {
            require('view/backend/login.php');
        }

        function compare($username, $password) {

            $user = $this->adminManager->signIn();

            if (($_POST['username'] == $user['pseudo']) && ($_POST['password'] == $user['password'] ) && ($user['role'] == 2)) {
                $_SESSION['admin'] = 'adminCo'; ?>
                <script>
                    $(window).ready(function() {
                        $('#adminLogin').show();
                    });
                </script>
                <?php   
                require('view/frontend/accueil.php');

            } elseif  (($_POST['username'] == $user['pseudo']) && ($_POST['password'] == $user['password'] )) { ?>
                <script>
                    $(window).ready(function() {
                        $('#userLogin').show();
                    });
                </script>
                <?php   
                require('view/frontend/accueil.php');
            }
            else { ?>
                <script>
                    $(window).ready(function() {
                        $('#alertLogin').show();
                    });
                </script>
                <?php 
                require('view/backend/login.php');
            }
        }

        function aProposView() {

            require('view/frontend/propos.php');
        }

        function register($pseudo, $mdp) {

            $register = $this->adminManager->subscribe($pseudo, $mdp); 

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
            require('view/frontend/accueil.php');
        }

        function showReport() {

            $reported = $this->adminManager->getReportList(); 

            require('view/backend/reportList.php');
        }

        function report($idComment) {

            $reported = $this->adminManager->doReport($idComment); 
            
            $post = $this->postManager->getPost($_GET['id']);
            $comments = $this->commentManager->getComments($_GET['id']);

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

            $kill = $this->adminManager->killReport($idComment);
            $reported = $this->adminManager->getReportList(); 

            require('view/backend/reportList.php');
        }

        function contactForm() {

            require('view/frontend/contact.php');
        }

        function showRole() {

            $roles = $this->adminManager->getRoles();

            require('view/backend/roles.php');
        }

        function createAdmin() {

            $uproles = $this->adminManager->upRoles(($_GET['id']));
            $roles = $this->adminManager->getRoles();

            require('view/backend/roles.php');

        }

        function degradeAdmin() {

            $degrade = $this->adminManager->downRoles(($_GET['id']));
            $roles = $this->adminManager->getRoles();

            require('view/backend/roles.php');
        }

        function deleteUserAdmin($idUser) {

            $delete = $this->adminManager->getDeleteUserAdmin(($_GET['id']));
            $roles = $this->adminManager->getRoles();

            require('view/backend/roles.php');
        }
}

?>
