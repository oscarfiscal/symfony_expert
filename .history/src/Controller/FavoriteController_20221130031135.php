<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class FavoriteController extends AbstractController
{
    #[Route('/edit-favorite', name:'app_edit_favorite')]
    function editfavorite(MarkerRepository $markerRepository, Request $request, ManagerRegistry $doctrine): Response
        {
        if ($request->isXmlHttpRequest()) {
            $update = true;
            $id = $request->request->get('id');
            $entityManager = $doctrine->getManager();
            $marker = $markerRepository->find($id);
            $entityManager->persist($marker);
            $marker->setFavorite(!$marker->isFavorite());
    
           try {
                $entityManager->flush();
            } catch (\Exception $e) {
                $update = false;
            }
            return $this->json(['update' => $update]);
    
        }
        throw $this->createNotFoundException('Not found');
        
    }
    
    #[Route('/favorite/{page}', name:'app_favorite', defaults:["page" => 1], requirements:["page" => "\d+"])]
    function favorite(int $page, MarkerRepository $markerRepository): Response
        {
    
        $markers = $markerRepository->filterFavorite($page, self::ELEMENTS_PER_PAGE);
    
        return $this->render('index/index.html.twig', [
            'markers' => $markers,
            'page' => $page,
            'elements_per_page' => self::ELEMENTS_PER_PAGE,
        ]);
    }
}
