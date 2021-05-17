<?php

namespace App\Controller;

use App\Repository\EvenementFootRepository;
use App\Repository\EvenementMainRepository;
use App\Repository\EvenementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class MainEvenementController extends AbstractController
{
    /**
     * @Route("/mainEvenement", name="main_evenement", methods={"GET", "POST"})
     * @param EvenementRepository $evenementRepository
     * @param EvenementFootRepository $evenementFootRepository
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function listEnvenement(EvenementMainRepository $evenementMainRepository, EvenementFootRepository $evenementFootRepository, Request $request, EntityManagerInterface $entityManager): Response
    {

        return $this->render('main_evenement/index.html.twig', [
            'evenements' => $evenementMainRepository->findAll(),
            'evenementFoots' => $evenementFootRepository->findAll(),
        ]);

    }

}
