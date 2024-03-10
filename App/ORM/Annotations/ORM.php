<?php


namespace App\ORM\Annotations;

#[\Attribute]
class ORM
{
    public string $columnType;
    public string $relation;
    public string $related;


    public function __construct(string $columnType = "", string $relation = "", string $related = "")
    {
        $this->columnType = $columnType;
        $this->relation = $relation;
        $this->related = $related;
    }
}
