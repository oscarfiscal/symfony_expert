<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MarkerRepository;

class CategoryController extends AbstractController
{
    #[Route('/category', name: 'app_category')]
    public function index(MarkerRepository $markerRepository): Response
    {
        $markers = $markerRepository->findAll();
        return $this->render('category/index.html.twig', [
            'markers' => $markers,
        ]);
        return $this->render( [
            'username' => 'Oscar fiscal',
        ]);
    }
}
