<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use 

class LanguageController extends AbstractController
{
    #[Route('/language/{_locale}/{ruta}', name: 'app_language', defaults: ['ruta' => ''])]
    public function index(Request $request): Response
    {
        $idiomaActual = $request->getSession()->getLocale('_locale');
        $metodo = $request->getMethod();
        if($metodo === 'POST'){
          $ruta = $request->request->get('ruta');
          $this->redirectToRoute($ruta);
        }
        return $this->render('language/index.html.twig', [
            'ruta' => $ruta,
            'idiomaActual' => $idiomaActual,
        ]);
    }
}
