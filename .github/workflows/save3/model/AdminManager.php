<?php

namespace OpenClassrooms\Blog\Model;
require_once("model/Manager.php");



class AdminManager extends Manager {

    public function signIn() {
        $db = $this->dbConnect();
        $req = $db->query('SELECT password, pseudo FROM admin ');
        $resultat = $req->fetch();

        return $resultat;
    }

    public function subscribe($pseudo, $mdp) {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO admin(pseudo, password) VALUES(?, ?)');
        $req->execute(array($pseudo, $mdp));
       // $resultat = $req->fetch();

        return $req;
    }

    public function doReport($idComment) {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET report = report + 1 WHERE id = ?');
        $req->execute(array($idComment));

        return $req;
    }

    public function getReportlist() {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, post_id, author, comment FROM comments WHERE report > 5 ');

        return $req;
    }

    public function killReport($idComment) {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET report = 0 WHERE id = ?');
        $req->execute(array($idComment));

        return $req;
    }


