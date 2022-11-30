<?php

namespace App\EventSuscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class LenguageSuscriber implements EventSuscriberInterface
{
    public function alAComienzoDelRequest(RequestEvent $event)
    {
        $request = $event->getRequest();
        $idioma = $request->getPreferredLanguage(['es', 'en']);
        $request->setLocale($idioma);
    }
    public  static  function  getSubscribedEvents ()
    {
        return [
            KernelEvents::REQUEST => [
                ['alAComienzoDelRequest', 20],
            ],
        ];
    }
}