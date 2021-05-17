<?php

namespace App\Controller;

use App\Entity\Csm;
use App\Entity\InscriptionCsm;
use App\Entity\User;
use App\Form\CsmType;
use App\Repository\CsmRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/csm")
 */
class CsmController extends AbstractController
{
    /**
     * @Route("/", name="csm_index", methods={"GET"})
     */
    public function index(CsmRepository $csmRepository): Response
    {
        return $this->render('csm/index.html.twig', [
            'csms' => $csmRepository->findAll(),
        ]);
    }

    /**
     * @Route("/creer", name="csm_creer", methods={"GET","POST"})
     */
    public function creer(Request $request): Response
    {
        $username = $this->getUser()->getUsername();
        $referent = $this->getDoctrine()->getRepository(User::class)->findOneByPseudoOrEmail($username);

        $csm = new Csm();
        $csm->setReferent($referent);
        $inscriptionCms = new InscriptionCsm();
        $inscriptionCms->setDateInscription(new \DateTime());
        $inscriptionCms->setCsm($csm);
        $inscriptionCms->setUser($referent);
        $form = $this->createForm(CsmType::class, $csm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($csm);
            $entityManager->persist($inscriptionCms);
            $entityManager->flush();

            $this->addFlash('success', 'Le csm a bien été créé');
            return $this->redirectToRoute('csm_index');
        }

        return $this->render('csm/creer.html.twig', [
            'csm' => $csm,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/afficher/{id}", name="csm_afficher", methods={"GET"})
     */
    public function afficher(Csm $csm): Response
    {
        return $this->render('csm/afficher.html.twig', [
            'csm' => $csm,
        ]);
    }

    /**
     * @Route("/modifier/{id}", name="csm_modifier", methods={"GET","POST"})
     */
    public function modifier(Request $request, Csm $csm): Response
    {
        $form = $this->createForm(CsmType::class, $csm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Votre modification a bien été ajoutée !');
            return $this->redirectToRoute('csm_index');
        }

        return $this->render('csm/modifier.html.twig', [
            'csm' => $csm,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/supprimer/{id}", name="csm_supprimer", methods={"POST"})
     */
    public function supprimer(Request $request, Csm $csm): Response
    {
        if ($this->isCsrfTokenValid('delete'.$csm->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($csm);
            $entityManager->flush();
        }

        $this->addFlash('success', 'Le csm a bien été supprimé !');
        return $this->redirectToRoute('csm_index');
    }

    private $date;
    public function __construct()
    {
        $this->date = new \DateTime();
    }
    /**
     * @Route("/inscription/csm/{id}", name="csm_inscription")
     * @param EntityManagerInterface $em
     * @param $id
     * @return Response
     */
    public function inscriptionCsm(EntityManagerInterface $em, $id): Response
    {

        $csmRepository = $this->getDoctrine()->getRepository(Csm::class);
        $cms = $csmRepository->find($id);

        $nbInscription = $cms->getInscriptionCsms();
        $nbInscriptionMax = $cms->getNombreDePlace();
        $dateMaxInscription = $cms->getDateCloture();

        $user = $this->getUser();

        if (count($nbInscription) < $nbInscriptionMax and $dateMaxInscription >  $this->date) {
            $inscription = new InscriptionCsm();
            $inscription->setUser($user);
            $inscription->setCsm($cms);
            $inscription->setDateInscription($this->date);

            if(count($nbInscription)+1 === $nbInscriptionMax){
                $cms->setEtatCsm('Cloturee');
                $em->persist($cms);
            }

            $em->persist($inscription);
            $em->flush();

            $this->addFlash('success', 'Votre inscription a bien été ajoutée !');
            return $this->redirectToRoute('csm_index');
        }


        if (count($nbInscription) === $nbInscriptionMax) {
            $this->addFlash('warning', 'Le nombre maximum de participant est atteint !');
        }

        if ( $this->date > $dateMaxInscription ) {
            $this->addFlash('danger', 'Vous ne pouvez pas vous inscrire à ce csm, la date limite d\'inscription est dépassée');
        }
        return $this->redirectToRoute('csm_index');

    }


    /**
     * @Route("/desister/csm/{id}", name="csm_desister")
     * @param $id
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function desisterCsm(EntityManagerInterface $em, $id)
    {

        $user = $this->getUser();

        $csmRepository = $this->getDoctrine()->getRepository(Csm::class);
        $csm = $csmRepository->find($id);

        $inscriptionCsmRepository = $em->getRepository(InscriptionCsm::class);
        $inscriptionCsm =  $inscriptionCsmRepository->findBy(
            ['csm' => $csm->getId(), 'user' => $user->getId()],
            ['csm' => 'ASC']
        );

        $nombreInscriptions = $csm->getInscriptionCsms();
        $nombreInscriptionsMax = $csm->getNombreDePlace();
        $etatCsm = $csm->getEtatCsm(); //ou getEtat
        if(count($nombreInscriptions)-1 < $nombreInscriptionsMax && $etatCsm === 'Cloture'){
            $csm->setEtatCsm('Ouverte');
            $em->persist($csm);
        }

        $em->remove($inscriptionCsm[0]);
        $em->flush();

        $this->addFlash('success', 'Votre désistement a bien été pris en compte, vous pouvez vous réinscrire à nouveau tant qu\'il y a de la place disponible !');
        return $this->redirectToRoute('csm_index');

    }

}
