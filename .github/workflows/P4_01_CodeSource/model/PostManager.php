<?php

namespace OpenClassrooms\Blog\Model; 

require_once("model/Manager.php");


class PostManager extends Manager {

    public function getPosts($start, $numberOfChapterPerPage) {   

        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') 
        AS creation_date_fr FROM blog_posts ORDER BY creation_date DESC LIMIT ' . $start . ',' . $numberOfChapterPerPage);
        $req->execute(array($start, $numberOfChapterPerPage));

        return $req;
    }

    public function getPost($postId) {

        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr 
        FROM blog_posts WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();    // fetch va chercher 1 ligne de resultat

        return $post;
    }

    public function getUpdatePost($title, $content, $creation_date, $postid) {

        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE blog_posts SET title = ?, content = ?, creation_date = ? WHERE id = ?');
        $req->execute(array($title, $content, $creation_date, $postid));

        return $req;
    }

    public function postArticle($title, $content) {

        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO blog_posts(title, content, creation_date) VALUES(?, ?, NOW())');
        $posted = $req->execute(array($title, $content));

        return $posted;
    }

    function getNumberOfChapters() {

        $db = $this->dbConnect(); 
        $req = $db->query('SELECT id FROM blog_posts'); 
        $numberOfChapters = $req->rowCount(); 
         
        return $numberOfChapters;
    }

    public function getDeletePost($postId) {
        
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM blog_posts  WHERE id = ?');
        $req->execute(array($postId));

        return $req;
    }

}

