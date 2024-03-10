<?php

namespace src\Controllers;

use App\Router\Route;
use App\Controllers\BaseController;
use App\ORM\Core\ORM;
use src\Entity\Article;
use src\Repository\ArticleRepository;
use src\Repository\UserRepository;

class HomeController extends BaseController
{

    #[Route("/home")]
    public function index()
    {
        $repository = new ArticleRepository();
        $data = [
            "name" => "test3",
            "email" => "test3@gmail.com",
            "password" => "test"
        ];
        $articles = $repository->delete(1);
    }
}
