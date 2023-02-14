<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'produits')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Marque $Marque = null;

    #[ORM\ManyToOne(inversedBy: 'Produits')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Categorie $Categorie = null;

    #[ORM\ManyToOne(inversedBy: 'produits')]
    #[ORM\JoinColumn(nullable: true)]
    private ?categorieProduit $categorieProduit = null;

    #[ORM\OneToMany(mappedBy: 'Produit', targetEntity: VariantProduit::class)]
    private Collection $variantProduits;

    public function __construct()
    {
        $this->variantProduits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getMarque(): ?Marque
    {
        return $this->Marque;
    }

    public function setMarque(?Marque $Marque): self
    {
        $this->Marque = $Marque;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->Categorie;
    }

    public function setCategorie(?Categorie $Categorie): self
    {
        $this->Categorie = $Categorie;

        return $this;
    }

    public function getCategorieProduit(): ?categorieProduit
    {
        return $this->categorieProduit;
    }

    public function setCategorieProduit(?categorieProduit $categorieProduit): self
    {
        $this->categorieProduit = $categorieProduit;

        return $this;
    }

    /**
     * @return Collection<int, VariantProduit>
     */
    public function getVariantProduits(): Collection
    {
        return $this->variantProduits;
    }

    public function addVariantProduit(VariantProduit $variantProduit): self
    {
        if (!$this->variantProduits->contains($variantProduit)) {
            $this->variantProduits->add($variantProduit);
            $variantProduit->setProduit($this);
        }

        return $this;
    }

    public function removeVariantProduit(VariantProduit $variantProduit): self
    {
        if ($this->variantProduits->removeElement($variantProduit)) {
            // set the owning side to null (unless already changed)
            if ($variantProduit->getProduit() === $this) {
                $variantProduit->setProduit(null);
            }
        }

        return $this;
    }
}
