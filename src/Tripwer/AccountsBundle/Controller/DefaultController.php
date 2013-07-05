<?php

namespace Tripwer\AccountsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/test")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $users = $em->getRepository("TripwerAccountsBundle:User")->findAll();
        $user1 = $users[0];
        $user2 = $users[1];

        $user1->addMemberToBlacklist($user2);
        $em->persist($user1);
        $em->flush();
        die();
        return array('name' => $name);
    }
}
