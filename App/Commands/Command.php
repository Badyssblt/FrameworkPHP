<?php

namespace App\Commands;

abstract class Command {
    abstract public function execute(array $args): void;
}   