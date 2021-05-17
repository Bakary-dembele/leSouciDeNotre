<?php

namespace App\Controller;

use App\Entity\InscriptionPoleVisite;
use App\Entity\PoleVisite;
use App\Entity\User;
use App\Form\PoleVisiteType;
use App\Repository\PoleVisiteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/pole/visite")
 */
class PoleVisiteController extends AbstractController
{
    /**
     * @Route("/", name="pole_visite_index", methods={"GET"})
     */
    public function index(PoleVisiteRepository $poleVisiteRepository): Response
    {
        return $this->render('pole_visite/index.html.twig', [
            'pole_visites' => $poleVisiteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/creer", name="pole_visite_creer", methods={"GET","POST"})
     */
    public function creer(Request $request): Response
    {
        $username = $this->getUser()->getUsername();
        $referent = $this->getDoctrine()->getRepository(User::class)->findOneByPseudoOrEmail($username);

        $poleVisite = new PoleVisite();
        $poleVisite->setReferent($referent);
        $inscriptionVisite = new InscriptionPoleVisite();
        $inscriptionVisite->setDateInscription(new \DateTime());
        $inscriptionVisite->setPoleVisite($poleVisite);
        $inscriptionVisite->setUser($referent);
        $form = $this->createForm(PoleVisiteType::class, $poleVisite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($poleVisite);
            $entityManager->persist($inscriptionVisite);
            $entityManager->flush();

            $this->addFlash('success', 'Le pôle visite a bien été créé');
            return $this->redirectToRoute('pole_visite_index');
        }

        return $this->render('pole_visite/creer.html.twig', [
            'pole_visite' => $poleVisite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/afficher/{id}", name="pole_visite_afficher", methods={"GET"})
     */
    public function afficher(PoleVisite $poleVisite): Response
    {
        return $this->render('pole_visite/afficher.html.twig', [
            'pole_visite' => $poleVisite,
        ]);
    }

    /**
     * @Route("/modifier/{id}/", name="pole_visite_modifier", methods={"GET","POST"})
     */
    public function modifier(Request $request, PoleVisite $poleVisite): Response
    {
        $form = $this->createForm(PoleVisiteType::class, $poleVisite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pole_visite_index');
        }

        $this->addFlash('success', 'Votre modification a bien été ajoutée !');
        return $this->render('pole_visite/modifier.html.twig', [
            'pole_visite' => $poleVisite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/supprimer/{id}", name="pole_visite_supprimer", methods={"POST"})
     */
    public function supprimer(Request $request, PoleVisite $poleVisite): Response
    {
        if ($this->isCsrfTokenValid('delete'.$poleVisite->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($poleVisite);
            $entityManager->flush();
        }

        $this->addFlash('success', 'Le pôle visite a bien été supprimé !');
        return $this->redirectToRoute('pole_visite_index');
    }

    private $date;
    public function __construct()
    {
        $this->date = new \DateTime();
    }

    /**
     * @Route("/inscription/pole/visite/{id}", name="pole_visite_inscription")
     * @param EntityManagerInterface $em
     * @param $id
     * @return Response
     */
    public function inscriptionPoleVisite(EntityManagerInterface $em, $id): Response
    {

        $polevisiteRepository = $this->getDoctrine()->getRepository(PoleVisite::class);
        $polevisite = $polevisiteRepository->find($id);

        $nbInscription = $polevisite->getInscriptionPoleVisites();
        $nbInscriptionMax = $polevisite->getNombreDePlace();
        $dateMaxInscription = $polevisite->getDateCloture();

        $user = $this->getUser();

        if (count($nbInscription) < $nbInscriptionMax and $dateMaxInscription >  $this->date) {
            $inscription = new InscriptionPoleVisite();
            $inscription->setUser($user);
            $inscription->setPoleVisite($polevisite);
            $inscription->setDateInscription($this->date);

            if(count($nbInscription)+1 === $nbInscriptionMax){
                $polevisite->setEtatPolevisite('Cloturee');
                $em->persist($polevisite);
            }

            $em->persist($inscription);
            $em->flush();

            $this->addFlash('success', 'Votre inscription a bien été ajoutée !');
            return $this->redirectToRoute('pole_visite_index');
        }


        if (count($nbInscription) === $nbInscriptionMax) {
            $this->addFlash('warning', 'Le nombre maximum de participant est atteint !');
        }

        if ( $this->date > $dateMaxInscription ) {
            $this->addFlash('danger', 'Vous ne pouvez pas vous inscrire à ce pôle visite, la date limite d\'inscription est dépassée');
        }
        return $this->redirectToRoute('pole_visite_index');

    }


    /**
     * @Route("/desister/pole/visite/{id}", name="pole_visite_desister")
     * @param $id
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function desisterPoleVisite(EntityManagerInterface $em, $id)
    {

        $user = $this->getUser();

        $poleVisiteRepository = $this->getDoctrine()->getRepository(PoleVisite::class);
        $poleVisite = $poleVisiteRepository->find($id);

        $inscriptionPoleVisiteRepository = $em->getRepository(InscriptionPoleVisite::class);
        $inscriptionPoleVisite =  $inscriptionPoleVisiteRepository->findBy(
            ['poleVisite' => $poleVisite->getId(), 'user' => $user->getId()],
            ['poleVisite' => 'ASC']
        );

        $nombreInscriptions = $poleVisite->getInscriptionPoleVisites();
        $nombreInscriptionsMax = $poleVisite->getNombreDePlace();
        $etatPoleVisite = $poleVisite->getEtatPolevisite(); //ou getEtat
        if(count($nombreInscriptions)-1 < $nombreInscriptionsMax && $etatPoleVisite === 'Cloture'){
            $poleVisite->setEtatPolevisite('Ouverte');
            $em->persist($poleVisite);
        }

        $em->remove($inscriptionPoleVisite[0]);
        $em->flush();

        $this->addFlash('success', 'Votre désistement a bien été pris en compte, vous pouvez vous réinscrire à nouveau tant qu\'il y a de la place disponible !');
        return $this->redirectToRoute('pole_visite_index');

    }


}
