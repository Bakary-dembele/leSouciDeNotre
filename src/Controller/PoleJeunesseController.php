<?php

namespace App\Controller;

use App\Entity\InscriptionPoleJeunesse;
use App\Entity\PoleJeunesse;
use App\Entity\User;
use App\Form\PoleJeunesse1Type;
use App\Repository\PoleJeunesseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/pole/jeunesse")
 */
class PoleJeunesseController extends AbstractController
{
    /**
     * @Route("/", name="pole_jeunesse_liste", methods={"GET"})
     */
    public function liste(PoleJeunesseRepository $poleJeunesseRepository): Response
    {
        return $this->render('pole_jeunesse/index.html.twig', [
            'pole_jeunesses' => $poleJeunesseRepository->findAll(),
        ]);
    }

    /**
     * @Route("/creer", name="pole_jeunesse_creer", methods={"GET","POST"})
     */
    public function creer(Request $request): Response
    {
        $username = $this->getUser()->getUsername();
        $referent = $this->getDoctrine()->getRepository(User::class)->findOneByPseudoOrEmail($username);

        $poleJeunesse = new PoleJeunesse();
        $poleJeunesse->setReferent($referent);
        $inscriptionJeunesse = new InscriptionPoleJeunesse();
        $inscriptionJeunesse->setDateInscription(new \DateTime());
        $inscriptionJeunesse->setPoleJeunesse($poleJeunesse);
        $inscriptionJeunesse->setUser($referent);
        $form = $this->createForm(PoleJeunesse1Type::class, $poleJeunesse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($poleJeunesse);
            $entityManager->persist($inscriptionJeunesse);
            $entityManager->flush();

            $this->addFlash('success', 'Le pôle jeunesse a bien été créé');
            return $this->redirectToRoute('pole_jeunesse_liste');
        }

        return $this->render('pole_jeunesse/creer.html.twig', [
            'pole_jeunesse' => $poleJeunesse,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pole_jeunesse_afficher", methods={"GET"})
     */
    public function afficher(PoleJeunesse $poleJeunesse): Response
    {
        return $this->render('pole_jeunesse/afficher.html.twig', [
            'pole_jeunesse' => $poleJeunesse,
        ]);
    }

    /**
     * @Route("/{id}/modifier", name="pole_jeunesse_modifier", methods={"GET","POST"})
     */
    public function modifier(Request $request, PoleJeunesse $poleJeunesse): Response
    {
        $form = $this->createForm(PoleJeunesse1Type::class, $poleJeunesse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Votre modification a bien été ajoutée !');
            return $this->redirectToRoute('pole_jeunesse_liste');
        }

        return $this->render('pole_jeunesse/modifier.html.twig', [
            'pole_jeunesse' => $poleJeunesse,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pole_jeunesse_supprimer", methods={"POST"})
     */
    public function supprimer(Request $request, PoleJeunesse $poleJeunesse): Response
    {
        if ($this->isCsrfTokenValid('delete'.$poleJeunesse->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($poleJeunesse);
            $entityManager->flush();
        }

        $this->addFlash('success', 'Le pôle a bien été supprimé !');
        return $this->redirectToRoute('pole_jeunesse_liste');
    }


    private $date;
    public function __construct()
    {
        $this->date = new \DateTime();
    }

    /**
     * @Route("/inscription/pole/{id}", name="pole_jeunesse_inscription")
     * @param EntityManagerInterface $em
     * @param $id
     * @return Response
     */
    public function inscription(EntityManagerInterface $em, $id): Response
    {

        $poleJeunesseRepository = $this->getDoctrine()->getRepository(PoleJeunesse::class);
        $poleJeunesse = $poleJeunesseRepository->find($id);

        $nbInscription =  $poleJeunesse->getInscriptionPoleJeunesses();
        $nbInscriptionMax = $poleJeunesse->getNombreDePlace();
        $dateMaxInscription =  $poleJeunesse->getDateCloture();

        $user = $this->getUser();

        if (count($nbInscription) < $nbInscriptionMax and $dateMaxInscription >  $this->date) {
            $inscription = new InscriptionPoleJeunesse();
            $inscription->setUser($user);
            $inscription->setPoleJeunesse($poleJeunesse);
            $inscription->setDateInscription($this->date);

            if(count($nbInscription)+1 === $nbInscriptionMax){
                $poleJeunesse->setEtatPoleJeunesse('Cloturee');
                $em->persist( $poleJeunesse);
            }

            $em->persist($inscription);
            $em->flush();

            $this->addFlash('success', 'Votre inscription a bien été ajoutée !');
            return $this->redirectToRoute('pole_jeunesse_liste');
        }


        if (count($nbInscription) === $nbInscriptionMax) {
            $this->addFlash('warning', 'Le nombre maximum de participant est atteint !');
        }

        if ( $this->date > $dateMaxInscription ) {
            $this->addFlash('danger', 'Vous ne pouvez pas vous inscrire à ce pôle, la date limite d\'inscription est dépassée');
        }
        return $this->redirectToRoute('pole_jeunesse_liste');

    }


    /**
     * @Route("desiste/pole/{id}", name="pole_jeunesse_desister")
     * @param $id
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function desisterPoleJeunesse(EntityManagerInterface $em, $id)
    {

        $user = $this->getUser();

        $poleJeunesseRepository = $this->getDoctrine()->getRepository(PoleJeunesse::class);
        $poleJeunesse = $poleJeunesseRepository->find($id);

        $inscriptionPoleJeunnesRepository = $em->getRepository(InscriptionPoleJeunesse::class);
        $inscriptionPoleJeunesse =  $inscriptionPoleJeunnesRepository->findBy(
            ['poleJeunesse' => $poleJeunesse->getId(), 'user' => $user->getId()],
            ['poleJeunesse' => 'ASC']
        );

        $nombreInscriptions = $poleJeunesse->getInscriptionPoleJeunesses();
        $nombreInscriptionsMax = $poleJeunesse->getNombreDePlace();
        $etatPoleJeunesse = $poleJeunesse->getEtatPoleJeunesse(); //ou getEtat
        if(count($nombreInscriptions)-1 < $nombreInscriptionsMax && $etatPoleJeunesse === 'Cloture'){
            $poleJeunesse->setEtatPoleJeunesse('Ouverte');
            $em->persist($poleJeunesse);
        }

        $em->remove($inscriptionPoleJeunesse[0]);
        $em->flush();

        $this->addFlash('success', 'Votre désistement a bien été pris en compte, vous pouvez vous réinscrire à nouveau tant qu\'il y a de la place disponible !');
        return $this->redirectToRoute('pole_jeunesse_liste');

    }

}
