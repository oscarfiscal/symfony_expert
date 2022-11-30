<?php

namespace App\EventSuscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class LenguageSuscriber implements EventSuscriberInterface
{
    public  static  function  getSubscribedEvents ()
    {
        return [
            KernelEvents::REQUEST => [
                ['', 20],
            ],
        ];
    }
}