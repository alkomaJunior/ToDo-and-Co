<?php

namespace App\Tests\Repository;

use App\Repository\TaskRepository;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;

class TaskRepositoryTest extends KernelTestCase
{
    /**
     * @var AbstractDatabaseTool $databaseTool
     */
    protected AbstractDatabaseTool $databaseTool;
    private ContainerInterface $myContainer;

    public function setUp(): void
    {
        parent::setUp();

        // Booting of the kernel
        self::bootKernel();
        $this->myContainer = static::getContainer();
        $this->databaseTool = $this->myContainer->get(DatabaseToolCollection::class)->get();
    }

    public function testCount()
    {
        $this->databaseTool->loadAliceFixture([
            __DIR__ . '/TaskRepositoryTestFixtures.yaml'
        ]);

        $tasks = $this->myContainer->get(TaskRepository::class)->count([]);

        $this->assertEquals(10, $tasks);
    }

    public function testFindAll()
    {
        $this->databaseTool->loadAliceFixture([
            __DIR__ . '/TaskRepositoryTestFixtures.yaml'
        ]);

        $tasks = $this->myContainer->get(TaskRepository::class)->findAll();

        $this->assertCount(10, $tasks);
        $this->assertNotCount(5, $tasks);
        $this->assertIsArray($tasks);
    }

    public function testFindBy()
    {
        $this->databaseTool->loadAliceFixture([
            __DIR__ . '/TaskRepositoryTestFixtures.yaml'
        ]);

        $tasks = $this->myContainer->get(TaskRepository::class)->findBy(['id' => 1]);

        $this->assertCount(1, $tasks);
        $this->assertNotCount(2, $tasks);
        $this->assertIsArray($tasks);
    }

    public function testFindOneBy()
    {
        $this->databaseTool->loadAliceFixture([
            __DIR__ . '/TaskRepositoryTestFixtures.yaml'
        ]);

        $task = $this->myContainer->get(TaskRepository::class)->findOneBy(['id' => 1]);

        $this->assertIsNotArray($task);
        $this->assertIsObject($task);
        $this->assertIsInt($task->getId());
    }
}
