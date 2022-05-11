<?php

namespace App\Controller;


use App\Entity\Session;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SessionController extends AbstractController
{
       
    /**
     * @Route("/session", name="index_session")
     */
    public function indexSession(ManagerRegistry $doctrine): Response
    {
        $sessions = $doctrine->getRepository(Session::class)->findAll();
        
        return $this->render('session/index.html.twig', [
            'sessions' => $sessions,
        ]);
    }

      /**
     * @Route("/session/{id}", name="show_session")
     */
    public function show(Session $session): Response
    {
        return $this->render('session/show.html.twig', [
            'session' => $session,
        ]);
    }    
}
