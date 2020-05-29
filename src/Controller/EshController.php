<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Character;
use App\Form\CharacterType;
use App\Repository\CharacterRepository;
use App\Repository\UserRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\User\UserInterface;

class EshController extends AbstractController
{
    /**
     * @Route("/esh", name="esh")
     */
    public function index()
    {
        return $this->render('esh/index.html.twig', [
            'controller_name' => 'EshController',
        ]);
    }

    /**
     * @Route("/", name="esh_home")
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
     * @route("/rules", name="esh_rules")
     */
    public function rules(){
        return $this->render('esh/rules.html.twig', [
            'title'=>'Ecrire son histoire - Règles'
        ]);
    }

    /**
     * @Route("/write", name="esh_write")
     */
    public function write(){
        return $this->render('esh/write.html.twig', [
            'title'=>'Ecrire son histoire - Ecriture'
        ]);
    }

    /**
     * @Route("/adminMemberPage/{id}", name="esh_adminMemberPage")
     */
    public function adminMemberPage(UserRepository $user, CharacterRepository $repo){
        dump($user);
        $characters = $repo->findall();

        dump($characters);
       
        return $this->render('esh/adminMemberPage.html.twig', [
            'title'=>'Ecrire son histoire - Personnage',
            'characters'=> $characters,
            'user'=>$user,
           
        ]);
    }

    /**
    * @route("/createCharacter", name="esh_character")
    */
	  public function createCharacter(UserInterface $user, Request $request, ObjectManager $manager){
        $character = new Character();

        $form = $this->createForm(CharacterType::class, $character);
        
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $character->setUser($user);
            $manager->persist($character);
            $manager->flush();
            return $this->redirectToRoute('esh_story');
        }

        return $this->render('esh/createCharacter.html.twig', [
            'title'=>'Ecrire son histoire - Créer un personnage',
            'formCharacter'=>$form->createView()
		]);
	}
}
