<?php

namespace App\Tests\Behat\Context\Traits;

trait AuthTrait
{

    protected $token;

    /**
     * @Given /^I authenticate with user "([^"]*)" and password "([^"]*)"$/
     */
    public function iAuthenticateWithEmailAndPassword($email, $password)
    {
        $this->token = $this->authManager->login($email, $password);
    }
}
