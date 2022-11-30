<?php
namespace App\Twig;

class Time extends AbstractExtension
{
   
    public function getFilters()
    {
        return [
            new TwigFilter('time', [$this, 'timeFilter']),
        ];
    }

    public function timeFilter($time)
    {
        $time = new \DateTime($time);
        return $time->format('H:i');
    }
}