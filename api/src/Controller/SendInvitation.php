<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class SendInvitation
{
    public function __invoke(Request $data)
    {
        $token = $data->get('token');

        return $token;
    }
}
