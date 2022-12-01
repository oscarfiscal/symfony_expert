<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\MarkerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;



class ZCategoryController extends AbstractController
{
    public const ELEMENTS_PER_PAGE = 1;



#[Route('/{category}/{page}', name:'app_category', defaults:["category" => "todas", "page" => 1], requirements:["page" => "\d+"], methods:["GET"])]
public function index(
    string $category,
    int $page,
    CategoryRepository $categoryReposotiry, 
    MarkerRepository $markerRepository,
    TranslatorInterface $translator,
     ): Response
    {
    $elementsPerPage = self::ELEMENTS_PER_PAGE;
    $category = (int) $category > 0 ? (int) $category : $category;
    if (is_int($category)) {
        $category = 'todas';
        $page = $category;
    }
    if ($category && 'todas' !== $category) {

        if (!$categoryReposotiry->findByName($category)) {
            throw $this->createNotFoundException($translator->trans("las categoria \"{category}\"  no existe",
                ['{category}' => $category],
                'messages'));
        }
        $markers = $markerRepository->filterCategory($category, $page, $elementsPerPage);

    } else {
        $markers = $markerRepository->filterAll($page, $elementsPerPage);
    }

    return $this->render('index/index.html.twig', [
        'markers' => $markers,
        'page' => $page,
        'params_route' => ['category' => $category],
        'elements_per_page' => $elementsPerPage,
    ]);
}



}
