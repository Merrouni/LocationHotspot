<?php
/**
 * Created by PhpStorm.
 * User: A.Alami
 * Date: 12/02/14
 * Time: 17:06
 */

require_once 'Connection.php';
require_once '../model/Place.php';

class PlaceGateway{

    private $conn;

    public function __construct(Connection $conn)
    {
        $this->conn = $conn->getConnection();
    }

    public function insert(Place $object)
    {
        $stmt = $this->conn->prepare('INSERT INTO place VALUES (null,:internet,:coffee,:plugs,:openTime,:closeTime,:address,null,null,:idUser)');

        $stmt->bindValue(':internet',$object->getInternet());
        $stmt->bindValue(':coffee',$object->getCoffee());
        $stmt->bindValue(':plugs',$object->getPlugs());
        $stmt->bindValue(':openTime',$object->getOpenTime());
        $stmt->bindValue(':closeTime',$object->getCloseTime());
        $stmt->bindValue(':address',$object->getAddress());
        $stmt->bindValue(':idUser',$object->getIdUser());

        $stmt->execute();

        return $this->conn->lastInsertId();
    }

    public function update(Place $object)
    {
        $stmt = $this->conn->prepare('UPDATE place SET internet=:internet,coffee=:coffee,plugs=:plugs,openTime=:openTime,closeTime=:closeTime,address=:address,latitude=:latitude,longitude=:longitude WHERE id=:id');

        $stmt->bindValue(':id',$object->getId());
        $stmt->bindValue(':internet',$object->getInternet());
        $stmt->bindValue(':coffee',$object->getCoffee());
        $stmt->bindValue(':plugs',$object->getPlugs());
        $stmt->bindValue(':openTime',$object->getOpenTime());
        $stmt->bindValue(':closeTime',$object->getCloseTime());
        $stmt->bindValue(':address',$object->getAddress());
        $stmt->bindValue(':latitude',$object->getLatitude());
        $stmt->bindValue(':longitude',$object->getLongitude());

        $stmt->execute();
    }

    public function delete($id)
    {
        $stmt = $this->conn->prepare('DELETE FROM place WHERE id=:id');

        $stmt->bindValue(':id',$id);

        $stmt->execute();
    }

    public function find($id)
    {
        $stmt = $this->conn->prepare('SELECT * FROM place WHERE id=:id');

        $stmt->bindValue(':id',$id);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_OBJ);

        if($result != false)
        {
            $p = new Place($result->internet,$result->coffee,$result->plugs,$result->openTime,$result->closeTime,$result->address,$result->idUser);
        }
        else
        {
            $p = false;
        }

        return $p;
    }
}