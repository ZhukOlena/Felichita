<?php

declare(strict_types = 1);

namespace App\DataFixtures;


use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class LoadProducts extends Fixture implements DependentFixtureInterface
{
    public function getDependencies(): array
    {
        return [
            LoadProductCategories::class
        ];

    }

    public function load(ObjectManager $manager)
    {
        $products = [
            [
                'category' => 'child',
                'title' => 'Burger',
                'sub_title' => 'Child burger',
                'ingredients' => 'bread, cheese, sous, tomato, potato',
                'price' => 198.0,
                'weight' => 330,
                'calories' => 280,
                'image' => '/fixtures/burger.png'
            ],

            [
                'category' => 'child',
                'title' => 'Potato fries',
                'sub_title' => '',
                'ingredients' => 'potato, oil, salt',
                'price' => 56.0,
                'weight' => 100,
                'calories' => 0,
                'image' => '/fixtures/potato.png',
            ],

            [
                'category' => 'soup',
                'title' => 'Borsch',
                'sub_title' => 'Ukrainian Borsch',
                'ingredients' => '',
                'price' => 100.0,
                'weight' => 700,
                'calories' => 300,
                'image' => '/fixtures/borsch.png',
            ],

            [
                'category' => 'soup',
                'title' => 'Green soup',
                'sub_title' => 'Ukrainian Soup',
                'ingredients' => 'Potato, carrot, onion, green tree',
                'price' => 150.0,
                'weight' => 500,
                'calories' => 200,
                'image' => '/fixtures/green_soup.png',
            ],

            [
                'category' => 'pizza',
                'title' => 'Americano',
                'sub_title' => 'Americano with tomato',
                'ingredients' => 'sausage, tomato, cheese, sauce ',
                'price' => 140.0,
                'weight' => 350,
                'calories' => 400,
                'image' => '/fixtures/americano.png',
            ],

            [
                'category' => 'pizza',
                'title' => 'Hawaii',
                'sub_title' => 'Hawaii with corn',
                'ingredients' => 'chicken, corn, sauce',
                'price' => 120.0,
                'weight' => 300,
                'calories' => 400,
                'image' => '/fixtures/hawaii.png',
            ],

            [
                'category' => 'salad',
                'title' => 'In salad of town ',
                'sub_title' => 'Vegetable salad',
                'ingredients' => 'salad mix, cherry tomatoes, garlic, bell pepper, olives, carrots, mint, fresh basil, Parmesan cheese, ground olives',
                'price' => 145.0,
                'weight' => 200,
                'calories' => 155,
                'image' => '/fixtures/town.png',
            ],

            [
                'category' => 'salad',
                'title' => 'Greek salad',
                'sub_title' => 'Vegetable salad with feta cheese',
                'ingredients' => 'feta cheese, cherry tomatoes, fresh cucumbers, bell pepper, salad mix ',
                'price' => 170.0,
                'weight' => 300,
                'calories' => 115,
                'image' => '/fixtures/greek_salad.png',
            ],

        ];

        foreach ($products as $item) {
            $product = new Product();

            $category = $this->getReference('product_category:'.$item['category']);

            $product->setCategory($category);
            $product->setTitle($item ['title']);
            $product->setSubTitle($item ['sub_title']);
            $product->setIngredients($item ['ingredients']);
            $product->setPrice($item ['price']);
            $product->setWeight($item ['weight']);
            $product->setCalories($item ['calories']);
            $product->setImagePath($item ['image']);

            $manager->persist($product);
        }

        $manager->flush();
    }
}
