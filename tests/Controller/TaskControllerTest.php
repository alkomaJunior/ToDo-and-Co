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

class TaskControllerTest extends WebTestCase
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

    public function authenticateUser(): void
    {
        $this->databaseTool->loadAliceFixture([
            __DIR__ . '/UserControllerTestFixtures.yaml'
        ]);

        $user = $this->myContainer->get(UserRepository::class)->findOneBy(['email' => 'user2@domain.com']);

        $this->client->loginUser($user);
    }

    public function testTaskIndex(): void
    {
        $this->authenticateUser();

        $this->client->request('GET', '/task/');

        $this->assertSelectorTextContains(
            'h1',
            $this->myContainer->get(TranslatorInterface::class)->trans('Task list')
        );
    }

    public function testAnonymousUserTask(): void
    {
        $this->authenticateUser();

        $this->client->request('GET', '/task/other-tasks');

        $this->assertSelectorTextContains(
            'h1',
            $this->myContainer->get(TranslatorInterface::class)->trans('Task list')
        );
    }

    public function testCreateTask(): void
    {
        $this->authenticateUser();

        $crawler = $this->client->request('GET', '/task/new');

        $form = $crawler->selectButton($this->myContainer
            ->get(TranslatorInterface::class)->trans('Add a task'))->form();

        $form['task[title]'] = 'task 1 title';
        $form['task[description]'] = 'task 1 description';

        $crawler = $this->client->submit($form);

        $this->client->followRedirect();

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function testEditTask(): void
    {
        $this->testCreateTask();

        $crawler = $this->client->request('GET', '/task/task1title/edit');

        $form = $crawler->selectButton($this->myContainer
            ->get(TranslatorInterface::class)->trans('Edit a task'))->form();

        $form['task[title]'] = 'task 02 title';
        $form['task[description]'] = 'task 02 description';

        $crawler = $this->client->submit($form);

        $this->client->followRedirect();

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function testDeleteTask(): void
    {
        $this->authenticateUser();

        $this->databaseTool->loadAliceFixture([
            self::$kernel->getProjectDir() . '/tests/Repository/TaskRepositoryTestFixtures.yaml'
        ]);

        $this->client->xmlHttpRequest(
            'POST',
            '/task/task3',
            ['_token' => $this->myContainer->get('security.csrf.token_manager')
                ->getToken('deletetask3')]
        );

        $this->assertResponseRedirects('/task/');
    }

    public function testDashboard(): void
    {
        $this->authenticateUser();

        $this->client->request('GET', '/task/dashboard');

        $this->assertSelectorTextContains(
            'h1',
            $this->myContainer->get(TranslatorInterface::class)->trans('Dashboard')
        );
    }

    public function testUpdateStatus(): void
    {
        $this->authenticateUser();

        $this->databaseTool->loadAliceFixture([
            self::$kernel->getProjectDir() . '/tests/Repository/TaskRepositoryTestFixtures.yaml'
        ]);

        $this->client->xmlHttpRequest(
            'POST',
            '/task/update-status/5',
            ['status' => 'task status']
        );

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }
}
