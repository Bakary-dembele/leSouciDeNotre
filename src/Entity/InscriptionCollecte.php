<?php

namespace App\Entity;

use App\Repository\InscriptionCollecteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InscriptionCollecteRepository::class)
 */
class InscriptionCollecte
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateInscription;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Collecte", inversedBy="inscriptionCollectes")
     * ORM\JoinColumn(nullable=false)
     */
    private $collecte;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="inscriptionCollectes")
     * ORM\JoinColumn(nullable=false)
     */
    private $user;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateInscription(): ?\DateTimeInterface
    {
        return $this->dateInscription;
    }

    public function setDateInscription(\DateTimeInterface $dateInscription): self
    {
        $this->dateInscription = $dateInscription;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCollecte()
    {
        return $this->collecte;
    }

    /**
     * @param mixed $collecte
     */
    public function setCollecte($collecte): void
    {
        $this->collecte = $collecte;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }


}
