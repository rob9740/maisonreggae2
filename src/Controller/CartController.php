<?php

namespace App\Controller;

use App\Entity\Musiques;
use App\Repository\MusiquesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/panier", name="app_cart")
     */
    public function index(SessionInterface $session, MusiquesRepository $musiquesRepository): Response
    {
        $panier = $session->get('panier', []);

        $panierWithData = [];

        foreach($panier as $id => $quantity) {
            $panierWithData[] = [
                'musiques' => $musiquesRepository->find($id),
                'quantity' => $quantity
            ];
        }

        $total = 0;

        foreach($panierWithData as $item) {
            $totalItem = $item['musiques']->getPrice() * $item['quantiy'];
            $total += $totalItem;
        }

        return $this->render('cart/index.html.twig', [
            'controller_name' => 'CartController',
            'items' => $panierWithData,
            'total' => $total
            
            
        ]);
    }

    /**
     * @Route("/panier/add-{id}", name="app_cart_add")
     */
    public function add($id, SessionInterface $session ){
    
        
        $panier = $session->get('panier', []);

        if(!empty($panier[$id])){
            $panier[$id]++;
        }else {
            $panier[$id] = 1;
        }
        
        
        $session->set('panier', $panier);

        return $this->redirectToRoute(("app_cart_add"));
    }

    /**
     * @Route("/panier/remove-{id}", name="app_cart_remove")
     */
    public function remove($id, SessionInterface $session) {
        $panier = $session->get('panier', []);

        if(!empty($panier[$id])) {
            unset($panier[$id]);
        }

        $session->set('panier', $panier);

        return $this->redirectToRoute("app_cart_add");
    }



    

}
