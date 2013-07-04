<?php

namespace Tripwer\SocialNetworkingBundle\Exception\Notification;



class NotificationTypeNotFoundException extends \Exception{
    public function __construct($type){
        parent::__construct("Notification with type ".$type." was not found.");
    }
}