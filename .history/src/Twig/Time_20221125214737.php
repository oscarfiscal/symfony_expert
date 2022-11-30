<?php
namespace App\Twig;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class Time extends AbstractExtension
{
    const CONFIGURATION = [
        'format' => 'Y/m/d H:m:s',
    ];
    public function getFilters()
    {
        return [
            new TwigFilter('time', [$this, 'timeFilter']),
        ];
    }

    public function timeFilter($date, $config = [])
    {
        /* TODO: implement the filter here */

        
    }
}