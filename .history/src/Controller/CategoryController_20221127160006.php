<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MarkerRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;


class CategoryController extends AbstractController
{

    #[Route('/edit-favorite', name: 'app_edit_favorite')]
    public function editfavorite(MarkerRepository $markerRepository, Request $request ): Response
    {
     if($request->isXmlHttpRequest()){
        $update = true;
        $id = $request->request->get('id');
        $entityManager = $this->getDoctrine()->getManager();
        $marker = $markerRepository->findOneB($id);
        $marker->setFavorite(!$marker->getFavorite());
      
        $entityManager->persist($marker);
        $entityManager->flush();

        try {
            $entityManager->flush();
        } catch (\Exeption $e) {
            $update = false;
        }
     return  $this->json(['update' => $update]);
     
     }
     throw new createNotFoundHttpException();
    }

    #[Route('/favorite', name: 'app_favorite')]
    public function favorite(MarkerRepository $markerRepository): Response
    {
        $markers = $markerRepository->findBy(
            [
                'favorite' => true
            ]

        );
        return $this->render('index/index.html.twig', [
            'markers' => $markers,
        ]);
    }
    
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

   
}
