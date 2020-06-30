<?php

namespace App\Controller;

use App\Entity\Equipment;
use App\Form\EquipmentType;
use App\Repository\EquipmentRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("admin/equipment")
 */
class EquipmentController extends AbstractController
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
     * @Route("/", name="equipment_index", methods={"GET"})
     */
    public function index(EquipmentRepository $equipmentRepository): Response
    {
        return $this->render('equipment/indexEquipment.html.twig', [
            'equipment' => $equipmentRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="equipment_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $equipment = new Equipment();
        $form = $this->createForm(EquipmentType::class, $equipment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($equipment);
            $entityManager->flush();

            return $this->redirectToRoute('equipment_index');
        }

        return $this->render('equipment/newEquipment.html.twig', [
            'equipment' => $equipment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="equipment_show", methods={"GET"})
     */
    public function show(Equipment $equipment): Response
    {
        return $this->render('equipment/showEquipment.html.twig', [
            'equipment' => $equipment,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="equipment_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Equipment $equipment): Response
    {
        $form = $this->createForm(EquipmentType::class, $equipment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('equipment_index');
        }

        return $this->render('equipment/editEquipment.html.twig', [
            'equipment' => $equipment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="equipment_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Equipment $equipment): Response
    {
        if ($this->isCsrfTokenValid('delete' . $equipment->getId(), $request->request->get('_token'))) {
            $this->manager->remove($equipment);
            $this->manager->flush();
            $this->addFlash('success', 'L\'equipement ' . $equipment->getName() . ' à bien été supprimé.');
        }

        return $this->redirectToRoute('equipment_index');
    }
}
