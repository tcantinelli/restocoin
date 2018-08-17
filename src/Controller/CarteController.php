<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Carte;

class CarteController extends Controller
{
    /**
     * @Route("/cartes", name="cartes")
     */
    public function index(){

        //Recup cartes online
        $listeCartes = $this->getDoctrine()->getRepository(Carte::class)->findBy(array('online' => true));


        return $this->render('cartes/index.html.twig', [
            'listeCartes' => $listeCartes,
        ]);
    }
}
