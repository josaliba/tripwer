<?php

namespace Tripwer\SocialNetworkingBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Tripwer\AccountsBundle\Form\UserRegistrationFormType;

class MemberRegistrationFormType extends UserRegistrationFormType{

    public function buildForm(FormBuilderInterface $builder,array $options){
        parent::buildForm($builder,$options);
    }

    public function getName(){
        return "tripwer_socialnetworking_member_registration_form";
    }
}

