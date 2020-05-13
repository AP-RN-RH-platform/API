<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Invitation;
use App\Entity\Offer;
use Symfony\Component\Security\Core\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SendInvitation extends AbstractController
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function __invoke(Request $data): Offer
    {
        $token = $data->get('token');

        //find invitation
        $invitation = $this->getDoctrine()
            ->getRepository(Invitation::class)
            ->findOneBy(['token' => $token]);

        if (!$invitation) {
            throw $this->createNotFoundException(
                'No invitation found for this token '.$token
            );
        }

        //check if is for current user
        $user = $this->security->getUser();
        if($user->getEmail() != $invitation->getEmail()){
            throw $this->createNotFoundException(
                'This token is not for the current User'
            );
        }

        //return Offer
        return $invitation->getOffer();
    }
}
