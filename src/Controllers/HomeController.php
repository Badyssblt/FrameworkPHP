<?php

namespace src\Controllers;

use App\Controllers\BaseController;
use App\Router\Route;

class HomeController extends BaseController
{

    #[Route("/home/{param}")]
    public function index()
    {
        $data = [
            'title' => 'Accueil',
            'main_content' => 'Contenu principal de la page d\'accueil',
            'footer_content' => 'Pied de page personnalisé'
        ];
        $this->render('index.html.twig', $data);
    }
}
