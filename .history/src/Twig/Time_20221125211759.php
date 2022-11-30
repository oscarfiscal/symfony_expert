<?php
namespace App\Twig;

class Time extends AbstractExtension
{
    const CONFIGURATION = [
        'format' => 'Y/m/d H:i:s',
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