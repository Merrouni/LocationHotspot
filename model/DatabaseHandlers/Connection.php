<?php
/**
 * Created by PhpStorm.
 * User: A.Alami
 * Date: 12/02/14
 * Time: 16:48
 */

class Connection {
    const HOST="localhost";
    const PROVIDER="mysql";
    const USERNAME="root";
    const PASSWORD="root";
    const DATABASE="location_hotspot";

    public function getConnection()
    {
        $conn = new PDO(PROVIDER.":host=".HOST.";dbname=".DATABASE,USERNAME,PASSWORD);

        if(!$conn)
        {
            die("Cannot open the database !!");
        }
        return $conn;
    }

} 