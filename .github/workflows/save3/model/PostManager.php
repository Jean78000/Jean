<?php
namespace OpenClassrooms\Blog\Model; // La classe sera dans ce namespace


require_once("model/Manager.php");

class PostManager extends Manager {

    public function getPosts($start, $numberOfChapterPerPage) {   // faire une requete preparer ici avec prepare et execute

        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') 
        AS creation_date_fr FROM posts ORDER BY ID DESC LIMIT ' . $start . ',' . $numberOfChapterPerPage);

        return $req;
    }

    public function getPost($postId) {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr 
        FROM posts WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
    }

    public function getUpdatePost($title, $content, $creation_date, $postid) {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE posts SET title = ?, content = ?, creation_date = ? WHERE id = ?');
        $req->execute(array($title, $content, $creation_date, $postid));

        return $req;
    }

    public function postArticle($title, $content) {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO posts(title, content, creation_date) VALUES(?, ?, NOW())');
        $posted = $req->execute(array($title, $content));

        return $posted;
    }

    function getNumberOfChapters() {
        $db = $this->dbConnect(); 
        $req = $db->query('SELECT id FROM posts'); 
        $numberOfChapters = $req->rowCount();  
        return $numberOfChapters;
    }

}