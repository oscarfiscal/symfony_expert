<?php
namespace App\Twig;

class Time extends AbstractExtension
{
    const CONFIGURATION = [
        'format' => 'y'
    ];
    public function getFilters()
    {
        return [
            new TwigFilter('time', [$this, 'timeFilter']),
        ];
    }

    public function timeFilter($value)
    {
        $time = new \DateTime($value);
        return $time->format('H:i');
    }
}