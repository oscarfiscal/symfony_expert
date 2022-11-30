<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class LanguageController extends AbstractController
{
    #[Route('/language/{_locale}/{ruta}', name: 'app_language', defaults: ['ruta' => ''])]
    public function index(string $ruta, Request $request): Response
    {
        $idiomaActual = $request->getSession()->get('_locale');
      
        $metodo = $request->getMethod();
        if(  'POST' === $metodo){
          $ruta = $request->request->get('ruta');
          $this->redirectToRoute($ruta);
        }
        return $this->render('language/index.html.twig', [
            'ruta' => $ruta,
            'idioma_actual' => $idiomaActual,
        ]);
    }
}
