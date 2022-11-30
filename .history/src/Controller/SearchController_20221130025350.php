<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TagRepository;

class SearchController extends AbstractController
{
    public const ELEMENTS_PER_PAGE = 1;

    #[Route('/search-tags/search', name: 'app_search_tag')]
    public function searchTag(TagRepository $tagRepository, Request $request): Response
    {
       if($request->isXmlHttpRequest()) {
          $search = $request->get('q');
            $tags = $tagRepository->filterName($search); 
            return $this->json($tags);
       }
       throw $this->createNotFoundException('Not found');
    }


    #[Route('/buscar/{search}/{page}', name:'app_search', defaults:['search' => '', 'page' => 1], requirements:["page" => "\d+"])]
    function search(string $search, int $page, MarkerRepository $markerRepository, CategoryRepository $categoryRepository, Request $request): Response
        {
        $formSearch = $this->createForm(\App\Form\SearchType::class);
        $formSearch->handleRequest($request);
    
        $markers = [];
        if ($formSearch->isSubmitted() && $formSearch->isValid()) {
            $search = $formSearch->get('busqueda')->getData();
    
        }
        if (!empty($search)) {
            $markers = $markerRepository->filterName($search, $page, self::ELEMENTS_PER_PAGE);
        }
        if ((!empty($search) || $formSearch->isSubmitted())) {
            return $this->render('index/index.html.twig', [
                'formSearch' => $formSearch->createView(),
                'markers' => $markers,
                'page' => $page,
                'params_route' => [
                    'search' => $search,
                ],
                'elements_per_page' => self::ELEMENTS_PER_PAGE,
            ]);
        }
    
        return $this->render('partial/_search.html.twig', [
            'formSearch' => $formSearch->createView(),
        ]);
    }
}
