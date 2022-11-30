<?php

namespace App\EventSuscriber;

use 

class LenguageSuscriber implements EventSuscriberInterface
{
    public  static  function  getSubscribedEvents ()
    {
        return [
            KernelEvents::REQUEST => [
                ['onKernelRequest', 20],
            ],
        ];
    }
}