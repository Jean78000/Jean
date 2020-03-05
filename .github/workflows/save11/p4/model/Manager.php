<?php

namespace OpenClassrooms\Blog\Model;

class Manager {
    protected function dbConnect() {
        $db = new \PDO('***;***;charset=utf8', '***', '***', 
        array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
        return $db;
    }
}

