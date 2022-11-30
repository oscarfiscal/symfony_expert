<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MarkerRepository;
use App\Repository\CategoryRepository;


class CategoryController extends AbstractController
{
    #[Route('/{category}', name: 'app_category', defaults: ["category" => ""])]
    public function index(string $category, CategoryRepository  $categoryReposotiry, MarkerRepository $markerRepository): Response
    {
        if(!empty($category)){
          
            if(!$categoryReposotiry->findByName($category))
            {
                throw $this->createNotFoundException('la categoria ' . $category . ' non existe');
            }
            $markers = $markerRepository->filterCategory($category);
           

        }else{
            $markers = $markerRepository->findAll();
        }
      
        return $this->render('index/index.html.twig', [
            'markers' => $markers,
        ]);
    }

    #[Route('/{category}', name: 'app_favorite')]
    public function favorite(MarkerRepository $markerRepository): Response
    {
        $markers = $markerRepository->filterFavorite();
        return $this->render('index/index.html.twig', [
            'markers' => $markers,
        ]);
    }
}
