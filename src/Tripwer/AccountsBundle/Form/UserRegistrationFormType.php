<?php

namespace Tripwer\AccountsBundle\Form;

use FOS\UserBundle\Form\Type\RegistrationFormType;
use Symfony\Component\Form\FormBuilderInterface;

class UserRegistrationFormType extends RegistrationFormType{

    public function buildForm(FormBuilderInterface $builder,array $options){
        parent::buildForm($builder,$options);

        //$builder->remove("username");

        $builder->add("firstName");
        $builder->add("lastName");
        $builder->add("sex");
        $builder->add("dateOfBirth");

    }

    public function getName(){
        return "tripwer_user_registration";
    }
}

