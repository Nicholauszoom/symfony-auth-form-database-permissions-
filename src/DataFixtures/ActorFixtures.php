<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ActorFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $actor = new Actor();
        $actor->setName('Christian Bale');
        $manager->persist($actor);
       


        $actor2 = new Actor();
        $actor2->setName('Meline Deny');
        $manager->persist($actor2);


        $manager->flush();



        $this->addReference('actor_01',$actor);
        $this->addReference('actor_02',$actor2); 
    }
}
