<?php

namespace src\Controllers;

use App\Router\Route;
use App\Controllers\BaseController;
use App\ORM\Core\ORM;
use src\Repository\UserRepository;

class HomeController extends BaseController
{

    #[Route("/home")]
    public function index()
    {
        ORM::map('Article');
    }
}
