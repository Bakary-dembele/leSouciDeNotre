<?php

namespace App\Entity;

use App\Repository\PoleVisiteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PoleVisiteRepository::class)
 */
class PoleVisite
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
    private $etatPolevisite;


    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="poleVisites")
     * @ORM\JoinColumn(nullable=false)
     */
    private $referent;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Etat", inversedBy="poleVisites")
     */
    private $etat;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\InscriptionPoleVisite", mappedBy="poleVisite", cascade={"remove"})
     */
    private $inscriptionPoleVisites;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="integer")
     */
    private $nombreDePlace;


    public function __construct()
    {
        $this->inscriptionPoleVisites = new ArrayCollection();
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
    public function getEtatPolevisite()
    {
        return $this->etatPolevisite;
    }

    /**
     * @param mixed $etatPolevisite
     */
    public function setEtatPolevisite($etatPolevisite): void
    {
        $this->etatPolevisite = $etatPolevisite;
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
    public function getInscriptionPoleVisites()
    {
        return $this->inscriptionPoleVisites;
    }

    /**
     * @param mixed $inscriptionPoleVisites
     */
    public function setInscriptionPoleVisites($inscriptionPoleVisites): void
    {
        $this->inscriptionPoleVisites = $inscriptionPoleVisites;
    }






    public function checkIfInscrit(User $u): bool
    {
        return $this->inscriptionPoleVisites->exists(function($key, $inscriptionPoleVisite) use($u)
        {
            return ($inscriptionPoleVisite->getUser() == $u);
        });
    }


}
