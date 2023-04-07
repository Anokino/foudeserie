<?php
namespace App\DataFixtures;

use App\Entity\Genre;
use App\Entity\Serie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class SerieFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
         for ($i=0;$i<5;$i++){
            $uneSerie= new Serie();
            $uneSerie->setTitre($faker->sentence(3));
            $uneSerie->setResume($faker->paragraph(3));
            $uneSerie->setPremierediffusion($faker->dateTimeBetween('-10 years', 'now'));
            $uneSerie->setDuree($faker->dateTimeBetween('-10 years', 'now'));
            $uneSerie->setImage("image$i");
            $uneSerie->setLikes($faker->numberBetween(0, 100));
            $manager->persist($uneSerie);
            $manager->flush();
		 }
    }
}