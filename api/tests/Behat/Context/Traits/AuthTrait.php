<?php

namespace App\Tests\Behat\Context\Traits;

trait AuthTrait
{


    /**
     * @Given /^I authenticate with user "([^"]*)" and password "([^"]*)"$/
     */
    public function iAuthenticateWithEmailAndPassword($email, $password)
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
        if (isset($response["token"])) {
            $token = $response["token"];
            $this->iSetTheHeaderToBe("Authorization", "Bearer {$token}");
        }
    }
}
