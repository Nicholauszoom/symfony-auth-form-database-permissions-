<?php

namespace App\DataFixtures;

use App\Entity\Detail;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DetailFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $detail = new Detail();
        $detail->setTitle('heading in helpdesk');
        $detail->setDecription('This is the dscription for help desk support system');
        $detail->setImagePath('https://cdn.pixabay.com/photo/2019/10/16/12/36/clown-4554370_960_720.jpg');
     
        $manager->persist($detail);
        $manager->flush();
 
      
    }
}
