<?php

namespace App\Entity;

use App\Repository\PanierItemRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PanierItemRepository::class)]
class PanierItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(options:[ "default"=> 1])]
    private int $quantite = 0;

    #[ORM\Column(options:[ "default"=> 0])]
    private int $prixUnitaire = 0;


    public function __construct(
        #[ORM\ManyToOne()]
        #[ORM\JoinColumn(nullable: false)]
        private VariantProduit $variantProduit,
        #[ORM\ManyToOne(inversedBy: 'panierItems')]
        #[ORM\JoinColumn(nullable: false)]
        private Panier $panier
    )
    {
        $this->panier->addPanierItem($this);
        $this->quantite = 0;
        $this->prixUnitaire = $this->variantProduit->getPrix();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;
        if ($this->panier instanceof Panier) {
            $this->panier->calculetteTotal();
        }

        return $this;
    }

    public function addQuantite(int $quantite): self
    {
        $this->quantite += $quantite;
        if ($this->panier instanceof Panier) {
            $this->panier->calculetteTotal();
        }

        return $this;
    }

    
    public function getPrixUnitaire() :int
    {
        return $this->prixUnitaire;
    }

    public function getPanier() : Panier
    {
        return $this->panier;
    }

    public function getVariantProduit(): VariantProduit
    {
        return $this->variantProduit;
    }

    public function getProduit(): Produit
    {
        return $this->variantProduit->getProduit();
    }

    public function getMarque(): Marque
    {
        return $this->variantProduit->getProduit()->getMarque();
    }

    public function getTotal() :int
    {
        return  $this->getQuantite() * $this->getPrixUnitaire();
    }
}
