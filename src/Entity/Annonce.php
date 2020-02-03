<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AnnonceRepository")
 */
class Annonce
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Bien", inversedBy="annonce", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_bien;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Agent", inversedBy="annonces")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_agent;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Favori", mappedBy="id_annonce")
     */
    private $favoris;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PropositionAchat", mappedBy="id_annonce")
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

    public function getIdBien(): ?Bien
    {
        return $this->id_bien;
    }

    public function setIdBien(Bien $id_bien): self
    {
        $this->id_bien = $id_bien;

        return $this;
    }

    public function getIdAgent(): ?Agent
    {
        return $this->id_agent;
    }

    public function setIdAgent(?Agent $id_agent): self
    {
        $this->id_agent = $id_agent;

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
            $favori->addIdAnnonce($this);
        }

        return $this;
    }

    public function removeFavori(Favori $favori): self
    {
        if ($this->favoris->contains($favori)) {
            $this->favoris->removeElement($favori);
            $favori->removeIdAnnonce($this);
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
            $propositionAchat->setIdAnnonce($this);
        }

        return $this;
    }

    public function removePropositionAchat(PropositionAchat $propositionAchat): self
    {
        if ($this->propositionAchats->contains($propositionAchat)) {
            $this->propositionAchats->removeElement($propositionAchat);
            // set the owning side to null (unless already changed)
            if ($propositionAchat->getIdAnnonce() === $this) {
                $propositionAchat->setIdAnnonce(null);
            }
        }

        return $this;
    }
}
