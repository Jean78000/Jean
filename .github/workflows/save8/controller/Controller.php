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

        public function listPosts($page) {

            $numberOfChapters = $this->postManager->getNumberOfChapters(); 

            $numberOfChapterPerPage = 5;  
            $numberOfPages = ceil($numberOfChapters / $numberOfChapterPerPage); 

            $start = ($page - 1) * $numberOfChapterPerPage;
            $posts = $this->postManager->getPosts($start, $numberOfChapterPerPage); 

            require('view/frontend/blog.php');
        }

        public function post() {

            $post = $this->postManager->getPost($_GET['id']);
            $comments = $this->commentManager->getComments($_GET['id']);

            if ($post) { 
                require('view/frontend/postView.php');
            }
            else  {
                throw new \Exception('aaaaaaaaaaaaaa');
            }
                               
        }

        public function addPostView() {

            require('view/backend/ajouterPostView.php');
        }

        public function addPost($title, $content) {

            $posted = $this->postManager->postArticle($title, $content);

            header('Location: index.php');
        }

        public function addComment($postId, $author, $comment) {

            $affectedLines = $this->commentManager->postComment($postId, $author, $comment);

            if ($affectedLines === false) {
                throw new Exception('Impossible d\'ajouter le commentaire !');
            }
            else {
                header('Location: index.php?action=post&id=' . $postId);
            }
        }

        public function selectPost($postId) {

            $post = $this->postManager->getPost($_GET['id']);

            require('view/backend/modifierPostView.php');
        }

        public function updatePost($title, $content, $creation_date, $postid) {

            $update = $this->postManager->getUpdatePost($title, $content, $creation_date, $postid);

            header('Location: index.php?action=post&id=' . $_GET['id']);
            require('view/backend/modifierPostView.php');
        }

        public function deleteApost($postId) {

            $delete = $this->postManager->getDeletePost($_GET['id']);

            header('Location: index.php?action=blog&page=1');
        }

        public function selectComment($postId, $idComment) {

            $comment = $this->commentManager->getComment($postId, $idComment);  
            
            require('view/backend/modifierView.php');
        }

        public function editComment($author, $comment,$comment_date, $idComment) {

            $update = $this->commentManager->getModifyComment($author, $comment, $comment_date, $idComment);

            header('Location: index.php?action=post&id=' . $_GET['id']);
            require('view/backend/modifierView.php');
        }

        public function deleteComment($idComment) {

            $delete = $this->commentManager->getDeleteComment($idComment);

            header('Location: index.php?action=post&id=' . $_GET['id']);
            require('view/backend/modifierView.php');
        }

        public function accueil() {

            require('view/frontend/accueil.php');
        }

        public function logIn() {

            require('view/backend/login.php');
        }

        public function compare($username, $password) {

            $user = $this->adminManager->signIn();


            if (password_verify($password, $user['password'])) {
                if ($user['role'] == 2) {
                    $_SESSION['admin'] = 'adminCo'; 
                    $_SESSION['signalement'] = $user['id'];?>
                    <script>
                        $(window).ready(function() {
                            $('#adminLogin').show();
                        });
                    </script>
                    <?php   
                    require('view/frontend/accueil.php');}
                if  ($user['role'] == 1) {
                    if (!isset($_SESSION['user'])) { 
                        $_SESSION['user'] = $_POST['username'];
                        $_SESSION['signalement'] = $user['id'];
                    }?>
                    <script>
                        $(window).ready(function() {
                            $('#userLogin').show();
                        });
                    </script>
                    <?php   
                    require('view/frontend/accueil.php');
                }
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

        public function aProposView() {

            require('view/frontend/propos.php');
        }

        public function register($pseudo, $mdp, $email) {

            $pseudo = htmlentities($pseudo);
            $mdp = htmlentities(password_hash($mdp, PASSWORD_DEFAULT));
            $email = htmlentities($email);

            $register = $this->adminManager->subscribe($pseudo, $mdp, $email); 

            require('view/frontend/accueil.php'); 
            ?>
            <script>
                $(window).ready(function() {
                    $('#alertSuccess').show();
                });
            </script>
            <?php
        }

        public function logOut() {

            $_SESSION = array();
            session_destroy();

            require('view/frontend/accueil.php');
        }

        public function showReport() {

            $reported = $this->adminManager->getReportList(); 

            require('view/backend/reportList.php');
        }


        public function report($idComment) {

                $reported = $this->adminManager->doReport($idComment); 
                $post = $this->postManager->getPost($_GET['id']);
                $comments = $this->commentManager->getComments($_GET['id']);
             //   $_SESSION['report'] = $_GET['idComment'];

                require('view/frontend/postView.php');
                    ?>
                    <script>
                        $(window).ready(function() {
                            $('#successReport').show();
                        });
                    </script>
                    <?php
            
        }

        public function signalements($idComment, $idUser) {
            $this->adminManager->getSignalements($idComment, $idUser); 
        }
        


        public function killTheReport($idComment) {

            $kill = $this->adminManager->killReport($idComment);
            $reported = $this->adminManager->getReportList(); 

            require('view/backend/reportList.php');
        }

        public function contactForm() {

            require('view/frontend/contact.php');
        }

        public function showRole() {

            $roles = $this->adminManager->getRoles();

            require('view/backend/roles.php');
        }

        public function createAdmin() {

            $uproles = $this->adminManager->upRoles(($_GET['id']));
            $roles = $this->adminManager->getRoles();

            require('view/backend/roles.php');

        }

        public function degradeAdmin() {

            $degrade = $this->adminManager->downRoles(($_GET['id']));
            $roles = $this->adminManager->getRoles();

            require('view/backend/roles.php');
        }

        public function deleteUserAdmin($idUser) {

            $delete = $this->adminManager->getDeleteUserAdmin(($_GET['id']));
            $roles = $this->adminManager->getRoles();

            require('view/backend/roles.php');
        }

        public function contactPost() {

            $message = htmlentities($_POST['contactContent']);
            $subject = htmlentities($_POST['contactContentTitle']);
            $email = htmlentities($_POST['email']);
            $headers = "From: $email" . "\r\n" ."Content-type: text/html; charset=UTF-8";
            
            mail('tenaka@gmx.fr', $subject, $message, $headers);
            require('view/frontend/accueil.php');
            ?>
            <script>
                $(window).ready(function() {
                    $('#mailAlert').show();
                });
            </script>
            <?php
        }



}

?>


