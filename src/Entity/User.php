<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="Il existe déjà un compte avec cet e-mail")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
/*
    /**
     * @ORM\Column(type="string", length=30, unique=true)
     */
    //private $pseudo;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=180)
     * @Assert\NotBlank()
     */
    private $email;

    /**
     * @var string The hashed password
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="3", max="100")
     */
    private $password;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $administrateur;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $actif;

    //LES RALATIONS
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Groupe", inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     */
    private $groupe;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Inscription", mappedBy="user", cascade={"remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $inscriptions;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Maraude", mappedBy="organisateur", cascade={"remove"})
     */
    private $maraudes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Collecte", mappedBy="referent", cascade={"remove"})
     */
    private $collectes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\InscriptionCollecte", mappedBy="user", cascade={"remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $inscriptionCollectes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PoleJeunesse", mappedBy="referent", cascade={"remove"})
     */
    private $poleJeunesses;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\InscriptionPoleJeunesse", mappedBy="user", cascade={"remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $inscriptionPoleJeunesses;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PoleVisite", mappedBy="referent", cascade={"remove"})
     */
    private $poleVisites;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\InscriptionPoleVisite", mappedBy="user", cascade={"remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $inscriptionPoleVisites;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Csm", mappedBy="referent", cascade={"remove"})
     */
    private $csms;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\InscriptionCsm", mappedBy="user", cascade={"remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $inscriptionCsms;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Evenement", mappedBy="user", cascade={"remove"})
     */
     private $evenements;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EvenementFoot", mappedBy="user", cascade={"remove"})
     */
    private $evenementFoots;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $activation_token;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $reset_token;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isVerified = false;


    public function __construct()
    {
        $this->inscriptions = new ArrayCollection();
        $this->inscriptionCollectes = new ArrayCollection();
        $this->inscriptionPoleJeunesses = new ArrayCollection();
        $this->inscriptionPoleVisites = new ArrayCollection();
        $this->inscriptionCsms = new ArrayCollection();
    }


    //Getter an Setter
    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }


    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /*/**
     * @return mixed
     */
   /* public function getPseudo()
    {
        return $this->pseudo;
    }*/

   /* /**
     * @param mixed $pseudo
     */
   /* public function setPseudo($pseudo): void
    {
        $this->pseudo = $pseudo;
    }
*/



    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }


    public function getAdministrateur(): ?bool
    {
        return $this->administrateur;
    }

    public function setAdministrateur(bool $administrateur): self
    {
        $this->administrateur = $administrateur;

        return $this;
    }

    public function getActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(bool $actif): self
    {
        $this->actif = $actif;

        return $this;
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
     * @return ArrayCollection
     */
    public function getInscriptions(): ArrayCollection
    {
        return $this->inscriptions;
    }

    /**
     * @param ArrayCollection $inscriptions
     */
    public function setInscriptions(ArrayCollection $inscriptions): void
    {
        $this->inscriptions = $inscriptions;
    }

    public function addInscription(Inscription $inscription): self
    {
        if (!$this->inscriptions->contains($inscription)) {
            $this->inscriptions[] = $inscription;
            $inscription->setUser($this);
        }

        return $this;
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

    public function addInscriptionCollecte(InscriptionCollecte $inscriptionCollecte): self
    {
        if (!$this->inscriptionCollectes->contains($inscriptionCollecte)) {
            $this->inscriptionCollectes[] = $inscriptionCollecte;
            $inscriptionCollecte->setUser($this);
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getInscriptionPoleJeunesses()
    {
        return $this->inscriptionPoleJeunesses;
    }

    /**
     * @param mixed $inscriptionPoleJeunesses
     */
    public function setInscriptionPoleJeunesses($inscriptionPoleJeunesses): void
    {
        $this->inscriptionPoleJeunesses = $inscriptionPoleJeunesses;
    }

    public function addInscriptionPoleJeunesse(InscriptionPoleJeunesse $inscriptionPoleJeunesse): self
    {
        if (!$this->inscriptionPoleJeunesses->contains($inscriptionPoleJeunesse)) {
            $this->inscriptionPoleJeunesses[] = $inscriptionPoleJeunesse;
            $inscriptionPoleJeunesse->setUser($this);
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPoleVisites()
    {
        return $this->poleVisites;
    }

    /**
     * @param mixed $poleVisites
     */
    public function setPoleVisites($poleVisites): void
    {
        $this->poleVisites = $poleVisites;
    }

    public function addInscriptionPoleVisite(InscriptionPoleVisite $inscriptionPoleVisite): self
    {
        if (!$this->inscriptionPoleVisites->contains($inscriptionPoleVisite)) {
            $this->inscriptionPoleVisites[] = $inscriptionPoleVisite;
            $inscriptionPoleVisite->setUser($this);
        }

        return $this;
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


    public function addInscriptionCsm(InscriptionCsm $inscriptionCsm): self
    {
        if (!$this->inscriptionCsms->contains($inscriptionCsm)) {
            $this->inscriptionCsms[] = $inscriptionCsm;
            $inscriptionCsm->setUser($this);
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getInscriptionCsms()
    {
        return $this->inscriptionCsms;
    }

    /**
     * @param mixed $inscriptionCsms
     */
    public function setInscriptionCsms($inscriptionCsms): void
    {
        $this->inscriptionCsms = $inscriptionCsms;
    }



    /**
     * @return mixed
     */
    public function getCsms()
    {
        return $this->csms;
    }

    /**
     * @param mixed $csms
     */
    public function setCsms($csms): void
    {
        $this->csms = $csms;
    }







    /**
     * @return mixed
     */
    public function getMaraudes()
    {
        return $this->maraudes;
    }

    /**
     * @param mixed $maraudes
     */
    public function setMaraudes($maraudes): void
    {
        $this->maraudes = $maraudes;
    }



    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getActivationToken(): ?string
    {
        return $this->activation_token;
    }

    public function setActivationToken(?string $activation_token): self
    {
        $this->activation_token = $activation_token;

        return $this;
    }

    public function getResetToken(): ?string
    {
        return $this->reset_token;
    }

    public function setResetToken(?string $reset_token): self
    {
        $this->reset_token = $reset_token;

        return $this;
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
     * @return mixed
     */
    public function getEvenements()
    {
        return $this->evenements;
    }

    /**
     * @param mixed $evenements
     */
    public function setEvenements($evenements): void
    {
        $this->evenements = $evenements;
    }

    /**
     * @return mixed
     */
    public function getEvenementFoots()
    {
        return $this->evenementFoots;
    }

    /**
     * @param mixed $evenementFoots
     */
    public function setEvenementFoots($evenementFoots): void
    {
        $this->evenementFoots = $evenementFoots;
    }






    public function __toString(){
        return $this->getUsername();
    }

    public function setUser(?UserInterface $user)
    {
    }


}
