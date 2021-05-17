<?php

namespace App\Entity;

use App\Repository\DomRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DomRepository::class)
 */
class Dom
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $Dom;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDom(): ?int
    {
        return $this->Dom;
    }

    public function setDom(int $Dom): self
    {
        $this->Dom = $Dom;

        return $this;
    }
}
