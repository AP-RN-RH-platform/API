<?php

namespace App\EventSubscriber;

use App\Entity\Offer;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use ApiPlatform\Core\EventListener\EventPriorities;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;


final class OfferSubscriber implements EventSubscriberInterface
{

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * Subscribes to prePersist and preUpdate Events.
     *
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['setCreatedBy', EventPriorities::PRE_WRITE],
        ];
    }

    public function setCreatedBy(ViewEvent $event){
        $offer = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if (!$offer instanceof Offer || Request::METHOD_POST !== $method) {
            return;
        }
        $user = $this->tokenStorage->getToken()->getUser();
        $offer->setCreatedBy($user);
    }
}
