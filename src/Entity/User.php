<?php

namespace src\Entity;

use App\ORM\Annotations\ORM;

class User
{
    #[ORM(columnType: 'AI')]
    private int $id;

    #[ORM(columnType: 'string')]
    private string $name;

    #[ORM(columnType: 'string')]
    private string $email;

    #[ORM(columnType: 'string')]
    private string $password;


    public function __construct()
    {
    }
}
