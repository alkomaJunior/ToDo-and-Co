<?php

namespace App\Entity;

use App\Entity\Traits\Slug;
use App\Entity\Traits\Timestampable;
use App\Entity\Traits\UserAvatar;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Rollerworks\Component\PasswordStrength\Validator\Constraints as RollerworksPassword;
use Symfony\Component\Validator\Constraints\NotCompromisedPassword;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[
    ORM\Entity(repositoryClass: UserRepository::class),
    ORM\Table(name: "`users`"),
    ORM\HasLifecycleCallbacks,
    UniqueEntity("email")
 ]
/**
 * @Vich\Uploadable
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    use Timestampable;
    use Slug;
    use UserAvatar;

    #[
        ORM\Id,
        ORM\GeneratedValue,
        ORM\Column(type: "integer")
     ]
    private ?int $id;

    #[
        ORM\Column(type: "string", length: 180, unique: true),
        NotBlank(message: 'validator.message.notBlank', groups: ['user_creation', 'user_editing']),
        Email(message: 'validator.message.email', groups: ['user_creation', 'user_editing'])
     ]
    private ?string $email;

    #[
        ORM\Column(type: "json"),
     ]
    private array $roles = [];

    /** @var string The hashed password */
    #[
        ORM\Column(type: "string")
     ]
    private string $password;

    #[
        NotBlank(message: 'validator.message.notBlank', groups: ['user_creation']),
        RollerworksPassword\PasswordStrength(
            groups: ['user_creation'],
            minStrength: 4,
            minLength: 8,
            message: 'validator.message.passwordStrength',
            tooShortMessage: 'validator.message.passwordStrength'
        ),
        RollerworksPassword\PasswordRequirements(
            groups: ['user_creation'],
            requireLetters: true,
            requireCaseDiff: true,
            requireNumbers: true,
            requireSpecialCharacter: true,
            tooShortMessage: 'validator.message.tooShortMessage',
            missingLettersMessage: 'validator.message.missingLettersMessage',
            requireCaseDiffMessage: 'validator.message.requireCaseDiffMessage',
            missingNumbersMessage: 'validator.message.missingNumbersMessage',
            missingSpecialCharacterMessage: 'validator.message.missingSpecialCharacterMessage'
        ),
        NotCompromisedPassword(message: 'validator.message.notCompromisedPassword', groups: ['user_creation'])
     ]
    private string $plainPassword;

    #[
        ORM\Column(type: "string", length: 255),
        NotBlank(message: 'validator.message.notBlank', groups: ['user_creation', 'user_editing']),
     ]
    private ?string $firstName;

    #[
        ORM\Column(type: "string", length: 255),
        NotBlank(message: 'validator.message.notBlank', groups: ['user_creation', 'user_editing'])
     ]
    private ?string $lastName;

    #[
        ORM\Column(type: "string", length: 50),
        NotBlank(message: 'validator.message.notBlank', groups: ['user_creation', 'user_editing'])
     ]
    private ?string $accountType;

    #[
        ORM\Column(type: "string", length: 100),
        NotBlank(message: 'validator.message.notBlank', groups: ['user_creation', 'user_editing'])
     ]
    private ?string $location;

    #[
        ORM\Column(type: "string", length: 100),
        NotBlank(message: 'validator.message.notBlank', groups: ['user_creation', 'user_editing'])
     ]
    private ?string $contact;

    #[
        ORM\OneToMany(mappedBy: "user", targetEntity: Task::class)
     ]
    private Collection $tasks;

    #[Pure]
    public function __construct()
    {
        $this->tasks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): self
    {
        // If you store any temporary, sensitive data on the user, clear it here
        $this->plainPassword = "";

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getAccountType(): ?string
    {
        return $this->accountType;
    }

    public function setAccountType(string $accountType): self
    {
        $this->accountType = $accountType;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getContact(): ?string
    {
        return $this->contact;
    }

    public function setContact(string $contact): self
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getTasks(): Collection
    {
        return $this->tasks;
    }

    public function addTask(Task $task): self
    {
        if (!$this->tasks->contains($task)) {
            $this->tasks[] = $task;
            $task->setUser($this);
        }

        return $this;
    }

    public function removeTask(Task $task): self
    {
        if ($this->tasks->removeElement($task)) {
            // set the owning side to null (unless already changed)
            if ($task->getUser() === $this) {
                $task->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getPlainPassword(): string
    {
        return $this->plainPassword;
    }

    /**
     * @param string $plainPassword
     * @return User
     */
    public function setPlainPassword(string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }
}
