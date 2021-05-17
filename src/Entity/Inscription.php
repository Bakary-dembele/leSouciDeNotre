<?php

namespace App\Entity;

use App\Repository\InscriptionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InscriptionRepository::class)
 */
class Inscription
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Maraude", inversedBy="inscriptions")
     * ORM\JoinColumn(nullable=false)
     */
    private $maraude;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="inscriptions")
     * ORM\JoinColumn(nullable=false)
     */
    private $user;


    //Getter and Setter
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getDateInscription()
    {
        return $this->dateInscription;
    }

    /**
     * @param mixed $dateInscription
     */
    public function setDateInscription($dateInscription): void
    {
        $this->dateInscription = $dateInscription;
    }

    /**
     * @return mixed
     */
    public function getMaraude()
    {
        return $this->maraude;
    }

    /**
     * @param mixed $maraude
     */
    public function setMaraude($maraude): void
    {
        $this->maraude = $maraude;
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
