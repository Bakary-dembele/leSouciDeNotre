<?php

namespace App\Entity;

use App\Repository\EtatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EtatRepository::class)
 */
class Etat
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
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Maraude", mappedBy="etat", cascade={"remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $maraudes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Collecte", mappedBy="etat", cascade={"remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $collectes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PoleJeunesse", mappedBy="etat", cascade={"remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $poleJeunesses;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PoleVisite", mappedBy="etat", cascade={"remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $poleVisites;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Csm", mappedBy="etat", cascade={"remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $csms;


    public function __construct()
    {
        $this->maraudes = new ArrayCollection();
        $this->collectes = new ArrayCollection();
        $this->poleJeunesses = new ArrayCollection();
        $this->poleVisites = new ArrayCollection();
        $this->csms = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
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

    /**
     * @return mixed
     */
    public function getCollectes()
    {
        return $this->collectes;
    }

    /**
     * @param mixed $collectes
     */
    public function setCollectes($collectes): void
    {
        $this->collectes = $collectes;
    }

    /**
     * @return mixed
     */
    public function getPoleJeunesses()
    {
        return $this->poleJeunesses;
    }

    /**
     * @param mixed $poleJeunesses
     */
    public function setPoleJeunesses($poleJeunesses): void
    {
        $this->poleJeunesses = $poleJeunesses;
    }

    /**
     * @return ArrayCollection
     */
    public function getPoleVisites(): ArrayCollection
    {
        return $this->poleVisites;
    }

    /**
     * @param ArrayCollection $poleVisites
     */
    public function setPoleVisites(ArrayCollection $poleVisites): void
    {
        $this->poleVisites = $poleVisites;
    }

    /**
     * @return ArrayCollection
     */
    public function getCsms(): ArrayCollection
    {
        return $this->csms;
    }

    /**
     * @param ArrayCollection $csms
     */
    public function setCsms(ArrayCollection $csms): void
    {
        $this->csms = $csms;
    }





    /**
     * toString
     * @return string
     */
    public function __toString(){
        return $this->getLibelle();
    }


}
