<?php

namespace App\Entity;

use App\Repository\ InscriptionPoleVisiteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass= InscriptionPoleVisiteRepository::class)
 */
class InscriptionPoleVisite
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
     * @ORM\ManyToOne(targetEntity="App\Entity\PoleVisite", inversedBy="inscriptionPoleVisites")
     * ORM\JoinColumn(nullable=false)
     */
    private $poleVisite;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="inscriptionPoleVisites")
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
    public function getPoleVisite()
    {
        return $this->poleVisite;
    }

    /**
     * @param mixed $poleVisite
     */
    public function setPoleVisite($poleVisite): void
    {
        $this->poleVisite = $poleVisite;
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
