<?php
/**
 * Created by PhpStorm.
 * User: A.Alami
 * Date: 13/02/14
 * Time: 16:53
 */
require_once '../model/DatabaseHandlers/UserGateway.php';

class UserGatewayTest extends PHPUnit_Framework_TestCase {

    private static $id;

    public function testCreate()
    {
        $gateway = new UserGateway(new Connection());
        $user = new User('user','password','user_role');

        UserGatewayTest::$id = $gateway->insert($user);

        $this->assertNotEquals(UserGatewayTest::$id,0);
    }

    public function testFind()
    {
        $gateway = new UserGateway(new Connection());
        $user = $gateway->find(UserGatewayTest::$id);

        $this->assertequals($user->getLogin(),"user");
        $this->assertequals($user->getPassword(),"password");
        $this->assertequals($user->getStatus(),"user_role");

    }

    public function testUpdate()
    {
        $gateway = new UserGateway(new Connection());
        $user = new User('user2','password2','user_role2');
        $user->setId(UserGatewayTest::$id);

        $gateway->update($user);

        $userResult = $gateway->find(UserGatewayTest::$id);

        $this->assertequals($userResult->getLogin(),"user2");
        $this->assertequals($userResult->getPassword(),"password2");
        $this->assertequals($userResult->getStatus(),"user_role2");

    }

    public function testDelete()
    {
        $gateway = new UserGateway(new Connection());
        $gateway->delete(UserGatewayTest::$id);

        $userResult = $gateway->find(UserGatewayTest::$id);

        $this->assertEquals($userResult,false);

    }
}
 