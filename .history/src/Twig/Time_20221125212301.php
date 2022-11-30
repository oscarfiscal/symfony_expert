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
        $datecurrent = new \DateTime();
        $dateformat = $date->format($config['format']);
        $differenceDateSecounds = $datecurrent->getTimestamp() - $date->getTimestamp();

        if ($differenceDateSecounds < 60){
            $dateformat = 'Hace ' . $differenceDateSecounds . ' segundos';
        }else
    }
}