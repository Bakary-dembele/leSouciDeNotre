<?php

namespace App\Controller;

use App\Entity\Dom;
use App\Form\PaiementType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PaiementController extends AbstractController
{
    /**
     * @Route("/paiement", name="paiement")
     */
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {

        if(isset($_POST['prix']) && !empty($_POST['prix'])){
            // Nous appelons l'autoloader pour avoir accès à Stripe
            //require_once('vendor/autoload.php');
            $prix = (float)$_POST['prix'];
            // Nous instancions Stripe en indiquand la clé privée, pour prouver que nous sommes bien à l'origine de cette demande
            \Stripe\Stripe::setApiKey('sk_test_51Ia6JUICxn8FLP2ZGHPW5thFDSFaLSJT3dyzbY3uUsMiFDoyhMRQftnioIsj8txh1xuOuScSFQxTT0y4zkc3qG1K00vqUExfXF');

            // Nous créons l'intention de paiement et stockons la réponse dans la variable $intent
            $intent = \Stripe\PaymentIntent::create([
                'amount' => $prix*100, // Le prix doit être transmis en centimes
                'currency' => 'eur',
            ]);

        }

        return $this->render('paiement/index.html.twig', [
            'controller_name' => 'PaiementController',
        ]);
    }
}
