<?php

namespace App\EventSubscriber;

use App\Entity\Invitation;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use ApiPlatform\Core\EventListener\EventPriorities;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

final class InvitationSubscriber implements EventSubscriberInterface
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Subscribes to prePersist and preUpdate Events.
     *
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => [
                ['sendMail', EventPriorities::POST_WRITE],
                ['generateToken', EventPriorities::PRE_WRITE]
            ],
        ];
    }

    public function sendMail(ViewEvent $event){
        $invitation = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if (!$invitation instanceof Invitation || Request::METHOD_POST !== $method) {
            return;
        }

        $email = (new Email())
            ->from($_ENV['APP_EMAIL_SENDER'])
            ->to($invitation->getEmail())
            ->subject('Une invitation à candidaté vous à été envoyé!')
            ->text(sprintf('Rendez-vous sur RH APP et retrouvez l\'offre '.$invitation->getToken().' pour y postuler.'))
            ->html(sprintf('Rendez-vous sur RH APP et retrouvez l\'offre <b>'.$invitation->getToken().'</b> pour y postuler.'));

        $this->mailer->send($email);
    }

    public function generateToken(ViewEvent $event){
        $invitation = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if (!$invitation instanceof Invitation || Request::METHOD_POST !== $method) {
            return;
        }

        $token = random_bytes(10);
        $invitation->setToken(bin2hex($token));
    }
}
