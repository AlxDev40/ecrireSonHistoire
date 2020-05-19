<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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
        return $this->render('esh/home.html.twig', [
            'title'=>'Ecrire son histoire - Accueil',
        ]);
    }
       /**
     * @route("/rules", name="esh_rules")
     */
    public function rules(){
        return $this->render('esh/rules.html.twig');
    }

     /**
     * @route("/login", name="esh_login")
     */
    public function login(){
        return $this->render('esh/login.html.twig');
    }

    /**
     * @route("/registration", name="esh_registration")
     */
    public function registration(){
        return $this->render('esh/registration.html.twig');
    }
}
