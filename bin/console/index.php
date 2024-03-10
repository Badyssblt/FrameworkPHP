<?php

require 'vendor/autoload.php';

use App\Commands\CreateTableCommand;

require('/var/www/framework/App/Commands/CreateTableCommand.php');
$commandName = $argv[1]; 

switch ($commandName) {
    case 'create:table':
        if(isset($argv[2])) {
            $tableName = $argv[2];
            $tableName = ucfirst($tableName);
            $createTableCommand = new CreateTableCommand();
            $createTableCommand->execute($tableName);
        } else {
            echo "Missing table name.\n";
        }
        break;
    default:
        echo "Command not found";
        break;
}