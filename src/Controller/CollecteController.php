<?php

namespace App\Controller;

use App\Entity\Collecte;
use App\Entity\InscriptionCollecte;
use App\Entity\User;
use App\Form\CollecteType;
use App\Repository\CollecteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class CollecteController extends AbstractController
{
    /**
     * @Route("/afficherListeCollecte", name="collecte_liste", methods={"GET"})
     */
    public function afficherListeCollecte(CollecteRepository $collecteRepository): Response
    {
        return $this->render('collecte/index.html.twig', [
            'collectes' => $collecteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/creer", name="collecte_creer", methods={"GET","POST"})
     */
    public function creerCollecte(Request $request): Response
    {
        $username = $this->getUser()->getUsername();
        $referent = $this->getDoctrine()->getRepository(User::class)->findOneByPseudoOrEmail($username);

        $collecte = new Collecte();
        $collecte->setReferent($referent);
        $inscription = new InscriptionCollecte();
        $inscription->setDateInscription(new \DateTime());
        $inscription->setCollecte($collecte);
        $inscription->setUser($referent);
        $form = $this->createForm(CollecteType::class, $collecte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($collecte);
            $entityManager->persist($inscription);
            $entityManager->flush();

            $this->addFlash('success', 'La collecte a bien été créé');
            return $this->redirectToRoute('collecte_liste');
        }

        return $this->render('collecte/creer_collecte.html.twig', [
            'collecte' => $collecte,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("afficher/{id}", name="collecte_afficher", methods={"GET"})
     */
    public function afficherCollecte(Collecte $collecte): Response
    {
        return $this->render('collecte/afficher_collecte.html.twig', [
            'collecte' => $collecte,
        ]);
    }

    /**
     * @Route("modifier/{id}/modifier", name="collecte_modifier", methods={"GET","POST"})
     */
    public function modifierCollecte(Request $request, Collecte $collecte): Response
    {
        $form = $this->createForm(CollecteType::class, $collecte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Votre modification a bien été ajoutée !');
            return $this->redirectToRoute('collecte_liste');
        }

        return $this->render('collecte/modifier_collecte.html.twig', [
            'collecte' => $collecte,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("supprimer/{id}", name="collecte_supprimer")
     */
    public function supprimer(Request $request, Collecte $collecte): Response
    {
        if ($this->isCsrfTokenValid('delete'.$collecte->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($collecte);
            $entityManager->flush();
        }

        $this->addFlash('success', 'La collecte a bien été supprimée !');
        return $this->redirectToRoute('collecte_liste');
    }



    private $date;
    public function __construct()
    {
        $this->date = new \DateTime();
    }

    /**
     * @Route("inscriptionCollecte/{id}", name="collecte_inscription")
     * @param EntityManagerInterface $em
     * @param $id
     * @return Response
     */
    public function inscription(EntityManagerInterface $em, $id): Response
    {

        $collecteRepository = $this->getDoctrine()->getRepository(Collecte::class);
        $collecte = $collecteRepository->find($id);

        $nbInscription = $collecte->getInscriptionCollectes();
        $nbInscriptionMax = $collecte->getNombreDePlace();
        $dateMaxInscription = $collecte->getDateCloture();

        $user = $this->getUser();

        if (count($nbInscription) < $nbInscriptionMax and $dateMaxInscription >  $this->date) {
            $inscription = new InscriptionCollecte();
            $inscription->setUser($user);
            $inscription->setCollecte($collecte);
            $inscription->setDateInscription($this->date);

            if(count($nbInscription)+1 === $nbInscriptionMax){
                $collecte->setEtatCollecte('Cloturee');
                $em->persist($collecte);
            }

            $em->persist($inscription);
            $em->flush();

            $this->addFlash('success', 'Votre inscription a bien été ajoutée !');
            return $this->redirectToRoute('collecte_liste');
        }


        if (count($nbInscription) === $nbInscriptionMax) {
            $this->addFlash('warning', 'Le nombre maximum de participant est atteint !');
        }

        if ( $this->date > $dateMaxInscription ) {
            $this->addFlash('danger', 'Vous ne pouvez pas vous inscrire à cette collecte, la date limite d\'inscription est dépassée');
        }
        return $this->redirectToRoute('collecte_liste');

    }


    /**
     * @Route("desisterCollecte/{id}", name="collecte_desister")
     * @param $id
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function desisterCollecte(EntityManagerInterface $em, $id)
    {

        $user = $this->getUser();

        $collecteRepository = $this->getDoctrine()->getRepository(Collecte::class);
        $collecte = $collecteRepository->find($id);

        $inscriptionCollecteRepository = $em->getRepository(InscriptionCollecte::class);
        $inscriptionCollecte =  $inscriptionCollecteRepository->findBy(
            ['collecte' => $collecte->getId(), 'user' => $user->getId()],
            ['collecte' => 'ASC']
        );

        $nombreInscriptions = $collecte->getInscriptionCollectes();
        $nombreInscriptionsMax = $collecte->getNombreDePlace();
        $etatCollecte = $collecte->getEtatCollecte(); //ou getEtat
        if(count($nombreInscriptions)-1 < $nombreInscriptionsMax && $etatCollecte === 'Cloture'){
            $collecte->setEtatCollecte('Ouverte');
            $em->persist($collecte);
        }

        $em->remove($inscriptionCollecte[0]);
        $em->flush();

        $this->addFlash('success', 'Votre annulation a bien été prise en compte !');
        return $this->redirectToRoute('collecte_liste');

    }






}
