<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContrePropositionRepository")
 */
class ContreProposition
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
     * @ORM\ManyToOne(targetEntity="App\Entity\PropositionAchat", inversedBy="contrePropositions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_proposition_achat;

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

    public function getIdPropositionAchat(): ?PropositionAchat
    {
        return $this->id_proposition_achat;
    }

    public function setIdPropositionAchat(?PropositionAchat $id_proposition_achat): self
    {
        $this->id_proposition_achat = $id_proposition_achat;

        return $this;
    }
}
