<?php

namespace App\Tests\Behat\Context\Traits;

trait AuthTrait
{
    /**
     * The user to use with HTTP basic authentication
     *
     * @var string
     */
    protected $authUser;

    /**
     * The password to use with HTTP basic authentication
     *
     * @var string
     */
    protected $authPassword;

    /**
     * FeatureContext constructor.
     *
     * @param KernelInterface $kernel the kernel to get services.
     */
    public function __construct(KernelInterface $kernel)
    {
        $this->manager = $kernel->getContainer()->get('doctrine.orm.default_entity_manager');
        $this->jwtManager = $kernel->getContainer()->get('lexik_jwt_authentication.jwt_manager');
    }

    /**
     * @BeforeScenario @loginAsAdmin
     *
     * @see https://symfony.com/doc/current/security/entity_provider.html#creating-your-first-user
     *
     * @param BeforeScenarioScope $scope the scope
     */
    public function loginAsAdmin(BeforeScenarioScope $scope)
    {
        //Test with a fake user
        //$user = new User();
        //$user->setEmail('admin@example.org');
        //$user->setUsername('Admin');
        //$user->setRoles(['ROLE_ADMIN']);
        //Test with a user in database
        /** @var UserRepository $userRepository */
        $userRepository = $this->manager->getRepository(User::class);
        /** @var User $user */
        $user = $userRepository->findOneByEmail('recruiter@example.org');
        $token = $this->jwtManager->create($user);
        /** @var RestContext $restContext */
        $this->restContext = $scope->getEnvironment()->getContext(RestContext::class);
        $this->restContext->iAddHeaderEqualTo('Authorization', "Bearer $token");
    }

    /**
     * @Given /^I authenticate with user "([^"]*)" and password "([^"]*)"$/
     */
    public function iAuthenticateWithEmailAndPassword($email, $password)
    {
        $this->authUser = $email;
        $this->authPassword = $password;
    }
}
