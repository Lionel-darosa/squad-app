<?php

namespace App\DataFixtures;

use App\Entity\Room;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class RoomFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        $equipement = EquipementFixtures::EQUIPEMENTS;
        $theatres = TheatreFixtures::THEATRES;
        foreach ($theatres as $theatre) {
            for ($i = 1; $i < 13; $i++) {
                $room = new Room();
                $room->setNumber($i);
                $room->setTheatre($this->getReference('theatre_' . $theatre['name']));

                $projector = $equipement['projector'][$faker->numberBetween(0, 3)];
                $room->addEquipement($this->getReference('brand_' . $projector['brand'] . '_name_' . $projector['name']));

                $server = $equipement['server'][$faker->numberBetween(0, 3)];
                $room->addEquipement($this->getReference('brand_' . $server['brand'] . '_name_' . $server['name']));

                $soundProcessor = $equipement['sound-processor'][$faker->numberBetween(0, 3)];
                $room->addEquipement($this->getReference('brand_' . $soundProcessor['brand'] . '_name_' . $soundProcessor['name']));

                $manager->persist($room);
                $this->addReference('theatre_' . $theatre['name'] . '_room_' . $room->getNumber(), $room);
            };
        };

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            TheatreFixtures::class,
            EquipementFixtures::class,
        ];
    }
}
