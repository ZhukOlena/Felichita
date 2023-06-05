<?php

declare(strict_types = 1 );

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\ProductCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LoadProductCategories extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $categories = [
            'primavera_menu' => 'Primavera Menu',
            'child' => 'Child Menu',
            'pizza' => 'Pizza',
            'salad' => 'Salad',
            'snack' => 'Snack',
            'soup' => 'Soup',
        ];

        $priority = 0;

        foreach ($categories as $key => $title) {
            $category = new ProductCategory();
            $category->setTitle($title);
            $category->setPriority(++$priority);

            $this->setReference('product_category:'.$key, $category);

            $manager->persist($category);
        }

        $manager->flush();
    }

}