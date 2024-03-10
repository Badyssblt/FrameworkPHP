<?php


namespace App\Commands;

use App\ORM\Core\ORM;

class CreateTableCommand {
    public function execute($tableName) {
        ORM::map($tableName);
    }
}