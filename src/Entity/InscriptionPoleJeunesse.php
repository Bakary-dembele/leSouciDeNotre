<?php

namespace App\Entity;

use App\Repository\InscriptionPoleJeunesseRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InscriptionPoleJeunesseRepository::class)
 */
class InscriptionPoleJeunesse
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
     * @ORM\ManyToOne(targetEntity="App\Entity\PoleJeunesse", inversedBy="inscriptionPoleJeunesses")
     * ORM\JoinColumn(nullable=false)
     */
    private $poleJeunesse;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="inscriptionPoleJeunesses")
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
    public function getPoleJeunesse()
    {
        return $this->poleJeunesse;
    }

    /**
     * @param mixed $poleJeunesse
     */
    public function setPoleJeunesse($poleJeunesse): void
    {
        $this->poleJeunesse = $poleJeunesse;
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
