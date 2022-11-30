<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\

class CategoController extends AbstractController
{
    #[Route('/catego', name: 'app_catego')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        return $this->render('catego/index.html.twig', [
            'controller_name' => 'CategoController',
        ]);
    }
}
