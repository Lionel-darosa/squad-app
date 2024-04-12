<?php

namespace App\DataFixtures;

use App\Entity\Intervention;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class InterventionFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        $techs = UserFixtures::USERS;
        $theaters = TheatreFixtures::THEATERS;
        $equipements = EquipementFixtures::EQUIPEMENTS;
        $interventionResponse = Intervention::INTERVENTION;
        for ($i = 0; $i < 200; $i++) {
            $equipementInjured = $equipements[$faker->randomKey($equipements)][$faker->numberBetween(0, 3)];
            $intervention = new Intervention();
            $intervention->setDateTime($faker->dateTimeBetween('-3 month', 'now'))
                ->setTech($this->getReference('tech_' . $techs[$faker->numberBetween(0, 3)]['email']))
                ->addRoom($this->getReference('theater_' . $theaters[$faker->numberBetween(0, 6)]['name'] . '_room_' . $faker->numberBetween(1, 12)))
                ->addEquipement($this->getReference('brand_' . $equipementInjured['brand'] . '_name_' . $equipementInjured['name']))
                ->setContact($faker->randomElement([1, 0]))
                ->setType($faker->randomElement($interventionResponse['type']))
                ->setResolved($faker->randomElement($interventionResponse['resolved']))
                ->setCanceled($faker->randomElement($interventionResponse['canceled']))
                ->setDescription($faker->text(150));

            $manager->persist($intervention);
        }
        
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            TheatreFixtures::class,
            RoomFixtures::class,
            EquipementFixtures::class,
        ];
    }
}
