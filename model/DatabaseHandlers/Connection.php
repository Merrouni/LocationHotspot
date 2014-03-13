<?php
/**
 * Created by PhpStorm.
 * User: A.Alami
 * Date: 12/02/14
 * Time: 16:48
 */

define('HOST','localhost');
define('PROVIDER','mysql');
define('USERNAME','root');
define('PASSWORD','root');
define('DATABASE','location_hotspot');

class Connection {

    static function getConnection()
    {
        $conn = new PDO(PROVIDER.":host=".HOST.";dbname=".DATABASE,USERNAME,PASSWORD,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

        if(!$conn)
        {
            die("Cannot open the database !!");
        }
        return $conn;
    }

} 