<?php

namespace App\Entity;

use App\Repository\TaskRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Traits\Timestampable;
use App\Entity\Traits\Slug;
use Symfony\Component\Validator\Constraints\NotBlank;

#[
    ORM\Entity(repositoryClass: TaskRepository::class),
    ORM\Table(name: "`tasks`"),
    ORM\HasLifecycleCallbacks
 ]
class Task
{
    use Timestampable;
    use Slug;

    #[
        ORM\Id,
        ORM\GeneratedValue,
        ORM\Column(type: "integer")
     ]
    private ?int $id;

    #[
        ORM\Column(type: "string", length: 255),
        NotBlank
     ]
    private ?string $title;

    #[
        ORM\Column(type: "text"),
        NotBlank
     ]
    private ?string $description;

    #[
        ORM\Column(type: "string", length: 50)
     ]
    private ?string $status;

    #[
        ORM\ManyToOne(targetEntity: User::class, inversedBy: "tasks"),
        ORM\JoinColumn(nullable: true),
     ]
    private ?User $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
