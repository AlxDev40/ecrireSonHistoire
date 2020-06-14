<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\Road;
use App\Entity\Chapter;
use App\Entity\Character;
use App\Repository\BookRepository;
use App\Repository\RoadRepository;
use App\Repository\ChapterRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReadBookController extends AbstractController
{
    /**
     * @Route("/readBook/{id}", name="read.book")
     */
    public function index(Character $character, ChapterRepository $chapterRepo)
    {
        $user = $this->getUser();
        $currentChapter = $character->getCurrentChapter();
        $chapter = $chapterRepo->find($currentChapter);

        return $this->render('read/show.html.twig', [
            'user'=>$user,
            'character'=>$character,
            'chapter'=>$chapter,
        ]);
    }

    //Cette fonction est lancer au moment du clique sur le nom du personnage dans la page adminMemberPage.html.twig.Elle permet de lancer l'affichage des chapitres en fonction de la position ($currentChapter) du personnage.
    /**
     * @Route("/readBook/initiate/{id}", name="readBook.initiate")
     */
    public function initiate(Character $character, ObjectManager $manager, ChapterRepository $repo)
    {
        $currentChapter = $character->getCurrentChapter();
        
        if($currentChapter === null){
            $character->setCurrentChapter($repo->findOneByNumber('1'));
            $manager->flush();
            return $this->redirectToRoute('read.book', ['id'=> $character->getId()]);
        } else {
            return $this->redirectToRoute('read.book', ['id'=> $character->getId()]);
        }
    }

    /**
     * @Route("/readBook/character/{character}/road/{road}", name="readBook.goToChapter")
     */
    public function goToChapter(Character $character,Road $road, ObjectManager $manager)
    {
        if($road->getTargetChapter() === null){
            return $this->redirectToRoute('esh.adminMemberPage');
        } else {
           
            $character->setCurrentChapter($road->getTargetChapter());
            $manager->flush();
        
            return $this->redirectToRoute('read.book', ['id'=> $character->getId()]);
        }
    }
}
