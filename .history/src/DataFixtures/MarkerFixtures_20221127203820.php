<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Marker;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class MarkerFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for($i=)
        $marker = new Marker();
        $marker->setName('Google');
        $marker->setUrl('https://www.google.com');
        $marker->setCategory($this->getReference(CategoryFixtures::CATEGORY_INTERNET_REFERENCE));
      
        $manager->persist($marker);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
    }
}
