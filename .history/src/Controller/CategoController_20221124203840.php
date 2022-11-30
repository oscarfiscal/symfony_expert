<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;

#[Route('/category')]
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

    #[Route('/create', name: 'app_new_category')]
    public function new(CategoryRepository $categoryRepository,Request $request): Response
    {
        if($this->isCsrfTokenValid('category',$request->request->)){


        }
       
      
        return $this->render('catego/create.html.twig', [
            'controller_name' => 'CategoController',
        ]);
    }

}
