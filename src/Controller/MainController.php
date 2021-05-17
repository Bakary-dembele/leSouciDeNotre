<?php

namespace App\Controller;

use App\Form\NewsLetterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     * @return Response
     */
    public function home(EntityManagerInterface $entityManager, Request $request): Response
    {

        return $this->render('main/home.html.twig', [
            'controller_name' => 'MainController',

        ]);
    }
}
