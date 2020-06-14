<?php

namespace App\DataFixtures;

use App\Entity\Equipment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EquipmentFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $equipment1 = new Equipment();
        $equipment1->setName('Baton');
        $manager->persist($equipment1);

        $equipment2 = new Equipment();
        $equipment2->setName('Epée simple');
        $manager->persist($equipment2);

        $manager->flush();
    }
}
