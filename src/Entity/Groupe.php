<?php

namespace App\Entity;

use App\Repository\GroupeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GroupeRepository::class)
 */
class Groupe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $nomGroupe;

    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="groupe", cascade={"remove"})
     * @var ArrayCollection
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Maraude", mappedBy="groupe", cascade={"remove"})
     */
    private $maraudes;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->maraudes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getNomGroupe()
    {
        return $this->nomGroupe;
    }

    /**
     * @param mixed $nomGroupe
     */
    public function setNomGroupe($nomGroupe): void
    {
        $this->nomGroupe = $nomGroupe;
    }

    /**
     * @return ArrayCollection
     */
    public function getUsers(): ArrayCollection
    {
        return $this->users;
    }

    /**
     * @param ArrayCollection $users
     */
    public function setUsers(ArrayCollection $users): void
    {
        $this->users = $users;
    }

    /**
     * @return ArrayCollection
     */
    public function getMaraudes(): ArrayCollection
    {
        return $this->maraudes;
    }

    /**
     * @param ArrayCollection $maraudes
     */
    public function setMaraudes(ArrayCollection $maraudes): void
    {
        $this->maraudes = $maraudes;
    }

    public function __toString()
    {
        return $this->nomGroupe;
    }

}
