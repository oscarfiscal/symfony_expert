<?php
namespace App\Twig;

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
        $config = array_merge(self::CONFIGURATION, $config);
        $datecurrent 
        $date = new \DateTime($date);
        return $date->format($config['format']);
    }
}