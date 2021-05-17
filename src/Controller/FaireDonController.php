<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FaireDonController extends AbstractController
{
    /**
     * @Route("/faire_don", name="faire_don")
     */
    public function index(): Response
    {
        return $this->render('faire_don/index.html.twig', [
            'controller_name' => 'FaireDonController',
        ]);
    }
}
