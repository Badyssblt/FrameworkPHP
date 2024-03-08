<?php

namespace App\ORM\Repository;

use App\ORM\Database\Database;
use PDO;

class AbstractRepository
{
    protected $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
    }

    public function findAll()
    {
        $className = substr(basename(get_class($this)), strrpos(basename(get_class($this)), '\\') + 1);
        $tableName = str_replace('Repository', '', $className);
        $tableName = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $tableName));
        $sql = "SELECT * FROM $tableName";
        $query = $this->db->prepare($sql);
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getDb()
    {
        return $this->db;
    }
}
