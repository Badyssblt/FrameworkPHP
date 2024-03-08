<?php

namespace App\ORM\Database;

use Exception;
use PDO;
use PDOException;

class Database
{
    private $connection;
    private static $instance;


    public function __construct()
    {
        $conf = new DatabaseConfig();
        try {
            $this->connection = new PDO('mysql:host=' . $conf->getHost() . ';port=3306;dbname=' . $conf->getDbname() . '', $conf->getUser(), $conf->getPass());
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new Exception("Connection failed: " . $e->getMessage());
        }
    }

    public static function getInstance($dsn)
    {
        if (self::$instance === null) {
            self::$instance = new self($dsn);
        }

        return self::$instance;
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
