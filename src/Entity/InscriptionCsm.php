<?php

namespace App\Entity;

use App\Repository\ InscriptionCsmRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass= InscriptionCsmRepository::class)
 */
class InscriptionCsm
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Csm", inversedBy="inscriptionCsms")
     * ORM\JoinColumn(nullable=false)
     */
    private $csm;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="inscriptionCsms")
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
    public function getCsm()
    {
        return $this->csm;
    }

    /**
     * @param mixed $csm
     */
    public function setCsm($csm): void
    {
        $this->csm = $csm;
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
