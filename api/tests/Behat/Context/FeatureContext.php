<?php
namespace App\Tests\Behat\Context;

use App\Entity\User;
use Behat\Behat\Context\Context;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behat\MinkExtension\Context\MinkContext;
use Behatch\Context\RestContext;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

class FeatureContext implements Context
{
    // ...
    // Must be after createDatabase() and dropDatabase() functions (the order matters)

    private EntityManagerInterface $manager;

    private JWTTokenManagerInterface $jwtManager;

    public function __construct(EntityManagerInterface $manager, JWTTokenManagerInterface $jwtManager)
    {
        $this->manager = $manager;
        $this->jwtManager = $jwtManager;
    }

    /**
     * @BeforeScenario @login
     *
     * @see https://symfony.com/doc/current/security/entity_provider.html#creating-your-first-user
     */
    public function login(BeforeScenarioScope $scope)
    {
        $user = $this->manager->getRepository(User::class)->findOneBy([
            "email" => "recruiter@gmail.com"
        ]);
        $user->setRoles(["ROLE_RECRUITER"]);

        $token = $this->jwtManager->create($user);

        $this->restContext = $scope->getEnvironment()->getContext(RestContext::class);
        $this->restContext->iAddHeaderEqualTo('Authorization', "Bearer $token");
    }

    /**
     * @AfterScenario @logout
     */
    public function logout() {
        $this->restContext->iAddHeaderEqualTo('Authorization', '');
    }
}
