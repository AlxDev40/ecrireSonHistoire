<?php

namespace App\Controller;

use App\Entity\Road;
use App\Form\RoadType;
use App\Entity\Chapter;
use App\Repository\BookRepository;
use App\Repository\ChapterRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/road")
 */

class RoadController extends AbstractController
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
     * @Route("/", name="road_index")
     */
    public function index(BookRepository $bookRepo)
    {
        $user = $this->getUser();

        $book = $bookRepo->findOneByUser($user);

        return $this->render('road/indexRoad.html.twig', [
            'user' => $user,
            'book' => $book,
        ]);
    }

    /**
     * @Route("/edit/{id}", name="road_edit", methods="GET|POST")
     */
    public function edit(Road $road, Request $request)
    {
        $form = $this->createForm(RoadType::class, $road);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->manager->flush();
            $this->addFlash('success', 'Le bouton à bien été modifié.');
            return $this->redirectToRoute('road_index');
        }

        return $this->render('road/editRoad.html.twig', [
            'road' => $road,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/create/{id}", name="road_create")
     */
    public function create(Chapter $chapter, Request $request)
    {

        $road = new Road();
        $road->setChapter($chapter);
        $form = $this->createForm(RoadType::class, $road);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->manager->persist($road);
            $this->manager->flush();
            $this->addFlash('success', 'La nouvelle route à été créé.');
            return $this->redirectToRoute('road_index');
        }

        return $this->render('road/createRoad.html.twig', [
            'road' => $road,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/delete/{id}", name="road_delete", methods="DELETE")
     */
    public function delete(Road $road, Request $request)
    {
        if ($this->isCsrfTokenValid('delete' . $road->getId(), $request->get('_token'))) {
            $this->manager->remove($road);
            $this->manager->flush();
            $this->addFlash('success', 'La route à bien été supprimé.');
        }
        return $this->redirectToRoute('road_index');
    }
}
