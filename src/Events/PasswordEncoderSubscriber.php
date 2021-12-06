<?php

namespace App\Events;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\User;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class PasswordEncoderSubscriber implements EventSubscriberInterface
{
    /**@var UserPasswordHasherInterface" */
    private $encoder;

    public function __construct(UserPasswordHasherInterface $encoder){
        $this->encoder = $encoder;
    }
    public static function getSubscribedEvents() {
        return [
            KernelEvents::VIEW => ['hashPassword', EventPriorities::PRE_WRITE]
        ];
    }

    public function hashPassword (ViewEvent $event){
         $user= $event->getControllerResult();
         $method = $event->getRequest()->getMethod();
         if($user instanceof User && $method ==="POST"|$method==="PUT")
        {
             $hash = $this->encoder->hashPassword($user,$user->getPassword());
             $user->setPassword($hash);
            //  dd($user);
        }
    }
}