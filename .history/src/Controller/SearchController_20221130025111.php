<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
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
}
