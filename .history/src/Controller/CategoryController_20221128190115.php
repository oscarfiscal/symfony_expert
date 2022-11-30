<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MarkerRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;



class CategoryController extends AbstractController
{
    public const ELEMENTS_PER_PAGE = 1;
    #[Route('/buscar/{search}', name: 'app_search',defaults: ['search' => ''])]
    public function search(string $search , MarkerRepository $markerRepository, CategoryRepository $categoryRepository, Request $request): Response
    {
        $formSearch =$this->createForm(\App\Form\SearchType::class);
        $formSearch->handleRequest($request);
      
        $markers =[];
        if($formSearch->isSubmitted() && $formSearch->isValid()){
            $search = $formSearch->get('busqueda')->getData();
           
         
        }
        if(!empty($search)){
            $markers = $markerRepository->filterName($search);
        }
        if((!empty($search) || $formSearch->isSubmitted())){
            return $this->render('index/index.html.twig', [
                'formSearch' => $formSearch->createView(),
                'markers' => $markers,
              
            ]);
        }


        return $this->render('partial/_search.html.twig', [
            'formSearch' => $formSearch->createView(),
        ]);
    }

    #[Route('/edit-favorite', name: 'app_edit_favorite')]
    public function editfavorite(MarkerRepository $markerRepository, Request $request,ManagerRegistry $doctrine ): Response
    {
     if($request->isXmlHttpRequest()){
        $update = true;
        $id = $request->request->get('id');
        $entityManager = $doctrine->getManager();
        $marker = $markerRepository->find($id);
        $entityManager->persist($marker);
        $marker->setFavorite(!$marker);

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
    
    #[Route('/{category}/{page}', name: 'app_category', defaults: ["category" => "todas", "page" => 1], requirements: ["page" => "\d+"])]
    public function index(string $category, int $page, CategoryRepository  $categoryReposotiry, MarkerRepository $markerRepository): Response
    {
        $elementsPerPage = self::ELEMENTS_PER_PAGE;
        $category =
        if(!empty($category)){
          
            if(!$categoryReposotiry->findByName($category))
            {
                throw $this->createNotFoundException('la categoria ' . $category . ' no existe');
            }
            $markers = $markerRepository->filterCategory($category, $page,$elementsPerPage);
           

        }else{
            $markers = $markerRepository->filterAll($page,$elementsPerPage);
        }
      
        return $this->render('index/index.html.twig', [
            'markers' => $markers,
            'page' => $page,
            'params_route'=> ['category' => $category],
            'elements_per_page' =>$elementsPerPage,
        ]);
    }

   
}
