<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ActionController extends AbstractController
{
    /**
     * @Route("/action", name="action")
     */
    public function index(): Response
    {
        return $this->render('action/index.html.twig', [
            'controller_name' => 'ActionController',
        ]);
    }
}
