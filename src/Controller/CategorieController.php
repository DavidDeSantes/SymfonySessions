<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Form\CategorieType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategorieController extends AbstractController
{
    /**
     * @Route("/categorie", name="index_categorie")
     */
    public function indexCatagorie(ManagerRegistry $doctrine): Response
    {
        $categories = $doctrine->getRepository(Categorie::class)->findAll();
        
        return $this->render('categorie/index.html.twig', [
            'categories' => $categories,
        ]);
    }

     /**
     * @Route("/categorie/add", name="add_categorie")
     * @Route("/categorie/update/{id}", name="update_categorie")
     * 
     */
    public function add(ManagerRegistry $doctrine, Categorie $categorie = null, Request $request): Response
    {

        if(!$categorie) {
            $categorie = new Categorie();
        }

        // Le getManager va nous permettre de pouvoir manipuler (update, delete)
        $entityManager = $doctrine->getManager();
        //On créé bien le form avec la methode createForm, en le reliant à notre make form CategorieType et 
        // en créant l'objet $categorie
        $form = $this->createForm(CategorieType::class, $categorie);
        // On demande d'analyser la requête, pour savoir si le form est bien conçu 
        $form->handleRequest($request);

        // Avec le isSubmitted et le isValid on sécurise le form pour voir s'il n'y a pas d'injection malveillante
        // comme avec les filters sanitize dans PDO
        if($form->isSubmitted() && $form->isValid()) {
            //Si c'est bon on va récupérer les données du form et le mettre dans notre nouvelle catégorie
            // c'est ce qu'on appelle l'hydratation
            $categorie = $form->getData();
            $entityManager->persist($categorie);
            $entityManager->flush();
            
            return $this->redirectToRoute('index_categorie');
        }
        return $this->render('categorie/add.html.twig', [
            'formCategorie' => $form->createView()
        ]);
    }

    /**
     * @Route("/categorie/delete/{id}", name="delete_categorie")
     */
    public function delete(ManagerRegistry $doctrine, Categorie $categorie)
    {
        $entityManager = $doctrine->getManager();
        $entityManager->remove($categorie);
        $entityManager->flush();

        return $this->redirectToRoute("index_categorie");
    }

     /**
     * @Route("/categorie/{id}", name="show_categorie")
     */
    public function show(Categorie $categorie): Response
    {
        return $this->render('categorie/show.html.twig', [
            'categorie' => $categorie,
        ]);
    }
}
