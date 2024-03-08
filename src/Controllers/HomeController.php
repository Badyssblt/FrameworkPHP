<?php

namespace src\Controllers;

use App\Router\Route;
use App\Controllers\BaseController;
use App\ORM\Database\Database;
use App\ORM\Database\DatabaseConfig;
use App\ORM\Repository\AbstractRepository;
use src\Repository\UserRepository;

class HomeController extends BaseController
{

    #[Route("/home")]
    public function index()
    {
    }
}
