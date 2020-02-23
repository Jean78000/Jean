<?php

session_start(); ?>

<!DOCTYPE html>

<?php
use \OpenClassrooms\Blog\Controller\Controller;

require_once('controller/Controller.php');

class Routes {

    public function __construct() {

        $this->controller = new Controller();
    }

    function router() {

        try { 
            if (isset($_GET['action'])) {
                if ($_GET['action'] == 'blog') {
                    if (isset($_GET['page']) and !empty($_GET['page']) and $_GET['page'] > 0) {
                        $_GET['page'] = intval($_GET['page']);
                        $currentPage = $_GET['page'];
                    } else {
                        $currentPage = 1; 
                    }
                    $this->controller->listPosts($_GET['page']);
                }
                if ($_GET['action'] == 'modifierView') {
                    if (isset($_GET['id']) && $_GET['id'] > 0 && isset($_GET['idComment']) && $_GET['idComment'] > 0) {
                        $this->controller->selectComment($_GET['id'], $_GET['idComment']); // pré rempli le formulaire pour modifier le commentaire
                    }
                }
                if (($_GET['action'] == 'edit') && (isset($_POST['nv_author'])) && (isset($_POST['nv_comment']))) {
                    if (isset($_GET['id']) && $_GET['id'] > 0 && isset($_GET['idComment']) && $_GET['idComment'] > 0) {
                        $this->controller->editComment($_POST['nv_author'], $_POST['nv_comment'], date('Y-m-d H:i:s'), $_GET['idComment']);
                    }
                }
                if (($_GET['action'] == 'delete') && (isset($_GET['id']) && $_GET['id'] > 0 && isset($_GET['idComment']) && $_GET['idComment'] > 0)) {
                    $this->controller->deleteComment($_GET['idComment']);
                }
                if ($_GET['action'] == 'modifierPostView') {
                    $this->controller->selectPost($_GET['id']);
                }
                if (($_GET['action'] == 'editPost') && (isset($_GET['id']) && $_GET['id'] > 0)) {
                    $this->controller->updatePost($_POST['nv_title'], $_POST['nv_content'], date('Y-m-d H:i:s'), $_GET['id']);
                }
                if (($_GET['action'] == 'deletePost') && (isset($_GET['id']) && $_GET['id'] > 0)) {
                    $this->controller->deleteApost($_GET['id']);
                }
                if ($_GET['action'] == 'propos') {
                    $this->controller->aProposView();
                }
                if ($_GET['action'] == 'signaler') {
                    $this->controller->report($_GET['idComment']);
                    $this->controller->signalements($_GET['idComment'],$_GET['idUser']);
                }
                if ($_GET['action'] == 'seeReport') {
                    $this->controller->showReport();
                }
                if ($_GET['action'] == 'validate') {
                    $this->controller->killTheReport($_GET['idComment']);
                }
                if ($_GET['action'] == 'seeRole') {
                    $this->controller->showRole();
                }
                if ($_GET['action'] == 'nommeAdmin') {
                    $this->controller->createAdmin();
                }
                if ($_GET['action'] == 'nommeUser') {
                    $this->controller->degradeAdmin();
                }
                if ($_GET['action'] == 'deleteUser') {
                    $this->controller->deleteUserAdmin($_GET['id']);
                }
                if ($_GET['action'] == 'accueil') {
                    $this->controller->accueil();
                }
                if ($_GET['action'] == 'subscribe') {
                    $this->controller->register($_POST['subscribeName'], $_POST['subscribePw'], $_POST['email']);
                }
                if ($_GET['action'] == 'contact') {
                    $this->controller->contactForm();
                }
                if ($_GET['action'] == 'contactPost') {
                    $this->controller->contactPost();
                }
                if ($_GET['action'] == 'login') {
                    $this->controller->logIn();
                }
                if ($_GET['action'] == 'adminLogin') {
                    if (isset($_POST['username']) AND isset($_POST['password'])) {
                        $this->controller->compare($_POST['username'], $_POST['password']);
                    }           
                }
                if ($_GET['action'] == 'deconnexion') {
                    $this->controller->logOut();
                }
                if ($_GET['action'] == 'post') {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        $this->controller->post();
                    }
                }
                if ($_GET['action'] == 'selectAddPostView') {
                    $this->controller->addPostView();
                }
                if ($_GET['action'] == 'addPost') {
                        if (!empty($_POST['addPostTitle']) && !empty($_POST['addPostContent'])) {
                            $this->controller->addPost($_POST['addPostTitle'], $_POST['addPostContent']);
                        }
                }
                elseif ($_GET['action'] == 'addComment') {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                            $this->controller->addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                        }
                    }
                }
            }
            else {
                $this->controller->accueil();
            }
        }
        catch(Exception $e) {
            echo $e->getMessage();
           //  $errorMessage = $e->getMessage();
         //    require('error.php');
        }
    }
}

