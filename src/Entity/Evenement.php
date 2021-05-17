<?php

namespace App\Entity;

use App\Repository\EvenementRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass=EvenementRepository::class)
 */
class Evenement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=30)
     */
    private $titre;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(min="10")
     * @ORM\Column(type="text", length=500)
     */
    private $descriptif;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $prix;

    /**
     * @Assert\NotBlank()
     * @Assert\DateTime
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="text", length=500)
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
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="evenements")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Inscrire", mappedBy="evenement", cascade={"remove"})
     */
    private $inscris;



    public function getId(): ?int
    {
        return $this->id;
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

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(?string $prix): self
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

    /**
     * @return mixed
     */
    public function getHeureDebut()
    {
        return $this->heureDebut;
    }

    /**
     * @param mixed $heureDebut
     */
    public function setHeureDebut($heureDebut): void
    {
        $this->heureDebut = $heureDebut;
    }

    /**
     * @return mixed
     */
    public function getHeureFin()
    {
        return $this->heureFin;
    }

    /**
     * @param mixed $heureFin
     */
    public function setHeureFin($heureFin): void
    {
        $this->heureFin = $heureFin;
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
        $this->users = $user;
    }



    /**
     * toString
     * @return string
     */
    public function __toString(){
        return (string) $this->getUser();

    }

    /**
     * @return mixed
     */
    public function getInscris()
    {
        return $this->inscris;
    }

    /**
     * @param mixed $inscris
     */
    public function setInscris($inscris): void
    {
        $this->inscris = $inscris;
    }

    /**
     * @return mixed
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param mixed $titre
     */
    public function setTitre($titre): void
    {
        $this->titre = $titre;
    }

    /**
     * @return mixed
     */
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * @param mixed $details
     */
    public function setDetails($details): void
    {
        $this->details = $details;
    }





}
