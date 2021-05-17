<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EngagementController extends AbstractController
{
    /**
     * @Route("/engagement", name="engagement")
     */
    public function index(): Response
    {
        return $this->render('engagement/index.html.twig', [
            'controller_name' => 'EngagementController',
        ]);
    }
}
