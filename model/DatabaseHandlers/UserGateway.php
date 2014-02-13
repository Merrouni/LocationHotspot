<?php
/**
 * Created by PhpStorm.
 * User: A.Alami
 * Date: 13/02/14
 * Time: 10:33
 */

class UserGateway {

    private $conn;

    public function __construct(Connection $conn)
    {
        $this->conn = $conn->getConnection();
    }

    public function insert(User $object)
    {
        $stmt = $this->conn->prepare('INSERT INTO appUser VALUES (:login,:password,:status)');

        $stmt->bindValue(':login',$object->getLogin());
        $stmt->bindValue(':password',$object->getPassword());
        $stmt->bindValue(':status',$object->getStatus());

        $stmt->execute();

        return $this->conn->lastInsertId();
    }

    public function update(User $object)
    {
        $stmt = $this->conn->prepare('UPDATE appUser SET login=:login,password=:password,status=:status WHERE id=:id');

        $stmt->bindValue(':id',$object->getId());
        $stmt->bindValue(':login',$object->getLogin());
        $stmt->bindValue(':password',$object->getPassword());
        $stmt->bindValue(':status',$object->getStatus());

        $stmt->execute();
    }

    public function delete(User $object)
    {
        $stmt = $this->conn->prepare('DELETE * FROM appUser WHERE id=:id');

        $stmt->bindValue(':id',$object->getId());

        $stmt->execute();
    }

    public function find($id)
    {
        $stmt = $this->conn->prepare('SELECT * FROM appUser WHERE id=:id');

        $stmt->bindValue(':id',$id);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_OBJ);

        $u = new User($result['login'],$result['password'],$result['status']);

        return $u;
    }


} 