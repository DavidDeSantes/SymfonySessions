<?php

namespace App\Controller;

use App\Entity\Cours;
use App\Form\CoursType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CoursController extends AbstractController
{
     /**
     * @Route("/cours", name="index_cours")
     */
    public function indexCours(ManagerRegistry $doctrine): Response
    {
        $cours = $doctrine->getRepository(Cours::class)->findAll();
        
        return $this->render('cours/index.html.twig', [
            'cours' => $cours,
        ]);
    }

     /**
     * @Route("/cours/add", name="add_cours")
     */
    public function add(ManagerRegistry $doctrine, Cours $cours = null, Request $request): Response
    {
        $entityManager = $doctrine->getManager();
        $form = $this->createForm(CoursType::class, $cours);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            
            $cours = $form->getData();
            $entityManager->persist($cours);
            $entityManager->flush();
            
            return $this->redirectToRoute('show_categorie');
        }
        return $this->render('cours/add.html.twig', [
            'formCours' => $form->createView(),
            'cours' => $cours
        ]);
    }
}