<?php

namespace App\Controller;

use App\Form\NewsLetterType;
use App\Repository\NewsLetterRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewsLetterController extends AbstractController
{
    /**
     * @Route("/news", name="mews_letter")
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     * @return Response
     */
    public function newsLetter(EntityManagerInterface $entityManager, Request $request): Response
    {
        $formNew = $this->createForm(NewsLetterType::class);
        $formNew->handleRequest($request);

        if ($formNew->isSubmitted() && $formNew->isValid()){

            $inscritNews = $formNew->getData();
            $entityManager->persist($inscritNews);
            $entityManager->flush();

            $this->addFlash('success', 'Bravo ! Vous êtes bien abonnez au newsletter');
            return $this->redirectToRoute('home');
        }

        return $this->render('news_letter/index.html.twig', [
            'controller_name' => 'NewsLetterController',
            'formNew' => $formNew->createView(),
        ]);
    }

    /**
     * @Route("/news_afficher", name="mews_afficher")
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     * @return Response
     */
    public function afficherNewsLetter(NewsLetterRepository $newsLetterRepository): Response
    {
         return $this->render('news_letter/afficher.html.twig', [
             'inscriptionNews' => $newsLetterRepository->findAll(),
         ]);
    }
}
