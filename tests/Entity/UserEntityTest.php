<?php

namespace App\Tests\Entity;

use App\Entity\Task;
use App\Entity\User;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserEntityTest extends KernelTestCase
{
    public function getEntity(): User
    {
        return (new User())
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
    }

    public function assertHasErrors(User $user, int $number = 0)
    {
        self::bootKernel();
        $validator = static::getContainer()->get(ValidatorInterface::class);
        $error = $validator->validate($user);
        $this->assertCount($number, $error);
    }

    public function testValidUserEntity()
    {
        $this->assertHasErrors($this->getEntity(), 0);
    }

    public function testGettersSetters()
    {
        $user = $this->getEntity();

        $tasks = [
            (new Task())
                ->setTitle("Task 1")
                ->setDescription("Task 1 description")
                ->setStatus("todo")
                ->setStartAt(new DateTimeImmutable())
                ->setEndAt(new DateTimeImmutable()),
            (new Task())
                ->setTitle("Task 2")
                ->setDescription("Task 2 description")
                ->setStatus("in-progress")
                ->setStartAt(new DateTimeImmutable())
                ->setEndAt(new DateTimeImmutable())
        ];

        $this->assertIsString($user->getUserIdentifier());
        $this->assertIsString($user->getPlainPassword());
        $this->assertIsString($user->getFirstName());
        $this->assertIsString($user->getLastName());
        $this->assertIsString($user->getLocation());
        $this->assertIsString($user->getContact());
        $this->assertIsString($user->setPassword($this->getContainer()->get('test_alias.security.password_hasher')
            ->hashPassword($user, $user->getPlainPassword()))->getPassword());
        $this->assertIsString($user->getEmail());
        $this->assertIsArray($user->setRoles(["ROLE_USER"])->getRoles());
        $this->assertEquals($user->getUsername(), $user->getUserIdentifier());
        $this->assertEquals(null, $user->getSalt());
        $this->assertIsObject($user->getCreatedAt());
        $this->assertIsObject($user->getUpdatedAt());
        $this->assertIsString($user->getSlug());
        $this->assertEquals('', $user->eraseCredentials()->getPlainPassword());
        $this->assertIsObject($user->addTask($tasks[0])->getTasks());
        $this->assertCount(0, $user->removeTask($tasks[0])->getTasks());
    }
}
