<?php


namespace App\ORM\Annotations;

#[\Attribute]
class ORM {
    public string $columnType;

    public function __construct(string $columnType)
    {
        $this->columnType = $columnType;
    }
}