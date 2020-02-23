<?php

namespace OpenClassrooms\Blog\Model;

class Manager {
    protected function dbConnect() {
        $db = new \PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', 'monmotdepasse', 
        array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
        return $db;
    }
}

