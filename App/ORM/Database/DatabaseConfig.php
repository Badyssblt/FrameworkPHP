<?php

namespace App\ORM\Database;

class DatabaseConfig
{
    private string $host;
    private string $dbname;
    private string $user;
    private string $pass;

    public function __construct()
    {
        $envContent = file_get_contents('/var/www/framework/.env');
        $lines = explode("\n", $envContent);
        foreach ($lines as $line) {
            $line = trim($line);
            if (!empty($line)) {
                list($key, $value) = explode("=", $line, 2);
                switch ($key) {
                    case 'DBHOST':
                        $this->host = $value;
                        break;
                    case 'DBNAME':
                        $this->dbname = $value;
                        break;
                    case 'DBUSER':
                        $this->user = $value;
                        break;
                    case 'DBPASS':
                        $this->pass = $value;
                        break;
                }
            }
        }
    }


    public function getHost(): string
    {
        return $this->host;
    }

    public function getDbname(): string
    {
        return $this->dbname;
    }

    public function getUser(): string
    {
        return $this->user;
    }

    public function getPass(): string
    {
        return $this->pass;
    }
}
