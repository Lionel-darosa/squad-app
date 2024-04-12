<?php

namespace App\DataFixtures;

use App\Entity\Tech;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public const USERS = [
        ['name' => 'Da Rosa Lionel', 'email' => 'l.da-rosa@pathe.fr', 'role' => ['ROLE_CONTRIBUTOR'], 'password' => 'password'],
        ['name' => 'Gauthier Franck','email' => 'f.gauthier@pathe.fr', 'role' => ['ROLE_CONTRIBUTOR'], 'password' => 'password'],
        ['name' => 'Valroff Sebastien','email' => 's.valroff@pathe.fr', 'role' => ['ROLE_CONTRIBUTOR'], 'password' => 'password'],
        ['name' => 'Joulin Christophe','email' => 'c.joulin@pathe.fr', 'role' => ['ROLE_ADMIN'], 'password' => 'password'],
    ];

    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    } 
    
    public function load(ObjectManager $manager): void
    {
        foreach (self::USERS as $user) {
            $contributor = new User();
            $contributor->setEmail($user['email']);
            $contributor->setRoles($user['role']);
            $contributor->setPassword($this->passwordHasher->hashPassword($contributor, $user['password']));
            $tech = new Tech();
            $tech->setName($user['name']);
            $tech->setUser($contributor);

            $manager->persist($tech);

            $this->addReference('tech_' . $contributor->getEmail(), $tech);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
