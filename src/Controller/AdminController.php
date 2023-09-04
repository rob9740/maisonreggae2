<?php

namespace App\Controller;

use App\Entity\Musiques;
use App\Repository\MusiquesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="app_admin")
     */
    public function index(MusiquesRepository $musiquesRepository): Response
    {
        $musiques = $musiquesRepository->findAll();
        
        return $this->render('admin/adminAccueil.html.twig', [
            'controller_name' => 'AdminController',
            'musiques' => $musiques,
        ]);
    }

    

    
}
