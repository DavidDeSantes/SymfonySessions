<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ModulerController extends AbstractController
{
    /**
     * @Route("/moduler", name="app_moduler")
     */
    public function index(): Response
    {
        return $this->render('moduler/index.html.twig', [
            'controller_name' => 'ModulerController',
        ]);
    }
}
