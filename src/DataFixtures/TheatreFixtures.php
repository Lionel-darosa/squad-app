<?php

namespace App\DataFixtures;

use App\Entity\Theatre;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TheatreFixtures extends Fixture
{
    public const THEATRES = [
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
        foreach (self::THEATRES as $theatreData) {
            $theatre = new Theatre();
            $theatre->setName($theatreData["name"]);
            $theatre->setLocation($theatreData["location"]);
            $manager->persist($theatre);

            $this->addReference('theatre_' . $theatreData['name'], $theatre);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
