<?php

namespace App\Entity;

use App\Repository\PhotoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PhotoRepository::class)
 */
class Photo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $upload;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUpload(): ?string
    {
        return $this->upload;
    }

    public function setUpload(?string $upload): self
    {
        $this->upload = $upload;

        return $this;
    }
}
