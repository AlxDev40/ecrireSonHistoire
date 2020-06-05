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
     * @Route("/adminMemberPage", name="esh_adminMemberPage")
     */
    public function adminMemberPage(CharacterRepository $repo, EquipmentRepository $repoEquipment){
        $user = $this->getUser();
        //C'est ici que je crée un $id qui contient l'id du user, ensuite je crée un $character qui contient l'id du $user et qui me permettra de dire dans la page adminMemberPage que (if il y a un $character dans mon $user alors j'ai un affichage twig else un autre affichage.)Il y à surement mieux, hein David ??????

        $characters = $repo->findBy(array('user'=>$user->getId()));
       

        return $this->render('esh/adminMemberPage.html.twig', [
            'title'=>'Ecrire son histoire - Personnage',
            'user'=>$user,
            'characters'=>$characters,
           
        ]);
    }

    /**
     * @Route("/deleteCharacter/{id}", name="esh_deleteCharacter")
     */
    public function deleteCharacter(Character $character, ObjectManager $manager){

        $manager->remove($character);
        $manager->flush();
        return $this->redirectToRoute('esh_adminMemberPage');
    }

    /**
     * @route("/createCharacter", name="esh_createCharacter")
     */
    public function createCharacterText(UserInterface $user, Request $request, ObjectManager $manager,EquipmentRepository $repo){
        $character = new Character();

        $form = $this->createForm(CreateCharacterType::class, $character);

        $form->handleRequest($request);
    
        if($character->getClass()=='Magicien'){
            $equipment = $repo->findOneByName('baton');
            $character->addEquipment($equipment);
        } elseif ($character->getClass()=='Guerrier'){
            $equipment = $repo->findOneByName('Epée simple');
            $character->addEquipment($equipment);
        }
        
        if($form->isSubmitted() && $form->isValid()){
            $character->setUser($user);
            $character->setDexterity('1');
            $character->setLevel('1');
            $character->setLifePoint('10');
            $character->setAttack('1');
            $character->setDefense('1');
            $manager->persist($character);
            $manager->flush();
            return $this->redirectToRoute('esh_adminMemberPage');
        }

        return $this->render('esh/createCharacter.html.twig', [
            'title'=>'Ecrire son histoire - Créer un personnage',
            'formCharacter'=>$form->createView(),
		]);
    }

}
