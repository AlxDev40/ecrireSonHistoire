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
        {
                //création d'un livre
                $book = new Book();
                $book   ->setName("Titre du livre N°1")
                        ->setAuthor("Auteur du livre N°1")
                        ->setCreatedAt(new \dateTime());
                $manager->persist($book);
                for($i=1; $i<=8; $i++){
                        $chapter = new Chapter();
                        $chapter->setBook($book)
                                ->setNumber($i)
                                ->setName("Chapitre n°$i début")
                                ->setText("text du chapitre n°$i");                  
                        $manager->persist($chapter);
                        for($j=1; $j<=2; $j++){
                                $road = new Road();
                                $road   ->setContent("Boutton $j du chapitre N°$i ")
                                        ->setChapter($chapter);
                                $manager->persist($road);
                        }
                }
                $manager->flush();
        }
}


/* OLD
    
    {   //Création de 1 livre.
       for($i = 1; $i<=1; $i++){
            $book = new Book();
            $book   ->setName("Titre du livre N°$i")
                    ->setAuthor("Auteur du livre N°$i")
                    ->setCreatedAt(new \dateTime());
            $manager->persist($book);
            //Création d'un chapitre
            for($j=1; $j<=1; $j++){
                $chapter = new Chapter();
                $chapter->setBook($book)
                        ->setNumber($j)
                        ->setName("Chapitre n°$j début")
                        ->setText("text du chapitre n°$j");                  
                $manager->persist($chapter);
                //création de deux route par chapitre.
                for($k = 1; $k<=1; $k++){
                $road = new Road();
                $road   ->setContent("Boutton 1 du chapitre N°$j vers l'itinéraire a")
                        ->setChapter($chapter)
                        ->setItinerary('a');
                $manager->persist($road);
                }
                for($l = 1; $l<=1; $l++){
                $road = new Road();
                $road   ->setContent("Boutton 2 du chapitre N°$j vers l'itinéraire b")
                        ->setChapter($chapter)
                        ->setItinerary('b');
                $manager->persist($road);
                }
            }
            //Création d'un chapitre
            for($m=2; $m<=2; $m++){
                $chapter = new Chapter();
                $chapter->setBook($book)
                        ->setNumber($m)
                        ->setName("Chapitre n°$m de l'itinéraire a")
                        ->setText("text du chapitre n°$m")
                        ->setItinerary('a');
                $manager->persist($chapter);
                //création de deux route par chapitre.
                for($n = 1; $n<=1; $n++){
                $road = new Road();
                $road   ->setContent("Boutton 1 du chapitre N°$m pour aller vers a")
                        ->setChapter($chapter)
                        ->setItinerary('a');
                $manager->persist($road);
                }
                for($o = 1; $o<=1; $o++){
                $road = new Road();
                $road   ->setContent("Boutton 2 du chapitre N°$m pour aller vers b")
                        ->setChapter($chapter)
                        ->setItinerary('b');
                $manager->persist($road);
                }
            }
            //Création d'un chapitre
            for($p=3; $p<=3; $p++){
                $chapter = new Chapter();
                $chapter->setBook($book)
                        ->setNumber($p)
                        ->setName("Chapitre n°$p de l'itinéraire a")
                        ->setText("text du chapitre n°$p")
                        ->setItinerary('a');
                $manager->persist($chapter);
                //création de deux route par chapitre.
                for($q = 1; $q<=1; $q++){
                $road = new Road();
                $road   ->setContent("Boutton 1 du chapitre N°$p pour aller vers a")
                        ->setChapter($chapter)
                        ->setItinerary('a');
                $manager->persist($road);
                }
                for($r = 1; $r<=1; $r++){
                $road = new Road();
                $road   ->setContent("Boutton 2 du chapitre N°$p pour aller vers b")
                        ->setChapter($chapter)
                        ->setItinerary('b');
                $manager->persist($road);
                }
            }
            //Création d'un chapitre
            for($s=4; $s<=4; $s++){
                $chapter = new Chapter();
                $chapter->setBook($book)
                        ->setNumber($s)
                        ->setName("Chapitre n°$s de l'itinéraire a")
                        ->setText("text du chapitre n°$s")
                        ->setItinerary('a');
                $manager->persist($chapter);
                //création de deux route par chapitre.
                for($t = 1; $t<=1; $t++){
                $road = new Road();
                $road   ->setContent("Boutton 1 du chapitre N°$s pour l'itinéraire final")
                        ->setChapter($chapter)
                        ->setItinerary('a');
                $manager->persist($road);
                }
            }
            //Création d'un chapitre
            for($u=2; $u<=2; $u++){
                $chapter = new Chapter();
                $chapter->setBook($book)
                        ->setNumber($u)
                        ->setName("Chapitre n°$u de l'itinéraire b")
                        ->setText("text du chapitre n°$u")
                        ->setItinerary('b');
                $manager->persist($chapter);
                //création de deux route par chapitre.
                for($v = 1; $v<=1; $v++){
                $road = new Road();
                $road   ->setContent("Boutton 1 du chapitre N°$u pour aller vers a")
                        ->setChapter($chapter)
                        ->setItinerary('a');
                $manager->persist($road);
                }
                for($w = 1; $w<=1; $w++){
                $road = new Road();
                $road   ->setContent("Boutton 2 du chapitre N°$u pour aller vers b")
                        ->setChapter($chapter)
                        ->setItinerary('b');
                $manager->persist($road);
                }
            }
            //Création d'un chapitre
            for($x=3; $x<=3; $x++){
                $chapter = new Chapter();
                $chapter->setBook($book)
                        ->setNumber($x)
                        ->setName("Chapitre n°$x de l'itinéraire b")
                        ->setText("text du chapitre n°$x")
                        ->setItinerary('b');
                $manager->persist($chapter);
                //création de deux route par chapitre.
                for($y = 1; $y<=1; $y++){
                $road = new Road();
                $road   ->setContent("Boutton 1 du chapitre N°$x pour aller vers a")
                        ->setChapter($chapter)
                        ->setItinerary('a');
                $manager->persist($road);
                }
                for($z = 1; $z<=1; $z++){
                $road = new Road();
                $road   ->setContent("Boutton 2 du chapitre N°$x pour aller vers b")
                        ->setChapter($chapter)
                        ->setItinerary('b');
                $manager->persist($road);
                }
            }
            //Création d'un chapitre
            for($a=4; $a<=4; $a++){
                $chapter = new Chapter();
                $chapter->setBook($book)
                        ->setNumber($a)
                        ->setName("Chapitre n°$a de l'itinéraire b")
                        ->setText("text du chapitre n°$a")
                        ->setItinerary('b');
                $manager->persist($chapter);
                //création de deux route par chapitre.
                for($t = 1; $t<=1; $t++){
                $road = new Road();
                $road   ->setContent("Boutton 1 du chapitre N°$a pour l'itinéraire final")
                        ->setChapter($chapter)
                        ->setItinerary('a');
                $manager->persist($road);
                }
            }
            //Création d'un chapitre
            for($a=5; $a<=5; $a++){
                $chapter = new Chapter();
                $chapter->setBook($book)
                        ->setNumber($a)
                        ->setName("Chapitre n°$a final")
                        ->setText("text du chapitre n°$a");
                $manager->persist($chapter);
            }
        }
    $manager->flush();
    }*/