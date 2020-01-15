<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LigneCommandeRepository")
 */
class LigneCommande
{
    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="App\Entity\Commande", inversedBy="ligneCommandes")
     */
    private $Commande;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="App\Entity\Produit", inversedBy="ligneCommandes")
     */
    private $Produit;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdArticle(): ?string
    {
        return $this->id_article;
    }

    public function setIdArticle(string $id_article): self
    {
        $this->id_article = $id_article;

        return $this;
    }

    public function getIdCommande(): ?string
    {
        return $this->id_commande;
    }

    public function setIdCommande(string $id_commande): self
    {
        $this->id_commande = $id_commande;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
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

    public function getCommande(): ?Commande
    {
        return $this->Commande;
    }

    public function setCommande(?Commande $Commande): self
    {
        $this->Commande = $Commande;

        return $this;
    }

    public function getProduit(): ?Produit
    {
        return $this->Produit;
    }

    public function setProduit(?Produit $Produit): self
    {
        $this->Produit = $Produit;

        return $this;
    }
}
