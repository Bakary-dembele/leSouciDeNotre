<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Notification\ContactNotification;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="app_contact")
     * @param Request $request
     * @param ContactNotification $notification
     * @return Response
     */
    public function contact(Request $request, ContactNotification $notification): Response
    {
        $contact = new Contact();
        //$contact->setProperty($property);
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if (($form->isSubmitted() && $form->isValid())){
            $notification->notify($contact);
            $this->addFlash('success', 'votre email a été envoyé avec succès, nous vous répondrons dans les plus brefs délais.');
            return $this->redirectToRoute('home');
        }



        return $this->render('contact/index.html.twig', [
            //'controller_name' => 'ContactController',
            'form' => $form->createView(),
        ]);
    }
}

