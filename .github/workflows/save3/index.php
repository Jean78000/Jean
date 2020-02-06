<!DOCTYPE html>

<?php
require('controller/frontend.php');

try { // On essaie de faire des choses
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            if (isset($_GET['page']) and !empty($_GET['page']) and $_GET['page'] > 0) {
                $_GET['page'] = intval($_GET['page']);
                $currentPage = $_GET['page'];
            } else {
                $currentPage = 1; 
            }
            listPosts($_GET['page']);
        }
        if ($_GET['action'] == 'blog') {

        }
        if ($_GET['action'] == 'modifierView') {
            if (isset($_GET['id']) && $_GET['id'] > 0 && isset($_GET['idComment']) && $_GET['idComment'] > 0) {
                selectComment($_GET['id'], $_GET['idComment']); // pré rempli le formulaire pour modifier le commentaire
            }
        }
        if (($_GET['action'] == 'edit') && (isset($_POST['nv_author'])) && (isset($_POST['nv_comment']))) {
            if (isset($_GET['id']) && $_GET['id'] > 0 && isset($_GET['idComment']) && $_GET['idComment'] > 0) {
                editComment($_POST['nv_author'], $_POST['nv_comment'], date('Y-m-d H:i:s'), $_GET['idComment']);
            }
        }
        if (($_GET['action'] == 'delete') && (isset($_GET['id']) && $_GET['id'] > 0 && isset($_GET['idComment']) && $_GET['idComment'] > 0)) {
            deleteComment($_GET['idComment']);
        }
        if ($_GET['action'] == 'modifierPostView') {
            selectPost($_GET['id']);
        }
        if (($_GET['action'] == 'editPost') && (isset($_GET['id']) && $_GET['id'] > 0)) {
            updatePost($_POST['nv_title'], $_POST['nv_content'], date('Y-m-d H:i:s'), $_GET['id']);
            }
        if ($_GET['action'] == 'accueil') {
            accueil();
            }
        if ($_GET['action'] == 'login') {
            logIn();
            }
        if ($_GET['action'] == 'adminLogin') {
            if (isset($_POST['username']) AND isset($_POST['password'])) {
                compare($_POST['username'], $_POST['password']);
            }           
        }
        
        elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                post();
            }
            else {
                // Erreur ! On arrête tout, on envoie une exception, donc au saute directement au catch
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        if ($_GET['action'] == 'selectAddPostView') {
            addPostView();
        }
        if ($_GET['action'] == 'addPost') {
                if (!empty($_POST['addPostTitle']) && !empty($_POST['addPostContent'])) {
                    addPost($_POST['addPostTitle'], $_POST['addPostContent']);
                }
        }
        elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                }
                else {
                    // Autre exception
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
            else {
                // Autre exception
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
    }
    else {
        accueil();
        //listPostAccueil();
       // listPosts(1);
    }
}
catch(Exception $e) {
    $errorMessage = $e->getMessage();
    require('view/errorView.php');
}


