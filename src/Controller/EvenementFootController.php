<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\EvenementFoot;
use App\Form\EvenementFoot1Type;
use App\Repository\EvenementFootRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class EvenementFootController extends AbstractController
{
    /**
     * @Route("/listeEvenement", name="evenement_foot_liste", methods={"GET"})
     * @param EvenementFootRepository $evenementFootRepository
     * @return Response
     */
    public function listeEvenement(EvenementFootRepository $evenementFootRepository): Response
    {
        return $this->render('evenement_foot/index.html.twig', [
            'evenement_foot' => $evenementFootRepository->findAll(),
        ]);
    }

    /**
     * @Route("/creerEnvenementFoot", name="evenement_foot_creer", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function creerEnvenementFoot(Request $request): Response
    {
        $evenementFoot = new EvenementFoot();
        $form = $this->createForm(EvenementFoot1Type::class, $evenementFoot);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($evenementFoot);
            $entityManager->flush();

            $this->addFlash("success", "L'événement foot a bien été créé");
            return $this->redirectToRoute('evenement_foot_liste');

        }

        return $this->render('evenement_foot/creer.html.twig', [
            'evenement_foot' => $evenementFoot,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/evenementAfficher/{id}", name="evenement_foot_afficher", methods={"GET"})
     * @param EvenementFoot $evenementFoot
     * @return Response
     */
    public function afficher(EvenementFoot $evenementFoot): Response
    {

        $evenement = $this->getDoctrine()->getRepository(EvenementFoot::class)->find($id);
        if(empty($evenement)){
            throw $this->createNotFoundException('Cette événement n\'existe pas');
        }

        return $this->render('evenement_foot/afficher.html.twig', [
            'evenement_foot' => $evenementFoot,
        ]);
    }

    /**
     * @Route("/modifier/{id}", name="evenement_foot_modifier", methods={"GET","POST"})
     * @param Request $request
     * @param EvenementFoot $evenementFoot
     * @return Response
     */
    public function modifier(Request $request, EvenementFoot $evenementFoot): Response
    {
        $form = $this->createForm(EvenementFoot1Type::class, $evenementFoot);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();


            $this->addFlash("success", "L'événement foot a bien été modifié");
            return $this->redirectToRoute('evenement_foot_liste');

        }

        return $this->render('evenement_foot/modifier.html.twig', [
            'evenement_foot' => $evenementFoot,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/supprimerFoot/{id}", name="foot_supprimer", methods={"POST"})
     * @param Request $request
     * @param EvenementFoot $evenementFoot
     * @return Response
     */
    public function supprimer(Request $request, EvenementFoot $evenementFoot): Response
    {
        if ($this->isCsrfTokenValid('delete'.$evenementFoot->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($evenementFoot);
            $entityManager->flush();

            $this->addFlash("success", "L'événement foot a bien été supprimé");
            return $this->redirectToRoute('evenement_foot_liste');
        }

    }
}
