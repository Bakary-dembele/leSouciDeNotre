<?php

namespace App\EventSubscriber;
use App\Entity\EvenementFoot;
use App\Entity\InscriptionEvenementFoot;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Security;


class EasyAdminSubscriberEvenementInscriptionFoot implements EventSubscriberInterface
{

    private $security;

    public function __construct(Security $security, EntityManagerInterface $entityManager)
    {
        $this->security =$security;
    }


    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['setGroupeAndUser'],
        ];
    }

    public function setGroupeAndUser(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if (!($entity instanceof EvenementFoot)) {
            return;
        }

        $user = $this->security->getUser();
        $entity->setInscriptionEnvenementFoots($user);

    }

}