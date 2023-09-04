<?php

namespace App\Controller;

use App\Repository\MusiquesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WackiesController extends AbstractController
{
    /**
     * @Route("/wackies", name="app_wackies")
     */
    public function index(MusiquesRepository $musiquesRepository): Response
    {
        return $this->render('wackies/index.html.twig', [
            'controller_name' => 'WackiesController',
            'label' => 'wackies',
            'musiques' => $musiquesRepository->findBy( ['label' => 'wackies']),
        ]);
    }
}
