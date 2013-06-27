<?php

namespace Tripwer\SocialNetworkingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class MemberController extends Controller
{
    /**
     * @Route("/register")
     * @Template()
     */
    public function registerAction()
    {
        return $this->container
            ->get('pugx_multi_user.registration_manager')
            ->register('Tripwer\SocialNetworkingBundle\Entity\Member');
    }

}
