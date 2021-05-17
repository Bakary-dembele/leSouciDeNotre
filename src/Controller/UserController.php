<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\MonProfilType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{

    /**
     * @Route("/afficherProfilUsers/{id}", name="profilUsers")
     * @param $id
     * @return Response
     */
    public function afficherProfilUsers($id): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);
        if(empty($user)){
            throw $this->createNotFoundException('Ce participant n\'existe pas');
        }

        return $this->render('user/afficherProfilUsers.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/afficherProfilUser", name="profilUser")
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function afficherProfilUser(Request $request, UserPasswordEncoderInterface $encoder, EntityManagerInterface $em): Response
    {
        $user = $this->getUser();
        $userForm = $this->createForm(MonProfilType::class, $user);

        $userForm->handleRequest($request);

        if ($userForm->isSubmitted() && $userForm->isValid()){
            $hashed = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hashed);

            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Votre profil a bien été génére');
            return $this->redirectToRoute('home');
        }

        return $this->render('user/afficherProfilUser.html.twig', [
            'userForm' => $userForm->createView(),
        ]);

    }

}
