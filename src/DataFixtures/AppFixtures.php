<?php

namespace App\DataFixtures;

use App\Entity\Person;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create('fr_FR');//instanciation de faker
        for ($i=0; $i < 40; $i++){
            $person = new Person();
            $person->setFirstname($faker->firstName);
            $person->setLastname($faker->lastName);
            $person->setAge($faker->numberBetween(18, 60));
            $person->setJob($faker->company);
            $manager->persist($person);
        }
        $manager->flush();
    }
}
