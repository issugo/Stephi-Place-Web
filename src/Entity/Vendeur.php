<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VendeurRepository")
 */
class Vendeur
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Utilisateur", inversedBy="no", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_utilisateur;

    /**
     * @ORM\Column(type="blob")
     */
    private $carte_identite;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Bien", mappedBy="id_vendeur", orphanRemoval=true)
     */
    private $biens;

    public function __construct()
    {
        $this->no = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUtilisateur(): ?Utilisateur
    {
        return $this->id_utilisateur;
    }

    public function setIdUtilisateur(Utilisateur $id_utilisateur): self
    {
        $this->id_utilisateur = $id_utilisateur;

        return $this;
    }

    public function getCarteIdentite()
    {
        return $this->carte_identite;
    }

    public function setCarteIdentite($carte_identite): self
    {
        $this->carte_identite = $carte_identite;

        return $this;
    }

    /**
     * @return Collection|Bien[]
     */
    public function getBiens(): Collection
    {
        return $this->biens;
    }

    public function addBiens(Bien $biens): self
    {
        if (!$this->biens->contains($biens)) {
            $this->biens[] = $biens;
            $biens->setIdVendeur($this);
        }

        return $this;
    }

    public function removeBiens(Bien $biens): self
    {
        if ($this->biens->contains($biens)) {
            $this->biens->removeElement($biens);
            // set the owning side to null (unless already changed)
            if ($biens->getIdVendeur() === $this) {
                $biens->setIdVendeur(null);
            }
        }

        return $this;
    }
}
