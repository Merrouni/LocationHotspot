<?php
/**
 * Created by PhpStorm.
 * User: A.Alami
 * Date: 13/02/14
 * Time: 10:44
 */

require_once 'Connection.php';
require_once '../model/Comment.php';

class CommentGateway {

    private $conn;

    public function __construct(Connection $conn)
    {
        $this->conn = $conn->getConnection();
    }

    public function insert(Comment $object)
    {
        $stmt = $this->conn->prepare('INSERT INTO comment VALUES (null,:idPlace,:content)');

        $stmt->bindValue(':idPlace',$object->getIdPlace());
        $stmt->bindValue(':content',$object->getContent());

        $stmt->execute();

        return $this->conn->lastInsertId();
    }

    public function update(Comment $object)
    {
        $stmt = $this->conn->prepare('UPDATE comment SET idPlace=:idPlace,content=:content WHERE id=:id');

        $stmt->bindValue(':id',$object->getId());
        $stmt->bindValue(':idPlace',$object->getIdPlace());
        $stmt->bindValue(':content',$object->getContent());

        $stmt->execute();
    }

    public function delete($id)
    {
        $stmt = $this->conn->prepare('DELETE FROM comment WHERE id=:id');

        $stmt->bindValue(':id',$id);

        $stmt->execute();
    }

    public function find($id)
    {
        $stmt = $this->conn->prepare('SELECT * FROM comment WHERE id=:id');

        $stmt->bindValue(':id',$id);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_OBJ);

        if($result != false)
        {
            $c = new Comment($result->idPlace,$result->content);
        }
        else
        {
            $c = false;
        }

        return $c;
    }

} 