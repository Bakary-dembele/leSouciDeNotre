<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrgarnigrammeController extends AbstractController
{
    /**
     * @Route("/orgarnigramme", name="orgarnigramme")
     */
    public function index(): Response
    {
        return $this->render('orgarnigramme/index.html.twig', [
            'controller_name' => 'OrgarnigrammeController',
        ]);
    }
}
