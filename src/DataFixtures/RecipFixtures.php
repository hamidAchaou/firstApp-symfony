<?php

namespace App\DataFixtures;

use App\Entity\Recip;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RecipFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Array of sample recipes
        $recipes = [
            [
                'title' => 'Pasta Primavera',
                'slug' => 'pasta-primavera',
                'content' => 'A classic Italian pasta dish with fresh vegetables.',
                'duration' => 25,
            ],
            [
                'title' => 'Chicken Curry',
                'slug' => 'chicken-curry',
                'content' => 'A spicy and flavorful chicken curry recipe.',
                'duration' => 45,
            ],
            [
                'title' => 'Chocolate Cake',
                'slug' => 'chocolate-cake',
                'content' => 'A rich and moist chocolate cake perfect for dessert.',
                'duration' => 60,
            ],
            [
                'title' => 'Caesar Salad',
                'slug' => 'caesar-salad',
                'content' => 'A fresh salad with crispy croutons and creamy dressing.',
                'duration' => 15,
            ],
            [
                'title' => 'Grilled Salmon',
                'slug' => 'grilled-salmon',
                'content' => 'Perfectly grilled salmon with a hint of lemon and herbs.',
                'duration' => 20,
            ],
        ];

        // Adding recipes to the database
        foreach ($recipes as $data) {
            $recip = new Recip();
            $recip->setTitle($data['title']);
            $recip->setSlug($data['slug']);
            $recip->setContent($data['content']);
            $recip->setCreatedAt(new \DateTimeImmutable());
            $recip->setUpdatedAt(new \DateTimeImmutable());
            $recip->setDuration($data['duration']);

            $manager->persist($recip);
        }

        // Save all recipes to the database
        $manager->flush();
    }
}
