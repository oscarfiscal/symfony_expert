<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoryRepository;

class CategoController extends AbstractController
{
    #[Route('/list', name: 'app_catego')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();
        dump($categories);die();
        return $this->render('catego/index.html.twig', [
            'controller_name' => 'CategoController',
        ]);
    }

    #[Route('/list', name: 'app_catego')]
    public function new(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();
        dump($categories);die();
        return $this->render('catego/index.html.twig', [
            'controller_name' => 'CategoController',
        ]);
    }

}
