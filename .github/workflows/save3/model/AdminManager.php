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


// $resultat['password']








}


?>