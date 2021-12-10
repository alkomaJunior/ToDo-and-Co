<?php

namespace App\Entity\Traits;

use DateTime;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

trait UserAvatar
{
    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $avatar = null;

    /**
     * @Vich\UploadableField(mapping="users", fileNameProperty="avatar")
     */
    #[Assert\File(
        maxSize: '3M',
        mimeTypes: ['image/jpeg', 'image/png'],
        maxSizeMessage: 'validator.message.maxSizeMessage',
        mimeTypesMessage: 'validator.message.maxSizeMessage',
        groups: ['user_creation', 'user_editing']
    )]
    private ?File $avatarFile = null;

    #[ORM\Column(type: "string", length: 50, nullable: true)]
    private ?string $status;

    public function setAvatarFile(File $avatar = null)
    {
        $this->avatarFile = $avatar;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($avatar) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->status = "Changed at " . date_format((new DateTime('now')), 'c');
        }
    }

    public function getAvatarFile(): ?File
    {
        return $this->avatarFile;
    }

    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }
}
