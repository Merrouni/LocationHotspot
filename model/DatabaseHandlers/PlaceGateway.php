<?php
/**
 * Created by PhpStorm.
 * User: A.Alami
 * Date: 12/02/14
 * Time: 17:06
 */

require_once 'Connection.php';
require_once '../model/Place.php';
//require_once '../maps/GoogleMapAPIv3.php';

class PlaceGateway{

    private $conn;

    public function __construct()
    {
        $this->conn = Connection::getConnection();
    }

    public function insert(Place $object)
    {
        $gmap = new GoogleMapAPI();
        $point = $gmap->geocoding($object->getAddress());

        $stmt = $this->conn->prepare('INSERT INTO place VALUES (null,:internet,:coffee,:plugs,:openTime,:closeTime,:address,:latitude,:longitude,:idUser)');

        $stmt->bindValue(':internet',$object->getInternet());
        $stmt->bindValue(':coffee',$object->getCoffee());
        $stmt->bindValue(':plugs',$object->getPlugs());
        $stmt->bindValue(':openTime',$object->getOpenTime());
        $stmt->bindValue(':closeTime',$object->getCloseTime());
        $stmt->bindValue(':address',$object->getAddress());
        $stmt->bindValue(':latitude',$point[2]);
        $stmt->bindValue(':longitude',$point[3]);
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
            $p->setId($result->id);
            $p->setLatitude($result->latitude);
            $p->setLongitude($result->longitude);
        }
        else
        {
            $p = false;
        }

        return $p;
    }

    public function findAll()
    {
        $stmt = $this->conn->prepare('SELECT * FROM place');

        $stmt->execute();

        $result = $stmt->fetchAll();

        if($result != false)
        {
            foreach($result as $place){
                $p = new Place($place['internet'],$place['coffee'],$place['plugs'],$place['openTime'],$place['closeTime'],$place['address'],$place['idUser']);
                $p->setId($place['id']);
                $p->setLatitude($place['latitude']);
                $p->setLongitude($place['longitude']);

                $items[] = $p;
            }
        }
        else
        {
            $items = false;
        }
        return $items;
    }

    public function findClosestTo($myLat,$myLon,$radius)
    {
        $items = array();

        // for miles replace 6371 by 3959
        //SELECT id, ( 6371 * acos( cos( radians(myLat) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(myLon) ) + sin( radians(myLat) ) * sin( radians( latitude ) ) ) ) AS distance FROM markers HAVING distance < 25 ORDER BY distance LIMIT 0 , 20;
        $stmt = $this->conn->prepare('SELECT id,internet,coffee,plugs,openTime,closeTime,address,latitude,longitude,idUser, ( 6371 * acos( cos( radians(:myLat) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(:myLon) ) + sin( radians(:myLat) ) * sin( radians( latitude ) ) ) ) AS distance FROM place HAVING distance < :radius ORDER BY distance LIMIT 0 , 20');

        $stmt->bindValue('myLat',$myLat);
        $stmt->bindValue('myLon',$myLon);
        $stmt->bindValue('radius',$radius);

        $stmt->execute();

        $result = $stmt->fetchAll();

        if($result != false)
        {
            foreach($result as $place){
                $p = new Place($place['internet'],$place['coffee'],$place['plugs'],$place['openTime'],$place['closeTime'],$place['address'],$place['idUser']);
                $p->setId($place['id']);
                $p->setLatitude($place['latitude']);
                $p->setLongitude($place['longitude']);

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