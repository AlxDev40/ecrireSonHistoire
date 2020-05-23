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
        return $this->render('esh/rules.html.twig', [
            'title'=>'Ecrire son histoire - Règles'
        ]);
    }
    
}
