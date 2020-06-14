<?php

namespace App\Controller;


use App\Entity\User;
use App\Entity\Character;
use App\Entity\Equipment;
use App\Form\CreateCharacterType;
use App\Repository\CharacterRepository;
use App\Repository\EquipmentRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EshController extends AbstractController
{
    /**
     * @Route("/", name="esh.home")
     */
    public function home(){
        $repo = $this->getDoctrine()->getRepository(User::class);

        $users = $repo->findAll();

        return $this->render('esh/home.html.twig', [
            'title'=>'Ecrire son histoire - Accueil',
            'users'=>$users
        ]);
    }

    /**
     * @route("/rules", name="esh.rules")
     */
    public function rules(){
        return $this->render('esh/rules.html.twig', [
            'title'=>'Ecrire son histoire - Règles'
        ]);
    }

    /**
     * @Route("/write", name="esh.write")
     */
    public function write(){
        return $this->render('esh/write.html.twig', [
            'title'=>'Ecrire son histoire - Ecriture'
        ]);
    }

    /**
     * @Route("/adminMemberPage", name="esh.adminMemberPage")
     */
    public function adminMemberPage(){
        $user = $this->getUser();

        return $this->render('esh/adminMemberPage.html.twig', [
            'title'=>'Ecrire son histoire - Personnage',
            'user'=>$user,

        ]);
    }

}
