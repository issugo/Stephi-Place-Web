<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UtilisateurRepository")
 */
class Utilisateur
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $email;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $addresse;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $string;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Vendeur", mappedBy="id_utilisateur", cascade={"persist", "remove"})
     */
    private $vendeur;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Favori", mappedBy="id_utilisateur")
     */
    private $favoris;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PropositionAchat", mappedBy="id_utilisateur", orphanRemoval=true)
     */
    private $propositionAchats;

    public function __construct()
    {
        $this->favoris = new ArrayCollection();
        $this->propositionAchats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getAddresse(): ?string
    {
        return $this->addresse;
    }

    public function setAddresse(?string $addresse): self
    {
        $this->addresse = $addresse;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getString(): ?string
    {
        return $this->string;
    }

    public function setString(string $string): self
    {
        $this->string = $string;

        return $this;
    }

    public function getVendeur(): ?Vendeur
    {
        return $this->vendeur;
    }

    public function setVendeur(Vendeur $vendeur): self
    {
        $this->vendeur = $vendeur;

        // set the owning side of the relation if necessary
        if ($vendeur->getIdUtilisateur() !== $this) {
            $vendeur->setIdUtilisateur($this);
        }

        return $this;
    }

    /**
     * @return Collection|Favori[]
     */
    public function getFavoris(): Collection
    {
        return $this->favoris;
    }

    public function addFavori(Favori $favori): self
    {
        if (!$this->favoris->contains($favori)) {
            $this->favoris[] = $favori;
            $favori->addIdUtilisateur($this);
        }

        return $this;
    }

    public function removeFavori(Favori $favori): self
    {
        if ($this->favoris->contains($favori)) {
            $this->favoris->removeElement($favori);
            $favori->removeIdUtilisateur($this);
        }

        return $this;
    }

    /**
     * @return Collection|PropositionAchat[]
     */
    public function getPropositionAchats(): Collection
    {
        return $this->propositionAchats;
    }

    public function addPropositionAchat(PropositionAchat $propositionAchat): self
    {
        if (!$this->propositionAchats->contains($propositionAchat)) {
            $this->propositionAchats[] = $propositionAchat;
            $propositionAchat->setIdUtilisateur($this);
        }

        return $this;
    }

    public function removePropositionAchat(PropositionAchat $propositionAchat): self
    {
        if ($this->propositionAchats->contains($propositionAchat)) {
            $this->propositionAchats->removeElement($propositionAchat);
            // set the owning side to null (unless already changed)
            if ($propositionAchat->getIdUtilisateur() === $this) {
                $propositionAchat->setIdUtilisateur(null);
            }
        }

        return $this;
    }
}
