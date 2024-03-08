<?php

namespace App\Router;

#[\Attribute]
class Route
{
    public string $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }
}
