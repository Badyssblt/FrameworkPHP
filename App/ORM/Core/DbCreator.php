<?php


namespace App\ORM\Core;

use App\ORM\Database\Database;

class DbCreator
{
    private array $property;
    private $connection;
    public function __construct(array $data)
    {
        $this->property = $data;
        $this->connection = (new Database())->getConnection();
    }

    public function createTable($tableName)
    {

        $tableName = strtolower($tableName);
        $sql = "CREATE TABLE IF NOT EXISTS $tableName (";
        foreach ($this->property as $propertyName => $property) {
            $type = $property['type'];
            $relation = $property['relation'];
            $related = strtolower($property['related']);

            if ($type === "AI") {
                $type = "INT PRIMARY KEY NOT NULL AUTO_INCREMENT";
                $sql .= "$propertyName  $type, ";
            } else if ($type === "string") {
                $type = "VARCHAR(255)";
                $sql .= "$propertyName $type, ";
            } else {
                if ($relation === "ManyToOne") {
                    $type = "INT";
                    $sql .= "$propertyName $type, ";
                    $sql .= "FOREIGN KEY ($propertyName) REFERENCES $related(id), ";
                } else if ($type === "OneToMany") {
                } else if ($type === "OneToOne") {
                }
            }
        }

        $sql = rtrim($sql, ', ');

        $sql .= ");";


        try {
            $query = $this->connection->prepare($sql);
            $query->execute();
            echo "La table $tableName a bien été crée\n";
        } catch (\PDOException $e) {
            die("Une erreur est survenue dans la création de la table : " . $e->getMessage());
        }
    }
}
