<?php

namespace App\Controller;

use App\Entity\Etat;
use App\Entity\Inscription;
use App\Entity\Lieu;
use App\Entity\MaraudeSearchData;
use App\Entity\User;
use App\Entity\Maraude;
use App\Entity\Ville;
use App\Form\AnnulationMaraudeType;
use App\Form\CreationMaraudeType;
use App\Form\MaraudeFilterType;
use App\Form\ModifMaraudeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MaraudeController extends AbstractController
{
    /**
     * @Route("/creationMaraude", name="maraude_creation")
     * @param EntityManagerInterface $em
     * @param Request $request
     * @return Response
     */
        public function creationMaraude(EntityManagerInterface $em, Request $request): Response
    {
        $username = $this->getUser()->getUsername();
        $organisateur = $this->getDoctrine()->getRepository(User::class)->findOneByPseudoOrEmail($username);

        $maraude = new Maraude();
        $maraude->setOrganisateur($organisateur);
        $maraude->setGroupe($organisateur->getGroupe());
        $inscription = new Inscription();
        $inscription->setDateInscription(new \DateTime());
        $inscription->setMaraude($maraude);
        $inscription->setUser($organisateur);
        $etat = $this->getDoctrine()->getRepository(Etat::class)->findOneBy(['libelle'=>'Créée']);
        $maraude->setEtat($etat);
        $maraudeForm = $this->createForm(CreationMaraudeType::class,  $maraude);
        $maraudeForm->handleRequest($request);
        if( $maraudeForm->isSubmitted() &&  $maraudeForm->isValid()){

            $em->persist( $maraude);
            $em->persist($inscription);
            $em->flush();

            $this->addFlash('success', 'La maraude a bien été créée');
            return $this->redirectToRoute('maraude_planning');
        }


        return $this->render('maraude/creation_maraude.html.twig', [
            'controller_name' => 'MaraudeController',
            'maraudeForm' =>  $maraudeForm->createView(),
        ]);
    }


            /**
     * @Route("annulationMaraude/{id}", name="maraude_annulation")
     * @param EntityManagerInterface $em
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function annulationMaraude(EntityManagerInterface $em, Request $request, $id): Response
    {
        $maraunde = $this->getDoctrine()->getRepository(Maraude::class)->find($id);
        if(empty($maraunde)){
            throw $this->createNotFoundException('Cette maraude n\'existe pas');
        }

        $annulationForm = $this->createForm(AnnulationMaraudeType::class, $maraunde);
        $annulationForm->handleRequest($request);
        /*$dateNow = new \DateTime();
        if($maraude->getDateCloture() > $dateNow){*/
            if($annulationForm->isSubmitted() && $annulationForm->isValid()){
                $etat = $this->getDoctrine()->getRepository(Etat::class)
                    ->findOneBy(['libelle'=> 'Annulée']);
                $maraunde->setEtat($etat);
                $em->persist($maraunde);
                $em->flush();

                $this->addFlash('success', 'La maraude a bien été annulée');
                return $this->redirectToRoute('maraude_planning');
            }
        /*} else {
            $this->createNotFoundException('Il est trop tard pour annuler cette maraude..!');
        }*/
        return $this->render('maraude/annulation_maraude.html.twig', [
            'controller_name' => 'MaraudeController',
            'maraude' => $maraunde,
            'annulationForm' => $annulationForm->createView(),
            ]);
    }

    /**
     * @Route("modifMaraude/{id}", name="maraude_modif")
     * @param EntityManagerInterface $em
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function modifMaraude(EntityManagerInterface $em, Request $request, $id): Response
    {

        $maraude = $this->getDoctrine()->getRepository(Maraude::class)->find($id);
        if(empty($maraude)){
            throw $this->createNotFoundException('Cette maraude n\'existe pas');
        }
        $modifForm = $this->createForm(ModifMaraudeType::class, $maraude);
        $modifForm->handleRequest($request);
        if($modifForm->isSubmitted() && $modifForm->isValid()){
            $etat = $this->getDoctrine()->getRepository(Etat::class)->findOneBy(['libelle'=>'Créée']);
            $maraude->setEtat($etat);
            $em->persist($maraude);
            $em->flush();

            $this->addFlash('success', 'La maraude a bien été modifiée');
            return $this->redirectToRoute('maraude_planning');
        }
        return $this->render('maraude/modif_maraude.html.twig', [
            'controller_name' => 'MaraudeController',
            'maraude' => $maraude,
            'modifForm' => $modifForm->createView(),
        ]);
    }

    /**
     * @Route("suppressionMaraude/{id}",name="maraude_suppression", methods={"DELETE"})
     * @param EntityManagerInterface $em
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function suppressionMaraude(EntityManagerInterface $em, Request $request, $id):Response
    {
        $maraude = $this->getDoctrine()->getRepository(Maraude::class)->find($id);
        if(empty($maraude)){
            throw$this->createNotFoundException('Cette maraude n\'existe pas');
        }
       if($this->isCsrfTokenValid('delete'.$maraude->getId(), $request->request->get('_token'))){
           $em->remove($maraude);
           $em->flush();
       }

        $this->addFlash('success','La maraude a bien été supprimée');
        return $this->redirectToRoute('maraude_planning');
    }

    /**
     * @Route("publierMaraude/{id}", name="maraude_publier")
     * @param EntityManagerInterface $em
     * @param $id
     * @return Response
     */
    public function publierMaraude(EntityManagerInterface $em, $id): Response
    {
        $maraude = $this->getDoctrine()->getRepository(Maraude::class)->find($id);
        if(empty($maraude)){
            throw$this->createNotFoundException('Cette maraude n\'existe pas');
        }

        $etat = $this->getDoctrine()->getRepository(Etat::class)->findOneBy(['libelle'=>'Ouverte']);
        $maraude->setEtat($etat);
        $em->persist($maraude);
        $em->flush();

        $this->addFlash('success','La maraude a bien été publiée');
        return $this->redirectToRoute('maraude_planning');
    }

    /**
     * @Route("afficherMaraude/{id}", name="maraude_afficher")
     * @param $id
     * @return Response
     */
    public function afficherMaraude($id): Response
    {
        $maraude=$this->getDoctrine()->getRepository(Maraude::class)->find($id);
        if(empty($maraude)){
            throw$this->createNotFoundException('Cette maraude n\'existe pas');
        }

        return $this->render('maraude/afficher_maraude.html.twig', [
            'controller_name' => 'MaraudeController',
            'maraude' => $maraude,
        ]);
    }

    /**
     * @Route("listeLieuxParVille", name="maraude_liste_lieux")
     */
    public function listeLieuxParVille(Request $request): JsonResponse
    {
        $em = $this->getDoctrine()->getManager();
        $lieuxRepo = $em->getRepository(Lieu::class);

        $villeId = $request->query->get('villeId');
        $ville = $em->getRepository(Ville::class)->find($villeId);
        $cdp = $ville->getCodePostal();

        $lieux = $lieuxRepo->findLieuByVille($villeId);

        $responseArray = array();
        foreach ($lieux as $lieu){
            $responseArray[] = array(
                "id" => $lieu->getId(),
                "name" => $lieu->getNomLieu(),
                "rue" => $lieu->getRue(),
                "latitude" => $lieu->getLatitude(),
                "longitude" => $lieu->getLongitude(),
                "cdp" => $cdp,
            );
        }
        return new JsonResponse($responseArray);
    }

    /**
     * @Route("lieuDetails", name="maraude_lieu_details")
     */
    public function lieuDetails(Request $request): JsonResponse
    {
        $em = $this->getDoctrine()->getManager();
        $lieuRepo = $em->getRepository(Lieu::class);
        $lieuId = $request->query->get('lieuId');
        $lieu = $lieuRepo->find($lieuId);

        $retourArray = array();

        $retourArray[] = array(
            "id" => $lieu->getId(),
            "name" => $lieu->getNomLieu(),
            "rue" => $lieu->getRue(),
            "latitude" => $lieu->getLatitude(),
            "longitude" => $lieu->getLongitude(),
        );

        return new JsonResponse($retourArray);
    }



    private $date;
    public function __construct()
    {
        $this->date = new \DateTime();
    }

    /**
     * @Route("inscription/{id}", name="maraude_inscription")
     * @param EntityManagerInterface $em
     * @param $id
     * @return Response
     */
    public function inscription(EntityManagerInterface $em, $id): Response
    {

        $maraudeRepository = $this->getDoctrine()->getRepository(Maraude::class);
        $maraude = $maraudeRepository->find($id);

        $nbInscription = $maraude->getInscriptions();
        $nbInscriptionMax = $maraude->getNbInscriptionsMax();
        $dateMaxInscription = $maraude->getDateCloture();

        $user = $this->getUser();

        if (count($nbInscription) < $nbInscriptionMax and $dateMaxInscription >  $this->date) {
            $inscription = new Inscription();
            $inscription->setUser($user);
            $inscription->setMaraude($maraude);
            $inscription->setDateInscription($this->date);

            if(count($nbInscription)+1 === $nbInscriptionMax){
                $maraude->setEtatMaraude('Cloturee');
                $em->persist($maraude);
            }

            $em->persist($inscription);
            $em->flush();

            $this->addFlash('success', 'Votre inscription a bien été ajoutée !');
            return $this->redirectToRoute('maraude_planning');
        }


        if (count($nbInscription) === $nbInscriptionMax) {
            $this->addFlash('warning', 'Le nombre maximum de participant est atteint !');
        }

        if ( $this->date > $dateMaxInscription ) {
            $this->addFlash('danger', 'Vous ne pouvez pas vous inscrire à cette maraude, la date limite d\'inscription est dépassée');
        }
        return $this->redirectToRoute('maraude_planning');

    }


    /**
     * @Route("desister/{id}", name="maraude_desister")
     * @param $id
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function desister(EntityManagerInterface $em, $id)
    {

        $user = $this->getUser();

        $maraudeRepository = $this->getDoctrine()->getRepository(Maraude::class);
        $maraude = $maraudeRepository->find($id);

        $inscriptionRepository = $em->getRepository(Inscription::class);
        $inscription = $inscriptionRepository->findBy(
            ['maraude' => $maraude->getId(), 'user' => $user->getId()],
            ['maraude' => 'ASC']
        );

        $nombreInscriptions = $maraude->getInscriptions();
        $nombreInscriptionsMax = $maraude->getNbInscriptionsMax();
        $etat = $maraude->getEtatMaraude(); //ou getEtat
        if(count($nombreInscriptions)-1 < $nombreInscriptionsMax && $etat === 'Cloture'){
            $maraude->setEtat('Ouverte');
            $em->persist($maraude);
        }

        $em->remove($inscription[0]);
        $em->flush();

        $this->addFlash('success', 'Votre désistement a bien été pris en compte, vous pouvez vous réinscrire à nouveau tant qu\'il y a de la place disponible !');
        return $this->redirectToRoute('maraude_planning');

      }


    /**
     * @Route("/planning", name="maraude_planning")
     */
       public function plannigMaraude(Request $request) :Response
       {
           $user = $this->getUser();
           $maraudeDataSearch = new MaraudeSearchData();
           $maraudeSearchForm = $this->createForm(MaraudeFilterType::class, $maraudeDataSearch);
           $maraudeSearchForm->handleRequest($request);
           $maraudesRepo = $this->getDoctrine()->getRepository(Maraude::class);
           $maraudes = $maraudesRepo->findMaraudes($maraudeDataSearch, $user);

           return $this->render('maraude/plannig_maraude.html.twig', [
               'controller_name' => 'MainController',
               'maraudes' => $maraudes,
               'user' => $user,
               'maraudeSearchForm' => $maraudeSearchForm->createView()
           ]);
       }

}
