<?php

namespace App\Tests\Entity;

use App\Entity\Task;
use App\Entity\User;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class TaskEntityTest extends KernelTestCase
{
    public function getEntity(): Task
    {
        return (new Task())
            ->setTitle("Task 1")
            ->setDescription("Task 1 description")
            ->setStatus("todo")
            ->setSlug("username")
            ->setCreatedAt(new DateTimeImmutable())
            ->setUpdatedAt(new DateTimeImmutable())
            ;
    }

    public function assertHasErrors(Task $task, int $number = 0)
    {
        self::bootKernel();
        $validator = static::getContainer()->get(ValidatorInterface::class);
        $error = $validator->validate($task);
        $this->assertCount($number, $error);
    }

    public function testValidTaskEntity()
    {
        $this->assertHasErrors($this->getEntity(), 0);
    }

    public function testInvalidTaskEntity()
    {
        $this->assertHasErrors(
            $this->getEntity()
            ->setTitle(""),
            1
        );
    }

    public function testGettersSetters()
    {
        $task = $this->getEntity();

        $user = (new User())
            ->setEmail("username@some.where")
            ->setFirstName("username")
            ->setLastName("userLastName")
            ->setPlainPassword("F@kePass3")
            ->setAccountType("Simple User")
            ->setLocation("Strasbourg, FRANCE")
            ->setContact("+33749352359")
            ->setSlug("username")
            ->setCreatedAt(new DateTimeImmutable())
            ->setUpdatedAt(new DateTimeImmutable())
        ;

        $this->assertIsString($task->getTitle());
        $this->assertIsString($task->getDescription());
        $this->assertIsString($task->getStatus());
        $this->assertIsString($task->getSlug());
        $this->assertIsObject($task->setUser($user)->getUser());
        $this->assertIsObject($task->getCreatedAt());
        $this->assertIsObject($task->getUpdatedAt());
    }
}
