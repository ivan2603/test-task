<?php
namespace Components;

use PDO;

class Db {

    /**
     * Connection to DB method
     * @return PDO
     */
    public static function getConnection () {

        $paramsPath = ROOT.'/config/db_params.php';
        $params = include ($paramsPath);

        $dsn = "mysql:host={$params['host']};charset=utf8; dbname={$params['dbname']}";
        $db = new PDO($dsn, $params['user'], $params['password']);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $db;
    }
}