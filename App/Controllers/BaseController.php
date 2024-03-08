<?php

namespace App\Controllers;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class BaseController
{
    protected $twig;

    public function __construct()
    {
        $loader = new FilesystemLoader('/var/www/framework/src/Views');

        $this->twig = new Environment($loader);
    }

    protected function render($view, $data = [])
    {
        echo $this->twig->render($view, $data);
    }
}
