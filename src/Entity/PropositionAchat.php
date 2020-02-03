<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PropositionAchatRepository")
 */
class PropositionAchat
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Utilisateur", inversedBy="propositionAchats")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_utilisateur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Annonce", inversedBy="propositionAchats")
     */
    private $id_annonce;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ContreProposition", mappedBy="id_proposition_achat", orphanRemoval=true)
     */
    private $contrePropositions;

    public function __construct()
    {
        $this->contrePropositions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getIdUtilisateur(): ?Utilisateur
    {
        return $this->id_utilisateur;
    }

    public function setIdUtilisateur(?Utilisateur $id_utilisateur): self
    {
        $this->id_utilisateur = $id_utilisateur;

        return $this;
    }

    public function getIdAnnonce(): ?Annonce
    {
        return $this->id_annonce;
    }

    public function setIdAnnonce(?Annonce $id_annonce): self
    {
        $this->id_annonce = $id_annonce;

        return $this;
    }

    /**
     * @return Collection|ContreProposition[]
     */
    public function getContrePropositions(): Collection
    {
        return $this->contrePropositions;
    }

    public function addContreProposition(ContreProposition $contreProposition): self
    {
        if (!$this->contrePropositions->contains($contreProposition)) {
            $this->contrePropositions[] = $contreProposition;
            $contreProposition->setIdPropositionAchat($this);
        }

        return $this;
    }

    public function removeContreProposition(ContreProposition $contreProposition): self
    {
        if ($this->contrePropositions->contains($contreProposition)) {
            $this->contrePropositions->removeElement($contreProposition);
            // set the owning side to null (unless already changed)
            if ($contreProposition->getIdPropositionAchat() === $this) {
                $contreProposition->setIdPropositionAchat(null);
            }
        }

        return $this;
    }
}
