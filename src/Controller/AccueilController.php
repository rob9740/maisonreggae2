<?php

namespace App\Controller;

use App\Repository\MusiquesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    /**
     * @Route("/accueil", name="app_accueil")
     */
    public function index(MusiquesRepository $musiquesRepository): Response
    {
        $musiques = $musiquesRepository->findAll();

        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
            'musiques' => $musiques,
        ]);
    }
}
