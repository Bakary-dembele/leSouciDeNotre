<?php

namespace App\EventSubscriber;
use App\Entity\User;
use App\Entity\Collecte;
use App\Entity\Csm;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Security;


class EasyAdminSubscriber implements EventSubscriberInterface
{

    private $security;

    public function __construct(Security $security)
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

        if (!($entity instanceof Collecte)) {
            return;
        }

        $user = $this->security->getUser();
        $entity->setReferent($user);

    }

}