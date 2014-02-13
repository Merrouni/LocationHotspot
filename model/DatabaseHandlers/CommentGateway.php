<?php
/**
 * Created by PhpStorm.
 * User: A.Alami
 * Date: 13/02/14
 * Time: 10:44
 */

class CommentGateway {

    private $conn;

    public function __construct(Connection $conn)
    {
        $this->conn = $conn->getConnection();
    }

    public function insert(Comment $object)
    {
        $stmt = $this->conn->prepare('INSERT INTO comment VALUES (:idPlace,:content)');

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

    public function delete(Comment $object)
    {
        $stmt = $this->conn->prepare('DELETE * FROM comment WHERE id=:id');

        $stmt->bindValue(':id',$object->getId());

        $stmt->execute();
    }

    public function find($id)
    {
        $stmt = $this->conn->prepare('SELECT * FROM comment WHERE id=:id');

        $stmt->bindValue(':id',$id);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_OBJ);

        $c = new Comment($result['idPlace'],$result['content']);

        return $c;
    }

} 