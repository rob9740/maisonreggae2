<?php

namespace App\DataFixtures;

use App\Entity\Musiques;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        for($i = 0 ; $i <= 5 ; $i++){

            $musique = new Musiques();

            $musique->setNom('the pioneers');
            $musique->setAlbum('Greatest hits');
            $musique->setImg('img.jpg');
            $musique->setReference('456');
            $musique->setLabel('Trojan Records');
            $musique->setPrix('15');

            $manager->persist($musique);
            $manager->flush();
        }
    }
}
