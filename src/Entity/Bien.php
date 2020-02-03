<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BienRepository")
 */
class Bien
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
    private $superficie;

    /**
     * @ORM\Column(type="integer")
     */
    private $nb_pieces;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $type;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="boolean")
     */
    private $jardin;

    /**
     * @ORM\Column(type="boolean")
     */
    private $cave;

    /**
     * @ORM\Column(type="boolean")
     */
    private $cellier;

    /**
     * @ORM\Column(type="boolean")
     */
    private $loggia;

    /**
     * @ORM\Column(type="boolean")
     */
    private $terrasse;

    /**
     * @ORM\Column(type="boolean")
     */
    private $garage;

    /**
     * @ORM\Column(type="boolean")
     */
    private $verranda;

    /**
     * @ORM\Column(type="float")
     */
    private $prix_min;

    /**
     * @ORM\Column(type="float")
     */
    private $prix_vente;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Vendeur", inversedBy="no")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_vendeur;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Annonce", mappedBy="id_bien", cascade={"persist", "remove"})
     */
    private $annonce;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSuperficie(): ?float
    {
        return $this->superficie;
    }

    public function setSuperficie(float $superficie): self
    {
        $this->superficie = $superficie;

        return $this;
    }

    public function getNbPieces(): ?int
    {
        return $this->nb_pieces;
    }

    public function setNbPieces(int $nb_pieces): self
    {
        $this->nb_pieces = $nb_pieces;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getJardin(): ?bool
    {
        return $this->jardin;
    }

    public function setJardin(bool $jardin): self
    {
        $this->jardin = $jardin;

        return $this;
    }

    public function getCave(): ?bool
    {
        return $this->cave;
    }

    public function setCave(bool $cave): self
    {
        $this->cave = $cave;

        return $this;
    }

    public function getCellier(): ?bool
    {
        return $this->cellier;
    }

    public function setCellier(bool $cellier): self
    {
        $this->cellier = $cellier;

        return $this;
    }

    public function getLoggia(): ?bool
    {
        return $this->loggia;
    }

    public function setLoggia(bool $loggia): self
    {
        $this->loggia = $loggia;

        return $this;
    }

    public function getTerrasse(): ?bool
    {
        return $this->terrasse;
    }

    public function setTerrasse(bool $terrasse): self
    {
        $this->terrasse = $terrasse;

        return $this;
    }

    public function getGarage(): ?bool
    {
        return $this->garage;
    }

    public function setGarage(bool $garage): self
    {
        $this->garage = $garage;

        return $this;
    }

    public function getVerranda(): ?bool
    {
        return $this->verranda;
    }

    public function setVerranda(bool $verranda): self
    {
        $this->verranda = $verranda;

        return $this;
    }

    public function getPrixMin(): ?float
    {
        return $this->prix_min;
    }

    public function setPrixMin(float $prix_min): self
    {
        $this->prix_min = $prix_min;

        return $this;
    }

    public function getPrixVente(): ?float
    {
        return $this->prix_vente;
    }

    public function setPrixVente(float $prix_vente): self
    {
        $this->prix_vente = $prix_vente;

        return $this;
    }

    public function getIdVendeur(): ?Vendeur
    {
        return $this->id_vendeur;
    }

    public function setIdVendeur(?Vendeur $id_vendeur): self
    {
        $this->id_vendeur = $id_vendeur;

        return $this;
    }

    public function getAnnonce(): ?Annonce
    {
        return $this->annonce;
    }

    public function setAnnonce(Annonce $annonce): self
    {
        $this->annonce = $annonce;

        // set the owning side of the relation if necessary
        if ($annonce->getIdBien() !== $this) {
            $annonce->setIdBien($this);
        }

        return $this;
    }
}
