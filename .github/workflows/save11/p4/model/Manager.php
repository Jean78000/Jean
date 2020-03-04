<?php

namespace OpenClassrooms\Blog\Model;

class Manager {
    protected function dbConnect() {
        $db = new \PDO('mysql:host=kevincolyfalphaa.mysql.db;dbname=kevincolyfalphaa;charset=utf8', 'kevincolyfalphaa', 'Azerty78000', 
        array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
        return $db;
    }
}

