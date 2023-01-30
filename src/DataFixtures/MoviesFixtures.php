<?php

namespace App\DataFixtures;

use App\Entity\Movie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MoviesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $movie = new Movie();
        $movie->setTitle('The Dark Knight');
        $movie->setReleaseyYear(2008);
        $movie->setDescription('This is the dscription of the dark knight');
        $movie->setImagePath('https://cdn.pixabay.com/photo/2019/10/16/12/36/clown-4554370_960_720.jpg');
        $movie->addActor($this->getReference('actor_01'));
     
        $manager->persist($movie);


        $movie2 = new Movie();
        $movie2->setTitle('Avengers End Game');
        $movie2->setReleaseyYear(2019);
        $movie2->setDescription('This is the description of the avengers end game');
        $movie2->setImagePath('https://cdn.pixabay.com/photo/2018/05/08/11/36/avenger-3382834_960_720.jpg');
        $movie2->addActor($this->getReference('actor_02'));
        $manager->persist($movie2);

        $manager->flush();
    }
}
