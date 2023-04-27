<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        $categories = [];
        for ($i = 0; $i < 50; $i++) {

            $category = new Category();
            $category
                ->setName($faker->word);

            $categories[] = $category;
            $manager->persist($category);
        }
        for ($i = 0; $i < 50; $i++) {
            $product = new Product();
            $product
                ->setName($faker->word)
                ->setDescription($faker->sentence())
                ->setPrice($faker->randomFloat(2, 10, 1000))
                ->setVisible($faker->boolean(80))
                ->setDiscount($faker->boolean(30))
                ->setCategory($faker->randomElement($categories));

            $manager->persist($product);
        }
        $manager->flush();
    }
}
