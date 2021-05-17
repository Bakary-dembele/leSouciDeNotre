<?php

namespace App\Controller;

use App\Entity\EvenementFoot;
use App\Form\InscriptionEvenementFootType;
use App\Repository\InscriptionEvenementFootRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InscriptionEvenementFootController extends AbstractController
{
    /**
     * @Route("/inscriptionFoot", name="inscription_foot")
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     * @return Response
     */
    public function inscriptionEnvenementFoot(EntityManagerInterface $entityManager, Request $request): Response
    {

        
        $formInscriptionFoot = $this->createForm(InscriptionEvenementFootType::class);
        $formInscriptionFoot->handleRequest($request);

        if ($formInscriptionFoot->isSubmitted() && $formInscriptionFoot->isValid()) {

            $participant = $formInscriptionFoot->getData();
            $entityManager->persist($participant);
            $entityManager->flush();

            $this->addFlash('success', 'Bravo ! Vous êtes bien inscrit.');
            return $this->redirectToRoute('main_evenement');

        }

        return $this->render('inscription_evenement_foot/index.html.twig', [
            'controller_name' => 'InscriptionEvenementFootController',
            'formInscriptionFoot' => $formInscriptionFoot->createView(),
        ]);
    }


    /**
     * @Route("inscriptionListe", name="inscription_liste", methods={"GET", "POST"})
     */
    public function listEnvenementFoot(InscriptionEvenementFootRepository $inscriptionEvenementFootRepository, Request $request, EntityManagerInterface $entityManager): Response
    {

        return $this->render('inscription_evenement_foot/afficher_evenement_foot.html.twig', [
            'inscription' => $inscriptionEvenementFootRepository->findAll(),
        ]);

    }

}
