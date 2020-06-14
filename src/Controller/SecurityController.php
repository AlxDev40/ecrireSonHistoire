<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;

use Symfony\Component\HttpFoundation\Request;

use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
  /**
   * @Route("/registration", name="security.registration")
   */
	public function registration(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder){
		$user = new User();

		$form = $this->createForm(RegistrationType::class, $user);

		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid()){
			$hash = $encoder->encodePassword($user, $user->getPassword());
			$user->setPassword($hash);
			$user->setRegistrationDate(new \dateTime());
			$manager->persist($user);
			$manager->flush();
			return $this->redirectToRoute('security.login');
		}

		return $this->render('security/registration.html.twig', [
			'title' => 'Ecrire son histoire - Enregistrement',
			'form' => $form->createView()
		]);
	 }
	 
	 /**
	  * @route("/login", name="security.login")
	  */
	 public function login(){
		 return $this->render('security/login.html.twig', [
			 'title'=>'Ecrire son histoire - Connexion'
		 ]);
	 }

	 /**
	  * @Route("/logout", name="security.logout")
	  */
	 public function logout(){
		 
	 }

	 
}
