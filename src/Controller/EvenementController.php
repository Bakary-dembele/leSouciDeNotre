<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\EvenementFoot;
use App\Form\EvenementFootType;
use App\Form\EvenementType;
use App\Repository\EvenementFootRepository;
use App\Repository\EvenementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class EvenementController extends AbstractController
{
    /**
     * @Route("evenementListe", name="evenement_liste", methods={"GET", "POST"})
     * @param EvenementRepository $evenementRepository
     * @param EvenementFootRepository $evenementFootRepository
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function listEnvenement(EvenementRepository $evenementRepository, EvenementFootRepository $evenementFootRepository, Request $request, EntityManagerInterface $entityManager): Response
    {

        return $this->render('evenement/liste_evenement.index.html.twig', [
            'evenements' => $evenementRepository->findAll(),
            'evenementFoots' => $evenementFootRepository->findAll(),
        ]);

    }

    /**
     * @Route("creationEvenement", name="evenement_creation", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function creationEvenement(Request $request): Response
    {
        $evenement = new Evenement();
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($evenement);
            $entityManager->flush();

            $this->addFlash("success", "L'événement brunch a bien été créé");
            return $this->redirectToRoute('evenement_liste');
        }


        return $this->render('evenement/creation_evenement.html.twig', [
            'evenement' => $evenement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("AfficherEvenement{id}", name="evenement_afficher")
     * @param Evenement $evenement
     * @param $id
     * @return Response
     */
    public function afficher(Evenement $evenement, $id): Response
    {
        $evenement = $this->getDoctrine()->getRepository(Evenement::class)->find($id);
        if(empty($evenement)){
            throw $this->createNotFoundException('Cette événement n\'existe pas');
        }


        return $this->render('evenement/afficher_evenement.html.twig', [
            'evenement' => $evenement,
        ]);

    }

    /**
     * @Route("modifierEvenement/{id}", name="evenement_modifier", methods={"GET","POST"})
     * @param Request $request
     * @param Evenement $evenement
     * @return Response
     */
    public function modifier(Request $request, evenement $evenement): Response
    {

        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash("success", "L'événement brunch a bien été modifié");
            return $this->redirectToRoute('evenement_liste');
        }

        return $this->render('evenement/modifier_evenement.html.twig', [
            'evenement' => $evenement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("supprimerEvenement/{id}", name="evenement_supprimer")
     * @param Request $request
     * @param Evenement $evenement
     * @return Response
     */
    public function supprimer(Request $request, Evenement $evenement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$evenement->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($evenement);
            $entityManager->flush();

            $this->addFlash("success", "L'événement brunch a bien été supprimé");
            return $this->redirectToRoute('evenement_liste');
        }

    }

}
