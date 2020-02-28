<?php

namespace OpenClassrooms\Blog\Model;

require_once("model/Manager.php");


class CommentManager extends Manager {

    public function getComments($postId) {

        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr
        FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($postId));

        return $comments;
    }

    public function postComment($postId, $author, $comment) {

        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($postId, $author, $comment));

        return $affectedLines;
    }

    public function getComment($postId, $idComment) {

        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, post_id, author, comment FROM comments WHERE post_id = ? AND id = ?');
        $req->execute(array($postId, $idComment));
        $comment = $req->fetch();

        return $comment;
    }

    public function getModifyComment($author, $comment, $comment_date, $idComment) {

        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET author = ?, comment = ?, comment_date = ? WHERE id = ?');
        $req->execute(array($author, $comment, $comment_date, $idComment));

        return $req;
    }

    public function getDeleteComment($idComment) {
        
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM comments  WHERE id = ?');
        $req->execute(array($idComment));

        return $req;
    }
    
}

