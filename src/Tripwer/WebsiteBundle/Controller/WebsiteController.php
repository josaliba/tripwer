<?php

namespace Tripwer\WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Tripwer\AccountsBundle\Entity\Member;

class WebsiteController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Template()
     * @Secure("IS_AUTHENTICATED_ANONYMOUSLY")
     */
    public function homepageAction()
    {
        if ($this->getUser() && ($this->getUser() instanceof Member) && $this->getUser()->hasRole("ROLE_USER")){
            return $this->redirect($this->generateUrl("member_homepage"));
        }

        return array();
    }

    /**
     * @Route("/home", name="member_homepage")
     * @Template()
     * @Secure("ROLE_USER")
     */
    public function memberHomepageAction(){

        return array();
    }
}
