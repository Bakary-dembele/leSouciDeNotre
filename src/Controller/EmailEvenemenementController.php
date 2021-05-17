<?php

namespace App\Controller;

use App\Entity\Inscrire;
use App\Form\InscriptionEvenementFootType;
use App\Form\InscrireType;
use App\Repository\InscrireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EmailEvenemenementController extends AbstractController
{
    /**
     * @Route("/emailEvenemenement", name="email_evenemenement")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function inscrptionEnvennement(Request $request, EntityManagerInterface $entityManager): Response
    {

        $inscrireForm = $this->createForm(InscrireType::class);
        $inscrireForm->handleRequest($request);

        if ($inscrireForm->isSubmitted() && $inscrireForm->isValid()) {

            $participant = $inscrireForm->getData();
            $entityManager->persist($participant);
            $entityManager->flush();

            $this->addFlash('success', 'Bravo ! Vous êtes bien inscrit.');
            return $this->redirectToRoute('main_evenement');

        }

        return $this->render('email_evenemenement/index.html.twig', [
            'controller_name' => 'EmailEvenemenementController',
            'inscrireForm' => $inscrireForm->createView(),
        ]);
    }


    /**
     * @Route("inscriptionListeEvenement", name="inscription_liste_envenement", methods={"GET", "POST"})
     */
    public function listsEnvenement(InscrireRepository $inscrireRepository, Request $request, EntityManagerInterface $entityManager): Response
    {

        return $this->render('email_evenemenement/afficher_liste_evenement.html.twig', [
            'inscriptionEvenement' => $inscrireRepository->findAll(),
        ]);

    }
}
