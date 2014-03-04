<?php
/**
 * Created by PhpStorm.
 * User: A.Alami
 * Date: 19/02/14
 * Time: 15:59
 */
require_once '../model/DatabaseHandlers/CommentGateway.php';
require_once '../model/DatabaseHandlers/PlaceGateway.php';
require_once '../model/DatabaseHandlers/UserGateway.php';

class CommentGatewayTest extends PHPUnit_Framework_TestCase {

    private static $id;
    private static $idUser;
    private static $idPlace;

    public function testCreate()
    {
        $userGateway = new UserGateway(new Connection());
        $user = new User('user','password','user_role');
        CommentGatewayTest::$idUser = $userGateway->insert($user);

        $placeGateway = new PlaceGateway(new Connection());
        $place = new Place("FREE","FREE","NONE",28800,43200,"35 rue roche genes",CommentGatewayTest::$idUser);
        CommentGatewayTest::$idPlace = $placeGateway->insert($place);

        $gateway = new CommentGateway(new Connection());
        $comment = new Comment(CommentGatewayTest::$idPlace,"first comment");
        CommentGatewayTest::$id = $gateway->insert($comment);

        $this->assertNotEquals(CommentGatewayTest::$id,0);
    }

    public function testFind()
    {
        $gateway = new CommentGateway(new Connection());
        $comment = $gateway->find(CommentGatewayTest::$id);

        $this->assertequals($comment->getIdPlace(),CommentGatewayTest::$idPlace);
        $this->assertequals($comment->getContent(),"first comment");

    }

    public function testUpdate()
    {
        $gateway = new CommentGateway(new Connection());
        $comment = new Comment(CommentGatewayTest::$idPlace,"comment changed");
        $comment->setId(CommentGatewayTest::$id);

        $gateway->update($comment);

        $commentResult = $gateway->find(CommentGatewayTest::$id);

        $this->assertequals($commentResult->getIdPlace(),CommentGatewayTest::$idPlace);
        $this->assertequals($commentResult->getContent(),"comment changed");

    }

    public function testDelete()
    {
        $gateway = new CommentGateway(new Connection());
        $gateway->delete(CommentGatewayTest::$id);

        $commentResult = $gateway->find(CommentGatewayTest::$id);

        $placeGateway = new PlaceGateway(new Connection());
        $placeGateway->delete(CommentGatewayTest::$idPlace);

        $userGateway = new UserGateway(new Connection());
        $userGateway->delete(CommentGatewayTest::$idUser);

        $this->assertEquals($commentResult,false);

    }

}
 