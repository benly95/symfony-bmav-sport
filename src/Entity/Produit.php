<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank, Assert\Length(max: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(max: 255)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'produits')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotBlank]
    private ?Marque $Marque = null;

    #[ORM\ManyToOne(inversedBy: 'Produits')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Categorie $Categorie = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\ManyToOne(inversedBy: 'produits')]
    #[ORM\JoinColumn(nullable: true)]
    private ?CategorieProduit $categorieProduit = null;

    #[ORM\OneToMany(mappedBy: 'Produit', targetEntity: VariantProduit::class, cascade: ['persist', 'remove'])]
    #[Assert\Valid, Assert\Count(min:1, minMessage: "Vous devez ajouter au moins une variante")]
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

    public function getCategorieProduit(): ?CategorieProduit
    {
        return $this->categorieProduit;
    }

    public function setCategorieProduit(?CategorieProduit $categorieProduit): self
    {
        $this->categorieProduit = $categorieProduit;

        return $this;
    }

    public function hasManyVariantProduits() :bool
    {
        return $this->variantProduits->count() > 1;
    }

    public function getFistVariantProduit() :VariantProduit
    {
        return $this->variantProduits->first();
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

    public function getImage() :?string
    {
        return $this->image;
    }

    public function setImage(?string $image) :self
    {
        if (!empty($this->image) && strpos($image, 'images/Produit/') === false) {
            $image = 'images/Produit/'.$image;
        }
        $this->image = $image;

        return $this;
    }

    public function getMinPrice() :?int
    {
        $min = null;
        foreach ($this->variantProduits as $variantProduits) {
            /** @var VariantProduit $variantProduits */
            if ($variantProduits->getPrix() < $min || $min === null ) {
                $min = $variantProduits->getPrix();
            }
        }
        return $min;
    }

    public function getTailles() : array
    {
        $list = [];
        foreach ($this->variantProduits as $variantProduits) {
            /** @var VariantProduit $variantProduits */
            if (!empty($variantProduits->getTaille())) {
                $list[] = $variantProduits->getTaille();
            }
        }
        return array_unique($list);
    }

    public function hasTaille() : bool
    {
        return count($this->getTailles()) > 0;
    }

    public function getCouleurs() : array
    {
        $list = [];
        foreach ($this->variantProduits as $variantProduits) {
            /** @var VariantProduit $variantProduits */
            if (!empty($variantProduits->getCouleur())) {
                $list[] = $variantProduits->getCouleur();
            }
        }
        return array_unique($list);
    }

    public function hasCouleur() : bool
    {
        return count($this->getCouleurs()) > 0;
    }

}
