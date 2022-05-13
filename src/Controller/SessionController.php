<?php

namespace App\Controller;


use App\Entity\Session;
use App\Entity\Stagiaire;
use App\Form\SessionType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class SessionController extends AbstractController
{
       
    /**
     * @Route("/session", name="index_session")
     */
    public function indexSession(ManagerRegistry $doctrine): Response
    {
        $sessions = $doctrine->getRepository(Session::class)->findBy([], ["dateDebut" => "ASC"]);
        
        return $this->render('session/index.html.twig', [
            'sessions' => $sessions,
        ]);
    }

      /**
     * @Route("/session/add", name="add_session")
     *  @Route("/session/update/{id}", name="update_session")
     */
    public function add(ManagerRegistry $doctrine, Session $session = null, Request $request): Response
    {

        if(!$session) {
            $session = new Session();
        }

        $entityManager = $doctrine->getManager();
        $form = $this->createForm(SessionType::class, $session);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            
            $session = $form->getData();
            $entityManager->persist($session);
            $entityManager->flush();
            
            return $this->redirectToRoute('index_session');
        }
        return $this->render('session/add.html.twig', [
            'formSession' => $form->createView(),
        ]);
    }

        /**
     * @Route("/session/delete/{id}", name="delete_session")
     */
    public function delete(ManagerRegistry $doctrine, Session $session)
    {
        $entityManager = $doctrine->getManager();
        $entityManager->remove($session);
        $entityManager->flush();

        return $this->redirectToRoute("index_session");
    }

      /**
     * @Route("/session/{id}", name="show_session")
     */
    public function show(Session $session, ManagerRegistry $doctrine): Response
    {
        // $stagiaires = $doctrine->getRepository(Stagiaire::class)->findBy([], ["nom" => "ASC"]);
        $stagiaires = $doctrine->getRepository(Session::class)->getNonInscrits($session->getId());
        return $this->render('session/show.html.twig', [
            'session' => $session,
            'stagiaires' => $stagiaires
        ]);
    }

    /**
        * @Route("/session/inscrire/{idSession}/stagiaire/{idStagiaire}", name="inscrire")
        * @ParamConverter("session", options={"mapping": {"idSession": "id"}})
        * @ParamConverter("stagiaire", options={"mapping": {"idStagiaire": "id"}})
     */
    public function inscrire(Stagiaire $stagiaire, Session $session, ManagerRegistry $doctrine) {

        $entityManager = $doctrine->getManager();
        $session->addStagiaire($stagiaire);
        $entityManager->persist($session);
        $entityManager->flush();

        return $this->redirectToRoute("show_session", ["id" => $session->getId()]);
    }

    /**
        * @Route("/session/desincrire/{idSession}/stagiaire/{idStagiaire}", name="desincrire")
        * @ParamConverter("session", options={"mapping": {"idSession": "id"}})
        * @ParamConverter("stagiaire", options={"mapping": {"idStagiaire": "id"}})
     */
    public function desinscrireStagiaire(Stagiaire $stagiaire, Session $session, ManagerRegistry $doctrine) {

        $entityManager = $doctrine->getManager();
        $session->removeStagiaire($stagiaire);
        $entityManager->flush();

        return $this->redirectToRoute("show_session", ["id" => $session->getId()]);
    }
}
