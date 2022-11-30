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
     /* formatear la fecha y ver diferencia de segundos y horas*/

        $config = array_merge(self::CONFIGURATION, $config);
        $datecurrent = new \DateTime();
        $date = $date->format($config['format']);

        $config = array_merge(self::CONFIGURATION, $config);
      
        $datecurrent = new \DateTime();
    
        $dateformat = $date->format($config['format']);
        dd('fdgfdgd'.$dateformat);
      
        $differenceDateSecounds = $datecurrent->getTimestamp() - $date->getTimestamp();

        if ($differenceDateSecounds < 60){
            $dateformat = 'Hace ' . $differenceDateSecounds . ' segundos';
        }elseif ($differenceDateSecounds < 3600){
            $dateformat = 'Hace ' . round($differenceDateSecounds / 60) . ' minutos';
        }elseif ($differenceDateSecounds < 14400){
            $dateformat = 'Hace ' . round($differenceDateSecounds / 3600) . ' horas';
        }
        return $dateformat;
        return $date;
    }
}