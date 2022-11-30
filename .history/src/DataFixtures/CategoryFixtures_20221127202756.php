<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public const  CATEGORY_INTERNET_REFERENCE = 'category-internet';
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $category = new Category();
        $category->setName('Internet');
        $category->serColor('blue');
        $category->persist($category);

        $manager->flush();
        
        $this->addReference(self::CATEGORY_INTERNET_REFERENCE, $category); 
    }
}
