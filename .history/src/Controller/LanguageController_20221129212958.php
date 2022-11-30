<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class LanguageController extends AbstractController
{
    #[Route('/language/{_locale}/{ruta}', name: 'app_language', defaults: ['ruta' => ''])]
    public function index(Request $request): Response
    {
        $idiomaActual = $request->getSession()->getLocale('_locale');
        $metodo = $request->getMethod();
        if($metodo == 'POST'){
            $idioma = $request->request->get('idioma');
            $request->getSession()->set('_locale', $idioma);
            $idiomaActual = $idioma;
        }
        return $this->render('language/index.html.twig', [
            'controller_name' => 'LanguageController',
        ]);
    }
}
