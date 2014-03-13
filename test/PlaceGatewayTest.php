<?php
/**
 * Created by PhpStorm.
 * User: A.Alami
 * Date: 19/02/14
 * Time: 16:02
 */

require_once '../model/DatabaseHandlers/PlaceGateway.php';
require_once '../model/DatabaseHandlers/UserGateway.php';

class PlaceGatewayTest extends PHPUnit_Framework_TestCase {

    private static $id;
    private static $idUser;

    public function testCreate()
    {
        $userGateway = new UserGateway(new Connection());
        $user = new User('user','password','user_role');
        PlaceGatewayTest::$idUser = $userGateway->insert($user);

        $gateway = new PlaceGateway();
        $place = new Place("FREE","FREE","NONE",28800,43200,"35 rue roche genes",PlaceGatewayTest::$idUser);
        PlaceGatewayTest::$id = $gateway->insert($place);

        $this->assertNotEquals(PlaceGatewayTest::$id,0);
    }

    public function testFind()
    {
        $gateway = new PlaceGateway();
        $place = $gateway->find(PlaceGatewayTest::$id);

        $this->assertequals($place->getInternet(),"FREE");
        $this->assertequals($place->getCoffee(),"FREE");
        $this->assertequals($place->getPlugs(),"NONE");
        $this->assertequals($place->getOpenTime(),28800);
        $this->assertequals($place->getCloseTime(),43200);
        $this->assertequals($place->getAddress(),"35 rue roche genes");
        $this->assertequals($place->getIdUser(),PlaceGatewayTest::$idUser);

    }

    public function testUpdate()
    {
        $gateway = new PlaceGateway();
        $place = new Place("FREE","NOT FREE","EXIST",28800,61200,"Rue roche genes",PlaceGatewayTest::$idUser);
        $place->setId(PlaceGatewayTest::$id);

        $gateway->update($place);

        $placeResult = $gateway->find(PlaceGatewayTest::$id);

        $this->assertequals($placeResult->getInternet(),"FREE");
        $this->assertequals($placeResult->getCoffee(),"NOT FREE");
        $this->assertequals($placeResult->getPlugs(),"EXIST");
        $this->assertequals($placeResult->getOpenTime(),28800);
        $this->assertequals($placeResult->getCloseTime(),61200);
        $this->assertequals($placeResult->getAddress(),"Rue roche genes");
        $this->assertequals($placeResult->getIdUser(),PlaceGatewayTest::$idUser);

    }

    public function testDelete()
    {
        $gateway = new PlaceGateway();
        $gateway->delete(PlaceGatewayTest::$id);

        $placeResult = $gateway->find(PlaceGatewayTest::$id);

        $userGateway = new UserGateway(new Connection());
        $userGateway->delete(PlaceGatewayTest::$idUser);

        $this->assertEquals($placeResult,false);

    }

}
 