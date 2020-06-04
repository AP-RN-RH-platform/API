<?php

namespace App\Tests\Behat\Manager;

use App\Entity\User;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behatch\Context\RestContext;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

class AuthManagerTest
{

    /**
     * @var EntityManagerInterface
     */
    private $manager;
    /**
     * @var JWTTokenManagerInterface
     */
    private $jwtManager;
    /**
     * @var RestContext
     */
    private $restContext;

    public function __construct(EntityManagerInterface $manager, JWTTokenManagerInterface $jwtManager, RestContext $restContext)
    {
        $this->manager = $manager;
        $this->jwtManager = $jwtManager;
        $this->restContext = $restContext;
    }

    /**
     * @BeforeScenario
     * @loginAsRecruiter
     *
     * @see https://symfony.com/doc/current/security/entity_provider.html#creating-your-first-user
     */
    public function loginAsRecruiter(BeforeScenarioScope $scope)
    {

        $user = $this->manager->getRepository(User::class)->findOneBy(["email" => "recruiter@gmail.com"]);

        $token = $this->jwtManager->create($user);

        $this->restContext = $scope->getEnvironment()->getContext(RestContext::class);
        $this->restContext->iAddHeaderEqualTo('Authorization', "Bearer $token");
    }

    /**
     * @BeforeScenario
     * @loginAsApplicant
     *
     * @see https://symfony.com/doc/current/security/entity_provider.html#creating-your-first-user
     */
    public function loginAsApplicant(BeforeScenarioScope $scope)
    {
        $user = $this->manager->getRepository(User::class)->findOneBy(["email" => "applicant@gmail.com"]);

        $this->manager->persist($user);
        $this->manager->flush();

        $token = $this->jwtManager->create($user);

        $this->restContext = $scope->getEnvironment()->getContext(RestContext::class);
        $this->restContext->iAddHeaderEqualTo('Authorization', "Bearer $token");
    }


    /**
     * @AfterScenario
     * @logout
     */
    public function logout() {
        $this->restContext->iAddHeaderEqualTo('Authorization', '');
    }


}
