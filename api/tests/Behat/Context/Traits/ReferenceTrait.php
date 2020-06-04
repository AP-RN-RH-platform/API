<?php


namespace App\Tests\Behat\Context\Traits;

use App\Tests\Behat\Manager\ReferenceManager;

trait ReferenceTrait
{

    /**
     * @Given /^I save the reference in "([^"]*)"$/
     */
    public function iSaveInReference($key)
    {
        $response = json_decode($this->lastResponse->getContent(), true);
        $id = UtilsTrait::arrayGet($response, 'id');
        ReferenceManager::add($key, $id);
    }
}
