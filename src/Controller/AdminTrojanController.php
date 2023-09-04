<?php

namespace App\Controller;

use id;
use App\Entity\Musiques;
use App\Form\MusiqueType;
use App\Repository\MusiquesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminTrojanController extends AbstractController
{
    /**
     * @Route("/admin/trojan", name="app_admin_trojan")
     */
    public function index(MusiquesRepository $musiquesRepository): Response
    {
        $musiques = $musiquesRepository->findAll();

        return $this->render('admin/adminTrojan.html.twig', [
            'controller_name' => 'AdminTrojanController',
            'musiques' => $musiques,
        ]);
    }

    /**
     * @Route("/admin/trojan/create", name="app_trojan_create")
     */
    public function createMusique(Request $request, EntityManagerInterface $manager)
    {
        $musiques = new Musiques();

        $form = $this->createForm(MusiqueType::class, $musiques);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            
            $manager->persist($musiques);
            $manager->flush();

            $this->addFlash(
                'success',
                'Album a bien été ajouté'
            );
        
            return $this->redirectToRoute('app_admin_trojan');


        }

        return $this->render('admin/formTrojan.html.twig', [
            'formulaire' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/trojan/delete-{id}", name="app_trojan_delete")
     */
    public function deleteMusique(MusiquesRepository $musiquesRepository, $id, EntityManagerInterface $manager)
    {
        $musiques = $musiquesRepository->find($id);

        $manager->remove($musiques);
        $manager->flush();

        $this->addFlash(
            'danger',
            'Album a bien été supprimé'
        );

        return $this->redirectToRoute('app_admin_trojan');
    }
    
    /**
     * @Route("/admin/trojan/update-{id}", name="app_trojan_update")
     */
    public function updateMusique(MusiquesRepository $musiquesRepository, Request $request, EntityManagerInterface $manager, $id)
    {
        $musiques = $musiquesRepository->find($id);

        $form = $this->createForm(MusiqueType::class, $musiques);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($musiques);
            $manager->flush();

            $this->addFlash(
                'warning',
                'Album a bien été modifié'
            );

            return $this->redirectToRoute('app_admin_trojan');
        }

        return $this->render('admin/formTrojan.html.twig', [
            'formulaire' => $form->createView()
        ]);
    }
}
