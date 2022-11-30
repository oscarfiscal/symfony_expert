<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Marker;

class MarkerFixtures extends Fixture implements Dependen    
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $marker = new Marker();
        $marker->setName('Google');
        $marker->setUrl('https://www.google.com');
        $marker->setCategory($this->getReference(CategoryFixtures::CATEGORY_INTERNET_REFERENCE));
      
        $manager->persist($marker);

        $manager->flush();
    }
}
