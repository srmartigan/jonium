<?php

namespace Core\orm;

use PDO;

class DB
{
    protected static $db;

    private function __construct()
    {
    }

    public static function InitDatabase(array $config)
    {

        try {
            $dsn = 'mysql:host=' . $config['db_host'] . ';dbname=' . $config['db_name'];
            $db = new PDO('mysql:host=127.0.0.1;dbname=db_jonium', 'root', '', []);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$db = $db;
        } catch (\PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    public static function getDB()
    {
        return self::$db;
    }

   public static function runQuery(string $query)
   {
       try {
           return self::$db->query($query);
       }catch (\PDOException $e)
       {
           echo $e->getMessage();
           return false;
       }
   }
}
