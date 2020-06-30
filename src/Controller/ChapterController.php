<?php

namespace App\Controller;

use App\Entity\Chapter;
use App\Form\ChapterType;
use App\Repository\BookRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/chapter")
 */
class ChapterController extends AbstractController
{
    /**
     * @var ObjetctManager
     */
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }


    /**
     * @Route("/", name="chapter_index")
     */
    public function index(BookRepository $bookRepo)
    {
        $user = $this->getUser();

        $book = $bookRepo->findOneByUser($user);
        //$book = $bookRepo->findOneByUser(array($user), array('number' => 'desc'));

        return $this->render('chapter/indexChapter.html.twig', [
            'user' => $user,
            'book' => $book
        ]);
    }


    /**
     * @Route("/create", name="chapter_create")
     */
    public function create(Request $request)
    {

        $chapter = new Chapter();
        $form = $this->createForm(chaptertype::class, $chapter);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->manager->persist($chapter);
            $this->manager->flush();
            $this->addFlash('success', 'Le chapitre ' . $chapter->getNumber() . ' à bien été créé.');
            return $this->redirectToRoute('chapter_index', ['id' => $chapter->getBook()->getId()]);
        }

        return $this->render('chapter/createChapter.html.twig', [
            'chapter' => $chapter,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/edit/{id}", name="chapter_edit", methods={"GET","POST"})
     */
    public function edit(Chapter $chapter, Request $request)
    {
        $form = $this->createForm(ChapterType::class, $chapter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->manager->flush();
            $this->addFlash('success', 'Le chapitre ' . $chapter->getNumber() . ' à bien été modifié.');
            return $this->redirectToRoute('chapter_index', ['id' => $chapter->getBook()->getId()]);
        }

        return $this->render('chapter/editChapter.html.twig', [
            'chapter' => $chapter,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/edit/{id}", name="chapter_delete", methods={"DELETE"})
     */
    public function delete(Chapter $chapter, Request $request)
    {
        if ($this->isCsrfTokenValid('delete' . $chapter->getId(), $request->get('_token'))) {
            $this->manager->remove($chapter);
            $this->manager->flush();
            $this->addFlash('success', 'Le chapitre ' . $chapter->getNumber() . ' à bien été supprimé.');
        }
        return $this->redirectToRoute('chapter_index', ['id' => $chapter->getBook()->getId()]);
    }
}
