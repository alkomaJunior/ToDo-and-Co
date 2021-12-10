<?php

namespace App\Tests\Controller;

use App\Repository\UserRepository;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\Translation\TranslatorInterface;

class UserControllerTest extends WebTestCase
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

    public function authenticateAdmin(): void
    {
        $this->databaseTool->loadAliceFixture([
            __DIR__ . '/UserControllerTestFixtures.yaml'
        ]);

        $user = $this->myContainer->get(UserRepository::class)->findOneBy(['email' => 'user2@domain.com']);

        $this->client->loginUser($user);
    }

    public function authenticateUser(): void
    {
        $this->databaseTool->loadAliceFixture([
            __DIR__ . '/UserControllerTestFixtures.yaml'
        ]);

        $user = $this->myContainer->get(UserRepository::class)->findOneBy(['email' => 'user1@domain.com']);

        $this->client->loginUser($user);
    }

    public function testUserIndex(): void
    {
        $this->authenticateAdmin();

        $this->client->request('GET', '/admin/user/');

        $this->assertSelectorTextContains(
            'h1',
            $this->myContainer->get(TranslatorInterface::class)->trans('User list')
        );
    }

    public function testUserIndexFailed(): void
    {
        $this->authenticateUser();

        $this->client->request('GET', '/admin/user/');

        $this->assertResponseStatusCodeSame(Response::HTTP_FORBIDDEN);
    }

    public function testCreateUser(): void
    {
        $this->authenticateAdmin();

        $crawler = $this->client->request('GET', '/admin/user/new');

        $form = $crawler->selectButton('addUser')->form();

        $form['user[email]'] = 'user3@domain.com';
        $form['user[firstName]'] = 'user3LastName';
        $form['user[lastName]'] = 'user3FirstName';
        $form['user[accountType]'] = 'Simple user';
        $form['user[location]'] = 'user3Location';
        $form['user[contact]'] = 'user3 contact';
        $form['user[plainPassword][first]'] = 'f@kePassw0rd';
        $form['user[plainPassword][second]'] = 'f@kePassw0rd';

        $crawler = $this->client->submit($form);

        $this->client->followRedirect();

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function testCreateAdmin(): void
    {
        $this->authenticateAdmin();

        $crawler = $this->client->request('GET', '/admin/user/new');

        $form = $crawler->selectButton('addUser')->form();

        $form['user[email]'] = 'user4@domain.com';
        $form['user[firstName]'] = 'user4LastName';
        $form['user[lastName]'] = 'user4FirstName';
        $form['user[accountType]'] = 'Administrator';
        $form['user[location]'] = 'user4Location';
        $form['user[contact]'] = 'user4 contact';
        $form['user[plainPassword][first]'] = 'f@kePassw0rd';
        $form['user[plainPassword][second]'] = 'f@kePassw0rd';

        $crawler = $this->client->submit($form);

        $this->client->followRedirect();

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function testEditUser(): void
    {
        $this->authenticateAdmin();

        $crawler = $this->client->request('GET', '/admin/user/user1/edit');

        $form = $crawler->selectButton('addUser')->form();

        $form['user[email]'] = 'user01@domain.com';
        $form['user[firstName]'] = 'user01LastName';
        $form['user[lastName]'] = 'user01FirstName';
        $form['user[accountType]'] = 'Simple user';
        $form['user[location]'] = 'user01Location';
        $form['user[contact]'] = 'user01 contact';

        $crawler = $this->client->submit($form);

        $this->client->followRedirect();

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function testDeleteUser(): void
    {
        $this->authenticateAdmin();

        $this->client->xmlHttpRequest(
            'POST',
            '/admin/user/user1',
            ['_token' => $this->myContainer->get('security.csrf.token_manager')
                ->getToken('deleteuser1')]
        );

        $this->assertResponseRedirects('/admin/user/');
    }
}
