<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\Road;
use App\Entity\Character;
use App\Form\BookType;
use App\Repository\ChapterRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/book")
 */
class BookController extends AbstractController
{
    /**
     * @var ObjetctManager
     */
    private $manager;

    public function __construct(ObjectManager $manager, ChapterRepository $chapterRepo)
    {
        $this->manager = $manager;
        $this->chapterRepo = $chapterRepo;
    }

    /**
     * @Route("/", name="book_index")
     */
    public function index()
    {
        $user = $this->getUser();

        return $this->render('book/indexBook.html.twig', [
            'user' => $user
        ]);
    }

    /**
     * @Route("/edit/{id}", name="book_edit")
     */
    public function edit(Book $book, Request $request)
    {
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->manager->flush();
            return $this->redirectToRoute('book_index');
        }

        return $this->render('book/editBook.html.twig', [
            'book' => $book,
            'form' => $form->createView()
        ]);
    }
}
