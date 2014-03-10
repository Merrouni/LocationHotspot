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

    public function findClosestTo($myLat,$myLon,$radius)
    {
        //$stmt = $this->conn->prepare('SELECT * FROM place WHERE id=:id');
        // for miles replace 6371 by 3959
        /*$stmt = $this->conn->prepare('SELECT id, ( 6371 * acos( cos( radians(:myLat) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(:myLon) ) + sin( radians(:myLat) ) * sin( radians( latitude ) ) ) ) AS distance FROM markers HAVING distance < :radius ORDER BY distance LIMIT 0 , 20');
        //SELECT id, ( 6371 * acos( cos( radians(myLat) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(myLon) ) + sin( radians(myLat) ) * sin( radians( latitude ) ) ) ) AS distance FROM markers HAVING distance < 25 ORDER BY distance LIMIT 0 , 20;

        $stmt->bindValue('myLat',$myLat);
        $stmt->bindValue('myLon',$myLon);
        $stmt->bindValue('radius',$radius);

        $stmt->execute();

        $result = $stmt->fetch (PDO::FETCH_OBJ);*/

        $items = array();

        // Search the rows in the markers table
        $query = sprintf("SELECT id, internet, coffee, plugs, openTime, closeTime, address, latitude,longitude, idUser, ( 6371 * acos( cos( radians('%s') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('%s') ) + sin( radians('%s') ) * sin( radians( lat ) ) ) ) AS distance FROM place HAVING distance < '%s' ORDER BY distance LIMIT 0 , 20",
            mysql_real_escape_string($myLat),
            mysql_real_escape_string($myLon),
            mysql_real_escape_string($myLat),
            mysql_real_escape_string($radius));
        $result = mysql_query($query);

        //$result = mysql_query($query);

        if($result != false)
        {
            /*while($row = @mysql_fetch_assoc($result)){
            $p = new Place($row->internet,$row->coffee,$row->plugs,$row->openTime,$row->closeTime,$row->address,$row->idUser);
            $items[] = $p;
            }*/
            // Iterate through the rows, adding XML nodes for each
            while ($row = @mysql_fetch_assoc($result)){
                $p = new Place($row['internet'],$row['coffee'],$row['plugs'],$row['openTime'],$row['closeTime'],$row['address'],$row['idUser']);
                $p->setId($row['id']);
                $p->setLatitude($row['latitude']);
                $p->setLongitude($row['longitude']);

                $items[] = $p;
            }

        }
        else
        {
            $items = false;
        }

        return $items;
    }
}