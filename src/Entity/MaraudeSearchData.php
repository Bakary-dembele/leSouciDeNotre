<?php


namespace App\Entity;

use Symfony\Component\Validator\Constraints\DateTime;


class MaraudeSearchData
{
    /**
     * @var string | null
     */
    private $nomGroupe = '';

    /**
     * @var string | null
     */
    private $motCle = '';

    /**
     * @var datetime
     */
    private $dateDebutSearch;

    /**
     * @var datetime
     */
    private $dateFinSearch;

    /**
     * @var boolean
     */
    private $maraudeOrganisateur = false;

    /**
     * @var boolean
     */
    private $maraudeInscrit = false;
    /**
     * @var boolean
     */
    private $maraudeNonInscrit = false;
    /**
     * @var boolean
     */
    private $maraudePassees = false;

    /**
     * @return string|null
     */
    public function getNomGroupe(): ?string
    {
        return $this->nomGroupe;
    }

    /**
     * @param string|null $nomGroupe
     */
    public function setNomGroupe(?string $nomGroupe): void
    {
        $this->nomGroupe = $nomGroupe;
    }


    /**
     * @return string|null
     */
    public function getMotCle(): ?string
    {
        return $this->motCle;
    }

    /**
     * @param string|null $motCle
     */
    public function setMotCle(?string $motCle): void
    {
        $this->motCle = $motCle;
    }

    /**
     * @return mixed
     */
    public function getDateDebutSearch()
    {
        return $this->dateDebutSearch;
    }

    /**
     * @param mixed $dateDebutSearch
     */
    public function setDateDebutSearch($dateDebutSearch): void
    {
        $this->dateDebutSearch = $dateDebutSearch;
    }

    /**
     * @return mixed
     */
    public function getDateFinSearch()
    {
        return $this->dateFinSearch;
    }

    /**
     * @param mixed $dateFinSearch
     */
    public function setDateFinSearch($dateFinSearch): void
    {
        $this->dateFinSearch = $dateFinSearch;
    }

    /**
     * @return bool
     */
    public function isMaraudeOrganisateur(): bool
    {
        return $this->maraudeOrganisateur;
    }

    /**
     * @param bool $maraudeOrganisateur
     */
    public function setMaraudeOrganisateur(bool $maraudeOrganisateur): void
    {
        $this->maraudeOrganisateur = $maraudeOrganisateur;
    }

    /**
     * @return bool
     */
    public function isMaraudeInscrit(): bool
    {
        return $this->maraudeInscrit;
    }

    /**
     * @param bool $maraudeInscrit
     */
    public function setMaraudeInscrit(bool $maraudeInscrit): void
    {
        $this->maraudeInscrit = $maraudeInscrit;
    }

    /**
     * @return bool
     */
    public function isMaraudeNonInscrit(): bool
    {
        return $this->maraudeNonInscrit;
    }

    /**
     * @param bool $maraudeNonInscrit
     */
    public function setMaraudeNonInscrit(bool $maraudeNonInscrit): void
    {
        $this->maraudeNonInscrit = $maraudeNonInscrit;
    }

    /**
     * @return bool
     */
    public function isMaraudePassees(): bool
    {
        return $this->maraudePassees;
    }

    /**
     * @param bool $maraudePassees
     */
    public function setMaraudePassees(bool $maraudePassees): void
    {
        $this->maraudePassees = $maraudePassees;
    }


}