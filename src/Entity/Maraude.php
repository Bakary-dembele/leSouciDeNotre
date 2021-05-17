<?php

namespace App\Entity;

use App\Repository\MaraudeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=MaraudeRepository::class)
 */
class Maraude
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(message="Donnez au moins un nom à votre maraude..!")
     * @Assert\Length(max="30", maxMessage="Le nom ne doit pas excéder 30 caractères")
     * @ORM\Column(type="string", length=30)
     */
    private $nom;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="datetime")
     */
    private $dateDebut;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="integer")
     */
    private $duree;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="datetime")
     */
    private $dateCloture;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="integer")
     */
    private $nbInscriptionsMax;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=500)
     */
    private $descriptionInfos;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $etatMaraude;

    /**
     * @ORM\Column(type="string", length=250, nullable=true)
     */
    private $urlPhoto;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="maraudes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $organisateur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Groupe", inversedBy="maraudes")
     */
    private $groupe;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Etat", inversedBy="maraudes")
     */
    private $etat;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Inscription", mappedBy="maraude", cascade={"remove"})
     */
    private $inscriptions;

    /**
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="App\Entity\Lieu", inversedBy="maraudes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $lieu;

    public function __construct()
    {
        $this->inscriptions = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * @param mixed $dateDebut
     */
    public function setDateDebut($dateDebut): void
    {
        $this->dateDebut = $dateDebut;
    }

    /**
     * @return mixed
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * @param mixed $duree
     */
    public function setDuree($duree): void
    {
        $this->duree = $duree;
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
    public function setDateCloture( $dateCloture): void
    {
        $this->dateCloture = $dateCloture;
    }

    /**
     * @return mixed
     */
    public function getNbInscriptionsMax()
    {
        return $this->nbInscriptionsMax;
    }

    /**
     * @param mixed $nbInscriptionsMax
     */
    public function setNbInscriptionsMax($nbInscriptionsMax): void
    {
        $this->nbInscriptionsMax = $nbInscriptionsMax;
    }

    /**
     * @return mixed
     */
    public function getDescriptionInfos()
    {
        return $this->descriptionInfos;
    }

    /**
     * @param mixed $descriptionInfos
     */
    public function setDescriptionInfos($descriptionInfos): void
    {
        $this->descriptionInfos = $descriptionInfos;
    }

    /**
     * @return mixed
     */
    public function getEtatMaraude()
    {
        return $this->etatMaraude;
    }

    /**
     * @param mixed $etatMaraude
     */
    public function setEtatMaraude($etatMaraude): void
    {
        $this->etatMaraude = $etatMaraude;
    }


    /**
     * @return mixed
     */
    public function getUrlPhoto()
    {
        return $this->urlPhoto;
    }

    /**
     * @param mixed $urlPhoto
     */
    public function setUrlPhoto($urlPhoto): void
    {
        $this->urlPhoto = $urlPhoto;
    }

    /**
     * @return mixed
     */
    public function getOrganisateur()
    {
        return $this->organisateur;
    }

    /**
     * @param mixed $organisateur
     */
    public function setOrganisateur($organisateur): void
    {
        $this->organisateur = $organisateur;
    }

    /**
     * @return mixed
     */
    public function getGroupe()
    {
        return $this->groupe;
    }

    /**
     * @param mixed $groupe
     */
    public function setGroupe($groupe): void
    {
        $this->groupe = $groupe;
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


    public function getInscriptions()
    {
        return $this->inscriptions;
    }

    public function setInscriptions($inscriptions): void
    {
        $this->inscriptions = $inscriptions;
    }

    /**
     * @return mixed
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * @param mixed $lieu
     */
    public function setLieu($lieu): void
    {
        $this->lieu = $lieu;
    }

    public function checkIfInscrit(User $u): bool
    {
        return $this->inscriptions->exists(function($key, $inscription) use($u)
        {
            return ($inscription->getUser() == $u);
        });
    }


    public function getRoles()
    {
    }

    public function getPassword()
    {
    }

    public function getSalt()
    {

    }

    //public function getUsername()
    //{
        //return $this->getUsername();
    //}

    public function eraseCredentials()
    {
    }
}
