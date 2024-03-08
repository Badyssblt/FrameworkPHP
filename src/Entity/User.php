<?php

namespace src\Entity;

class User
{
    private int $id;

    private string $name;

    private string $email;

    private string $password;

    public function __construct()
    {
    }
}
