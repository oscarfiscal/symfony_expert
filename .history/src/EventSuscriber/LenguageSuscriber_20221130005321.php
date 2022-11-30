<?php

namespace App\EventSuscriber;


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