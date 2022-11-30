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

        $config = array_merge(self::CONFIGURATION, $config); // merge de arrays
         /* fecha actual*/
        $now = new \DateTime();
        /* formatear la fecha */
        $dateFormat = \DateTime::createFromFormat($config['format'], $date);

       

       
        var_dump($date->getTimestamp());

      
        $differenceDateSecounds = $date->getTimestamp() - $date->getTimestamp();

        if ($differenceDateSecounds < 60){
            $date = 'Hace ' . $differenceDateSecounds . ' segundos';
        }elseif ($differenceDateSecounds < 3600){
            $date = 'Hace ' . round($differenceDateSecounds / 60) . ' minutos';
        }elseif ($differenceDateSecounds < 14400){
            $date = 'Hace ' . round($differenceDateSecounds / 3600) . ' horas';
        }
      
        return $date;
    }
}