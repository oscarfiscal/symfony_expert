<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Marker;

class MarkerFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $marker = new Marker();
        $marker->setName('Google');
        $marker->setUrl('https://www.google.com');
        $marker->setCatgory
      
        $marker->persist($marker);

        $manager->flush();
    }
}
