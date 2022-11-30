<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    #[Route('/category', name: 'app_category')]
    public function index(MarkerRepository $): Response
    {
        return $this->render('index/index.html.twig', [
            'username' => 'Oscar fiscal',
        ]);
    }
}
