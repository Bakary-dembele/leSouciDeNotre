<?php

namespace App\Entity;

use App\Repository\CsmRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CsmRepository::class)
 */
class Csm
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $details;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="datetime")
     */
    private $dateHeure;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="datetime")
     */
    private $dateCloture;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $etatCsm;


    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="csms")
     * @ORM\JoinColumn(nullable=false)
     */
    private $referent;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Etat", inversedBy="csms")
     */
    private $etat;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\InscriptionCsm", mappedBy="csm", cascade={"remove"})
     */
    private $inscriptionCsms;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="integer")
     */
    private $nombreDePlace;


    public function __construct()
    {
        $this->inscriptionCsms = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }



    public function getNombreDePlace(): ?int
    {
        return $this->nombreDePlace;
    }

    public function setNombreDePlace(int $nombreDePlace): self
    {
        $this->nombreDePlace = $nombreDePlace;

        return $this;
    }

    public function getDetails(): ?string
    {
        return $this->details;
    }

    public function setDetails(?string $details): self
    {
        $this->details = $details;

        return $this;
    }

    public function getDateHeure(): ?\DateTimeInterface
    {
        return $this->dateHeure;
    }

    public function setDateHeure(\DateTimeInterface $dateHeure): self
    {
        $this->dateHeure = $dateHeure;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateCloture()
    {
        return $this->dateCloture;
    }

    /**
     * @param mixed $dateCloture
     */
    public function setDateCloture($dateCloture): void
    {
        $this->dateCloture = $dateCloture;
    }

    /**
     * @return mixed
     */
    public function getEtatCsm()
    {
        return $this->etatCsm;
    }

    /**
     * @param mixed $etatCsm
     */
    public function setEtatCsm($etatCsm): void
    {
        $this->etatCsm = $etatCsm;
    }


    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getReferent()
    {
        return $this->referent;
    }

    /**
     * @param mixed $referent
     */
    public function setReferent($referent): void
    {
        $this->referent = $referent;
    }




    /**
     * @return mixed
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param mixed $etat
     */
    public function setEtat($etat): void
    {
        $this->etat = $etat;
    }

    /**
     * @return mixed
     */
    public function getInscriptionCsms()
    {
        return $this->inscriptionCsms;
    }

    /**
     * @param ArrayCollection $inscriptionCsms
     */
    public function setInscriptionCsms(ArrayCollection $inscriptionCsms): void
    {
        $this->inscriptionCsms = $inscriptionCsms;
    }


    public function checkIfInscrit(User $u): bool
    {
        return $this->inscriptionCsms->exists(function($key, $inscriptionCsm) use($u)
        {
            return ($inscriptionCsm->getUser() == $u);
        });
    }


}
