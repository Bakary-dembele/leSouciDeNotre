<?php

namespace App\Entity;

use App\Repository\CollecteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CollecteRepository::class)
 */
class Collecte
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
    private $etatCollecte;


    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="collectes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $referent;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Etat", inversedBy="collectes")
     */
    private $etat;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\InscriptionCollecte", mappedBy="collecte", cascade={"remove"})
     */
    private $inscriptionCollectes;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="integer")
     */
    private $nombreDePlace;


    public function __construct()
    {
        $this->inscriptionCollectes = new ArrayCollection();
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
    public function getEtatCollecte()
    {
        return $this->etatCollecte;
    }

    /**
     * @param mixed $etatCollecte
     */
    public function setEtatCollecte($etatCollecte): void
    {
        $this->etatCollecte = $etatCollecte;
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
    public function getInscriptionCollectes()
    {
        return $this->inscriptionCollectes;
    }

    /**
     * @param mixed $inscriptionCollectes
     */
    public function setInscriptionCollectes($inscriptionCollectes): void
    {
        $this->inscriptionCollectes = $inscriptionCollectes;
    }


    public function checkIfInscrit(User $u): bool
    {
        return $this->inscriptionCollectes->exists(function($key, $inscriptionCollecte) use($u)
        {
            return ($inscriptionCollecte->getUser() == $u);
        });
    }




}
