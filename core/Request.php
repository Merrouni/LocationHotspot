<?php
/**
 * Created by PhpStorm.
 * User: A.Alami
 * Date: 09/03/14
 * Time: 17:33
 */
class Request {

    public $url;

    function __construct() {
        $this->url = $_SERVER['PATH_INFO'];
    }
}