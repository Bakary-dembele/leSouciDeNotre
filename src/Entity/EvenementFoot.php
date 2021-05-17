<?php

namespace App\Entity;

use App\Repository\EvenementFootRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=EvenementFootRepository::class)
 */
class EvenementFoot
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", nullable=true)
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=30)
     */
    private $titre;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="text")
     */
    private $descriptif;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $prix;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="text")
     */
    private $details;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="time")
     */
    private $heureDebut;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="time")
     */
    private $heureFin;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="evenementFoots")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\InscriptionEvenementFoot", mappedBy="evenementFoot", cascade={"remove"})
     */
    private $inscriptionEnvenementFoots;


    public function __construct()
    {
        $this->inscriptionEnvenementFoots = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescriptif(): ?string
    {
        return $this->descriptif;
    }

    public function setDescriptif(string $descriptif): self
    {
        $this->descriptif = $descriptif;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(?int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
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

    public function getDetails(): ?string
    {
        return $this->details;
    }

    public function setDetails(?string $details): self
    {
        $this->details = $details;

        return $this;
    }

    public function getHeureDebut(): ?\DateTimeInterface
    {
        return $this->heureDebut;
    }

    public function setHeureDebut(\DateTimeInterface $heureDebut): self
    {
        $this->heureDebut = $heureDebut;

        return $this;
    }

    public function getHeureFin(): ?\DateTimeInterface
    {
        return $this->heureFin;
    }

    public function setHeureFin(\DateTimeInterface $heureFin): self
    {
        $this->heureFin = $heureFin;

        return $this;
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

    /**
     * @return mixed
     */
    public function getInscriptionEnvenementFoots()
    {
        return $this->inscriptionEnvenementFoots;
    }

    /**
     * @param mixed $inscriptionEnvenementFoots
     */
    public function setInscriptionEnvenementFoots($inscriptionEnvenementFoots): void
    {
        $this->inscriptionEnvenementFoots = $inscriptionEnvenementFoots;
    }




}
