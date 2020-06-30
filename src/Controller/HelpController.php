<?php

namespace App\Controller;

use App\Entity\Help;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/help")
 */
class HelpController extends AbstractController
{
    /**
     * @Route("/tip/{id}", name="help_getOne", methods={"GET"})
     */
    public function tip(Help $help): Response
    {
        return $this->json($help);
    }
}
