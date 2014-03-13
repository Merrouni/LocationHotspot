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
        if (array_key_exists('PATH_INFO', $_SERVER)){
            $this->url = $_SERVER['PATH_INFO'];
        }else {
            $this->url = "/locations/view/";
        }

    }
}