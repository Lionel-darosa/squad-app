<?php

namespace App\DataFixtures;

use App\Entity\Theatre;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TheatreFixtures extends Fixture
{
    public const THEATERS = [
        ["name"=> "Aquaboulevard", "location"=> "Paris"],
        ["name"=> "Wepler", "location"=> "Paris"],
        ["name"=> "Chavant", "location"=> "Orleans"],
        ["name"=> "Lingostière", "location"=> "Nice"],
        ["name"=> "Massena", "location"=> "Nice"],
        ["name"=> "Opéra", "location"=> "Paris"],
        ["name"=> "Alesia", "location"=> "Paris"],
    ];
    public function load(ObjectManager $manager): void
    {
        foreach (self::THEATERS as $theaterData) {
            $theater = new Theatre();
            $theater->setName($theaterData["name"]);
            $theater->setLocation($theaterData["location"]);
            $manager->persist($theater);

            $this->addReference('theater_' . $theaterData['name'], $theater);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
