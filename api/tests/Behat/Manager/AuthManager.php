<?php
namespace App\Tests\Behat\Manager;

use Symfony\Component\HttpKernel\KernelInterface;
use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\Client;


class AuthManager
{
    private Client $client;

    public function __construct(KernelInterface $kernel)
    {
        $this->client = $kernel->getContainer()->get('test.api_platform.client');
    }


    public function login($email, $password)
    {
        $response = $this->client->request(
            "POST",
            "/authentication_token",
            [
                "headers" => ["content-type" => "application/ld+json"],
                'body' => json_encode(["email" => $email, "password" => $password]),
            ]
        );
        $response = json_decode($response->getContent(false), true);
        $token = $response["token"];
        return $token;
    }



}
