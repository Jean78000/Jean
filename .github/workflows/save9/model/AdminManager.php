<?php

namespace OpenClassrooms\Blog\Model;

require_once("model/Manager.php");


class AdminManager extends Manager {

    public function signIn() {

        $db = $this->dbConnect();
        $req = $db->query('SELECT password, pseudo, role, id FROM user WHERE pseudo = "'. $_POST['username'] .'" ');
        $resultat = $req->fetch();

        return $resultat;
    }

    public function subscribe($pseudo, $mdp, $email) {

        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO user (pseudo, password, email) VALUES(?, ?, ?)');
        $req->execute(array($pseudo, $mdp, $email));

        return $req;
    }

    public function doReport($idComment) {

        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET report = report + 1 WHERE id = ?');
        $req->execute(array($idComment));

        return $req;
    }

    public function getSignalements($idComment, $idUser) {

            $db = $this->dbConnect();
            $req = $db->prepare('INSERT INTO signalements (id_comment, id_user) VALUES(?, ?)');
            $req->execute(array($idComment, $idUser));
    
    }

    public function signaleIt($idComment, $idUser) {

        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE signalements SET reported = reported + 1 WHERE id_comment = ? AND id_user = ?');
        $req->execute(array($idComment, $idUser));

        return $req;
    }

    public function countReport($idComment, $idUser) {

        $db = $this->dbConnect();
        $req = $db->prepare('SELECT COUNT(*) FROM signalements WHERE id_comment = ? AND id_user = ?'); 
        $req->execute(array($idComment, $idUser));
        $reportOrNot = $req->fetch(\PDO::FETCH_COLUMN);
        
        return $reportOrNot;
    }
    

    public function getReportlist() {

        $db = $this->dbConnect();
        $req = $db->query('SELECT id, post_id, author, report, comment FROM comments WHERE report > 0 ');

        return $req;
    }

    public function killReport($idComment) {

        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET report = 0 WHERE id = ?');
        $req->execute(array($idComment));

        return $req;
    }

    public function getRoles() {

        $db = $this->dbConnect();
        $req = $db->query('SELECT id, pseudo, email, role FROM user ');

        return $req;
    }

    public function upRoles($idUser) {

        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE user SET role = 2 WHERE id = ?');
        $req->execute(array($idUser));

        return $req;
    }

    public function downRoles($idUser) {

        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE user SET role =  1 WHERE id = ?');
        $req->execute(array($idUser));

        return $req;
    }
    
    public function getDeleteUserAdmin($idUser) {

        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM user  WHERE id = ?');
        $req->execute(array($idUser));

        return $req;
    }

    public function contactPost() {

            $message = htmlentities($_POST['content']);
            $subject = htmlentities($_POST['subject']);
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

    public function pseudoExist($pseudo) {

        $db = $this->dbConnect();
        $req = $db->prepare('SELECT COUNT(*) as exist FROM user WHERE pseudo = ?'); 
        $req->execute(array($pseudo));
        $exist = $req->fetch();

        return $exist;
    }
         

}
?>