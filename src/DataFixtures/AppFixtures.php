<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Post;
use App\Entity\Garant;
use App\Entity\Images;
use App\Entity\Kafala;
use App\Entity\Familly;
use App\Entity\Projets;
use App\Entity\Orphelin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker =Factory::create('FR-fr');
       $orphelins= [];
       $famillys= [];
       $genres=['male','female'];

       for( $r=0;$r<=10;$r++)
       {
           $familly = new Familly();

           $date= $faker->dateTime($max = 'now', $timezone = null);
           $familly->setNom($faker->lastname)
                    ->setSetAt($date)
                    ->setPhone($faker->phoneNumber)
                    ->setAdresse($faker->sentence());
            $manager->persist($familly);
           $famillys[]=$familly;
       }

       for( $l=0;$l<=15;$l++)
       {
           $projet = new Projets();
           $content ='<p>' . join('</p><p>',$faker->paragraphs(3)) .'</p>';
           $date= $faker->dateTime($max = 'now', $timezone = null);
           $avatar= $faker->imageUrl(1000,300);
           $projet->setTitre($faker->sentence())
                ->setSetAt($date)
                ->setImage($avatar)
                ->setDescription($content)
                ->setEtat($faker->randomElement(['oui','non']))
                ->setPrix($faker->randomFloat(2,250,5000));
            $manager->persist($projet);
       }

       for( $k=0;$k<=10;$k++)
       {
           $orphelin = new Orphelin();

           $genre=$faker->randomElement($genres);
           $image = 'http://randomuser.me/api/portraits/';
           $picturesID =$faker->numberBetween(1,99). '.jpg';
           $picture = $image.($genre =='male' ? 'men/' : 'women/').$picturesID;
           $date= $faker->dateTime($max = 'now', $timezone = null);
           $familly=$famillys[mt_rand(0,count($famillys) - 1 )];
           $orphelin->setFirstName($faker->username)
                ->setLastName($faker->lastname)
                ->setImage($picture)
                ->setGenre($genre)
                ->setSetAt($date)
                ->setFamilly($familly)
                ->setAdresse($faker->sentence());
            $manager->persist($orphelin);
           $orphelins[]=$orphelin;
       }


       $garants= [];

       for( $k=0;$k<=10;$k++)
       {
           $garant = new Garant();

           $genre=$faker->randomElement($genres);
           $image = 'http://randomuser.me/api/portraits/';
           $picturesID =$faker->numberBetween(1,99). '.jpg';
           $picture = $image.($genre =='male' ? 'men/' : 'women/').$picturesID;
           $date= $faker->dateTime($max = 'now', $timezone = null);
           $garant->setFirstName($faker->username)
                ->setLastName($faker->lastname)
                ->setPaye($faker->randomElement(['Maroc','France','Allemend']))
                ->setSetAt($date)
                ->setEmail($faker->email)
                ->setPhone($faker->phoneNumber)
                ->setAdresse($faker->sentence());
            $manager->persist($garant);
           $garants[]=$garant;
       }

       for( $i=1; $i<=20; $i++)
        { 
        $kafala =new Kafala();

        $titre= $faker->sentence();
        $avatar= $faker->imageUrl(1000,300);
        $content ='<p>' . join('</p><p>',$faker->paragraphs(3)) .'</p>';
        $date= $faker->dateTime($max = 'now', $timezone = null);
        $orphelin=$orphelins[mt_rand(0,count($orphelins) - 1 )];
        $garant=$garants[mt_rand(0,count($garants) - 1 )];

        $kafala ->setSetAtdebut($date)
              ->setType($faker->randomElement(['DH','$','autre']))
              ->setOrphelin($orphelin)
              ->setGarant($garant)
              ->setPrix($faker->randomFloat(2,250,5000))
              ->setPeriode($faker->randomElement(['Mons','trimestriel','annee']));
        $manager->persist($kafala);
        }

        for( $i=1; $i<=30; $i++)
        { 
        $post =new Post();

        $titre= $faker->sentence();
        $avatar= $faker->imageUrl(1000,300);
        $content ='<p>' . join('</p><p>',$faker->paragraphs(3)) .'</p>';
        $date= $faker->dateTime($max = 'now', $timezone = null);

        $post->setTitre($titre)
              ->setImage($avatar)
              ->setSetAt($date)
              ->setDescription($content);
        for($j=1; $j<=mt_rand(2,5); $j++)
        {
            $image =new Images();

            $image->setLien($faker->imageUrl())
                    ->setCaption($faker->sentence())
                    ->setPost($post);
            $manager->persist($image);

        }

        $manager->persist($post);
        }


       
        $manager->flush();
    }
}
