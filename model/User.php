<?php

/**
 * Created by PhpStorm.
 * User: A.Alami
 * Date: 12/02/14
 * Time: 16:10
 */
class User
{
    private $id;
    private $login;
    private $password;
    private $status;

    public function __construct($login, $password, $status)
    {
        $this->login = $login;
        $this->password = $password;
        $this->status = $status;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

} 