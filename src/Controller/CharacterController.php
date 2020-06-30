<?php

namespace App\Controller;

use App\Entity\Character;
use App\Form\CreateCharacterType;
use App\Repository\EquipmentRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/character")
 */

class CharacterController extends AbstractController
{
    /**
     * @Route("/character", name="character")
     *//*
    public function index()
    {
        return $this->render('character/index.html.twig', [
            'controller_name' => 'CharacterController',
        ]);
    }*/

    //Fonction permmettant la création d'un personnage.
    /**
     * @route("/create", name="character_create")
     */
    public function createCharacter(UserInterface $user, Request $request, ObjectManager $manager, EquipmentRepository $repo)
    {
        $character = new Character();

        $form = $this->createForm(CreateCharacterType::class, $character);

        $form->handleRequest($request);

        if ($character->getClass() == 'Magicien') {
            $equipment = $repo->findOneByName('baton');
            $character->addEquipment($equipment);
        } elseif ($character->getClass() == 'Guerrier') {
            $equipment = $repo->findOneByName('Epée simple');
            $character->addEquipment($equipment);
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $character->setUser($user);
            $character->setDexterity('1');
            $character->setLevel('1');
            $character->setLifePoint('10');
            $character->setAttack('1');
            $character->setDefense('1');
            $manager->persist($character);
            $manager->flush();
            return $this->redirectToRoute('memberPage');
        }

        return $this->render('character/createCharacter.html.twig', [
            'formCharacter' => $form->createView(),
        ]);
    }

    /**
     * @Route("/deleteCharacter/{id}", name="character_delete")
     */
    public function deleteCharacter(Character $character, ObjectManager $manager)
    {
        $manager->remove($character);
        $manager->flush();
        return $this->redirectToRoute('memberPage');
    }
}
