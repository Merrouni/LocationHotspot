<?php
/**
 * Created by PhpStorm.
 * User: A.Alami
 * Date: 13/02/14
 * Time: 10:33
 */

require_once 'Connection.php';
require_once '../model/User.php';

class UserGateway {

    private $conn;

    public function __construct(Connection $conn)
    {
        $this->conn = $conn->getConnection();
    }

    public function insert(User $object)
    {
        $stmt = $this->conn->prepare('INSERT INTO appUser VALUES (null,:login,:password,:status)');

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

    public function delete($id)
    {
        $stmt = $this->conn->prepare('DELETE FROM appUser WHERE id=:id');

        $stmt->bindValue(':id',$id);

        $stmt->execute();
    }

    public function find($id)
    {
        $stmt = $this->conn->prepare('SELECT * FROM appUser WHERE id=:id');

        $stmt->bindValue(':id',$id);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_OBJ);
        if($result != false)
        {
            $u = new User($result->login,$result->password,$result->status);
        }
        else
        {
            $u = false;
        }
        return $u;
    }


} 