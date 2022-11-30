<?php

namespace App\EventSuscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class LenguageSuscriber implements EventSuscriberInterface
{
    public function alAComienzoDelRequest(RequestEvent $event)
    {
        $request = $event->getRequest();
        if($)
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