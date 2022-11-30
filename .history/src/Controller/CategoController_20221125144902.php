<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
use App\Entity\Category;

#[Route('/category')]
class CategoController extends AbstractController
{
    #[Route('/list', name: 'app_catego')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();
       
        return $this->render('catego/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    #[Route('/create', name: 'app_new_category')]
    public function new(CategoryRepository $categoryRepository, PersistenceManagerRegistry $entityManager,Request $request): Response
    {
        $category = new Category();
        if($this->isCsrfTokenValid('category',$request->request->get('_token'))){
            $name = $request->request->get('name',null);
            $color = $request->request->get('color',null);
            $category->setName($name);
            $category->setColor($color);
            if($name && $color){
                $entityManager = $entityManager->getManager();
                $entityManager->persist($category);
                $entityManager->flush();
                $this->addFlash('success','Categoria creada');
                return $this->redirectToRoute('app_catego');
            }else{
                if(!$name){
                    $this->addFlash('danger','El nombre de la categoria no puede estar vacio');
                }
               
            }
 
        }
       
        return $this->render('catego/create.html.twig', [
            'category' => $category,
        ]);
    }

}
