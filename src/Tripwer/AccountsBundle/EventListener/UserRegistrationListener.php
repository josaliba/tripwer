<?php
namespace Tripwer\AccountsBundle\EventListener;

use Doctrine\ORM\EntityManager;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\UserEvent;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class UserRegistrationListener implements EventSubscriberInterface{

    private $em;


    public function __construct(EntityManager $em){
        $this->em = $em;
    }

    public static function getSubscribedEvents()
    {
        return array(
            FOSUserEvents::REGISTRATION_INITIALIZE => 'onUserRegistrationInitialize',
        );
    }

    public function onUserRegistrationInitialize($event){
        //we disable the filter so users with deleted accounts are taken into consideration
        //so we don't have two users with the same email !
        $this->em->getFilters()->disable('softdeleteable');
    }
}