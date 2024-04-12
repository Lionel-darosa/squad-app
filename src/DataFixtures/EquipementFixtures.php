<?php

namespace App\DataFixtures;

use App\Entity\Equipement;
use App\Entity\Media;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class EquipementFixtures extends Fixture
{
    public const EQUIPEMENTS = [
        'projector' => [
            ['brand' => 'barco', 'name' => 'DP2K15C'],
            ['brand' => 'barco', 'name' => 'DP2000'],
            ['brand' => 'nec', 'name' => 'NC2500'],
            ['brand' => 'nec', 'name' => 'NC2000'],
        ],
        'server' => [
            ['brand' => 'doremi', 'name' => 'DCP-2000'],
            ['brand' => 'doremi', 'name' => 'showvault'],
            ['brand' => 'dolby', 'name' => 'IMS2000'],
            ['brand' => 'dolby', 'name' => 'IMS3000'],
        ],
        'sound-processor' => [
            ['brand' => 'dolby', 'name' => 'CP750'],
            ['brand' => 'dolby', 'name' => 'CP850'],
            ['brand' => 'dolby', 'name' => 'CP950'],
            ['brand' => 'pegase', 'name' => 'pegase'],
        ],
    ];
    
    public function load(ObjectManager $manager): void
    {
        foreach (self::EQUIPEMENTS as $key => $data) {
            foreach ($data as $datum) {
                $equipement = new Equipement();
                $equipement->setName($datum['name'])
                    ->setBrand($datum['brand'])
                    ->settype($key);

                $picture = new Media();
                $picture->setType('picture')
                    ->setName($datum['name'] . '_picture')
                    ->setFile($datum['name'] . '.jpeg');
                $manager->persist($picture);

                $document = new Media();
                $document->setType('document')
                    ->setName($datum['name'] . '_doc')
                    ->setFile($datum['name'] . '.pdf');
                $manager->persist($document);

                $equipement->addMedia($picture)
                    ->addMedia($document);
                $manager->persist($equipement);
                $this->addReference('brand_' . $datum['brand'] . '_name_' . $datum['name'], $equipement);
            }
        }

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
