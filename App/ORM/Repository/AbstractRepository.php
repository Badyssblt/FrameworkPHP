<?php

namespace App\ORM\Repository;

use App\ORM\Database\Database;
use PDO;
use PDOException;
use ReflectionClass;

class AbstractRepository
{
    protected $db;
    private array $property;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
    }

    public function findAll()
    {
        $className = substr(basename(get_class($this)), strrpos(basename(get_class($this)), '\\') + 1);
        $tableName = str_replace('Repository', '', $className);
        $reflectionClass = new ReflectionClass("src\\Entity\\" . $tableName);
        foreach ($reflectionClass->getProperties() as $property) {
            $attributes = $property->getAttributes(\App\ORM\Annotations\ORM::class);
            foreach ($attributes as $attribute) {
                $ormAnnotation = $attribute->newInstance();
                $relation = $ormAnnotation->relation;
                $related = $ormAnnotation->related;
                if ($relation && $related) {
                    $related = strtolower($related);
                    $tableName = strtolower($tableName);
                    $sql = "SELECT * FROM $tableName INNER JOIN $related ON $tableName.id = $related.id";
                } else {
                    $tableName = strtolower($tableName);
                    $sql = "SELECT * FROM $tableName";
                }
            }
        }
        $tableName = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $tableName));

        $query = $this->db->prepare($sql);
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function insert(array $arg): void
    {
        $className = substr(basename(get_class($this)), strrpos(basename(get_class($this)), '\\') + 1);
        $tableName = strtolower(str_replace('Repository', '', $className));
        $columns = implode(', ', array_keys($arg));
        $placeholders = ':' . implode(', :', array_keys($arg));

        $sql = "INSERT INTO $tableName ($columns) VALUES ($placeholders)";

        try {
            $query = $this->db->prepare($sql);
            $query->execute($arg);
            echo "Les données ont bien été crées";
        } catch (PDOException $e) {
            echo "Erreur: " . $e->getMessage();
        }
    }

    public function update(array $arg, int $id): void
    {
        $className = substr(basename(get_class($this)), strrpos(basename(get_class($this)), '\\') + 1);
        $tableName = strtolower(str_replace('Repository', '', $className));

        $setClause = '';
        foreach ($arg as $column => $value) {
            $setClause .= "$column = :$column, ";
        }
        $setClause = rtrim($setClause, ', ');

        $whereClause = "id = $id";

        $sql = "UPDATE $tableName SET $setClause WHERE $whereClause";
        try {
            $query = $this->db->prepare($sql);
            $query->execute($arg);
            echo "Données mises à jours.";
        } catch (PDOException $e) {
            echo "Erreur: " . $e->getMessage();
        }
    }

    public function delete(int $id): void
    {
        $className = substr(basename(get_class($this)), strrpos(basename(get_class($this)), '\\') + 1);
        $tableName = strtolower(str_replace('Repository', '', $className));

        $sql = "DELETE FROM $tableName WHERE id = :id";

        try {
            $query = $this->db->prepare($sql);
            $query->execute(["id" => $id]);
            echo "Données supprimé";
        } catch (PDOException $e) {
            echo "Erreur: " . $e->getMessage();
        }
    }



    public function getDb()
    {
        return $this->db;
    }
}
