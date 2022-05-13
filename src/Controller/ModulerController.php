<?php

namespace App\Controller;

use App\Entity\Moduler;
use App\Form\ModulerType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ModulerController extends AbstractController
{
     /**
     * @Route("/moduler", name="index_moduler")
     */
    public function indexmoduler(ManagerRegistry $doctrine): Response
    {
        $moduler = $doctrine->getRepository(Moduler::class)->findAll();
        
        return $this->render('moduler/index.html.twig', [
            'moduler' => $moduler,
        ]);

    }

     /**
     * @Route("/moduler/add", name="add_moduler")
     *  @Route("/moduler/update/{id}", name="update_moduler")
     */
    public function add(ManagerRegistry $doctrine, Moduler $moduler = null, Request $request): Response
    {

        if(!$moduler) {
            $moduler = new Moduler();
        }

        $entityManager = $doctrine->getManager();
        $form = $this->createForm(ModulerType::class, $moduler);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            
            $moduler = $form->getData();
            $entityManager->persist($moduler);
            $entityManager->flush();
            
            return $this->redirectToRoute('index_moduler');
        }
        return $this->render('moduler/add.html.twig', [
            'formModuler' => $form->createView(),
        ]);
    }

      /**
     * @Route("/moduler/delete/{id}", name="delete_moduler")
     */
    public function delete(ManagerRegistry $doctrine, Moduler $moduler)
    {
        $entityManager = $doctrine->getManager();
        $entityManager->remove($moduler);
        $entityManager->flush();

        return $this->redirectToRoute("index_moduler");
    }

}