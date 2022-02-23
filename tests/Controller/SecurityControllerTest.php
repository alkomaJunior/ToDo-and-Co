<?php

namespace App\Tests\Controller;

use App\Controller\SecurityController;
use App\Repository\UserRepository;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class SecurityControllerTest extends WebTestCase
{
    /**
     * @var AbstractDatabaseTool $databaseTool
     */
    protected AbstractDatabaseTool $databaseTool;
    private ContainerInterface $myContainer;
    private KernelBrowser $client;

    public function setUp(): void
    {
        parent::setUp();
        $this->client = static::createClient();
        $this->myContainer = static::getContainer();
        $this->databaseTool = $this->myContainer->get(DatabaseToolCollection::class)->get();
    }

    public function testHome(): void
    {
        $crawler = $this->client->request('GET', '/');

        $this->assertSelectorTextContains(
            'p',
            $this->getContainer()->get(TranslatorInterface::class)->trans('Please sign in')
        );
    }

    public function authenticateUser(): void
    {
        $this->databaseTool->loadAliceFixture([
            __DIR__ . '/UserControllerTestFixtures.yaml'
        ]);

        $user = $this->myContainer->get(UserRepository::class)->findOneBy(['email' => 'user1@domain.com']);

        $this->client->loginUser($user);
    }

    public function testAuthentication(): void
    {
        $this->authenticateUser();

        $this->client->request('GET', '/task/dashboard');

        $this->assertSelectorTextContains(
            'h1',
            $this->getContainer()->get(TranslatorInterface::class)->trans('Dashboard')
        );
        $this->assertResponseIsSuccessful();
    }

    public function testLogout(): void
    {
        $this->authenticateUser();

        $sc = new SecurityController();

        $this->client->request('GET', '/logout');

        $this->assertResponseRedirects('http://localhost/');
        $this->assertNull($sc->logout());
    }

    public function testHomeForAuthUser(): void
    {
        $this->authenticateUser();

        $this->client->request('GET', '/');

        $this->assertResponseRedirects('/task/dashboard');
    }
}
