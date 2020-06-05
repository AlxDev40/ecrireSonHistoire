<?php

namespace App\DataFixtures;

use App\Entity\Book;
use App\Entity\Road;
use App\Entity\Chapter;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class BookFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {   //Création de 3 livres.
       for($i = 1; $i<=3; $i++){
            $book = new Book();
            $book   ->setName("Titre du livre N°$i")
                    ->setAuthor("Auteur du livre N°$i")
                    ->setCreatedAt(new \dateTime());
            $manager->persist($book);
            //Création de 5 chapitres par livre.
            for($j = 1; $j<=5; $j++){
                $chapter = new Chapter();
                $chapter->setBook($book)
                        ->setNumber("chapitre n°$j")
                        ->setName("Chapitre n°$j")
                        ->setText("text du chapitre n°$j")
                        ->setDescriptionText("Description du text N°$j");
                $manager->persist($chapter);

                //création de deux route par chapitre.
                for($k = 1; $k<=2; $k++){
                    $road = new Road();
                    $road   ->setContent("Road N°$k du chapitre N°$j")
                            ->setChapter($chapter);
                    $manager->persist($road);
                }
            }
        }
    $manager->flush();
    }
}
