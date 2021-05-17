<?php
namespace App\Notification;
use App\Entity\Contact;
use Twig\Environment;

class ContactNotification
{
    /**
     * @var\Swift_Mailer
     */
    private $mailer;

    /**
     * @var Environment
     */
    private $renderer;

    public function __construct(\Swift_Mailer $mailer, Environment $renderer)
    {
        $this->mailer = $mailer;
        $this->renderer = $renderer;
    }

    public function notify(Contact $contact){
        $message = (new \Swift_Message('Demande d\'information:', $contact->getNom()))
            ->setFrom($contact->getEmail())
            ->setTo('bakarydembele75018@gmail.com')  //remettre le mail d'utilisateur connecte
            ->setReplyTo($contact->getEmail())
            ->setBody($this->renderer->render('emails/contact.html.twig', [
                'contact' =>$contact
            ]),'text/html');
        $this->mailer->send($message);
    }


}