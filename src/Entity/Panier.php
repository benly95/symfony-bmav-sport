<?php

namespace App\Entity;

use App\Repository\PanierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PanierRepository::class)]
class Panier
{
    CONST STATUS_PANIER = 'en cours';
    CONST STATUS_PAYER = 'payer';
    CONST STATUS_EXPEDIER = 'expedier';
    CONST STATUS_ANNULER = 'annuler';
    

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateDeCommande = null;

    #[ORM\Column(options:[ "default"=> 0])]
    private ?int $total = 0;

    #[ORM\Column(length: 255)]
    private ?string $status = self::STATUS_PANIER;

    #[ORM\OneToOne(mappedBy: 'panier', cascade: ['persist', 'remove'])]
    private ?Livraison $livraison = null;

    #[ORM\OneToOne(mappedBy: 'panier', cascade: ['persist', 'remove'])]
    private ?Paiement $paiement = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: true)]
    private ?Adresse $adresseDeFacture = null;

    #[ORM\ManyToOne(inversedBy: 'paniers', cascade: ['persist'])]
    private ?Client $client = null;

    #[ORM\OneToMany(mappedBy: 'panier', targetEntity: PanierItem::class, orphanRemoval: true, cascade: ['persist', 'remove'])]
    private Collection $panierItems;

    public function __construct()
    {
        // recupere la variable
        $this->panierItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDeCommande(): ?\DateTimeInterface
    {
        return $this->dateDeCommande;
    }

    public function setDateDeCommande(\DateTimeInterface $dateDeCommande): self
    {
        $this->dateDeCommande = $dateDeCommande;

        return $this;
    }

    public function getTotal(): ?int
    {
        return $this->total;
    }
    public function getTotalHT(): ?int
    {
        return $this->total*0.8;
    }

    public function setTotal(int $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;
        if ($status === self::STATUS_PAYER) {
            $this->dateDeCommande = new \DateTime();
        }

        return $this;
    }

    public function getLivraison(): ?Livraison
    {
        return $this->livraison;
    }

    public function setLivraison(Livraison $livraison): self
    {
        // set the owning side of the relation if necessary
        if ($livraison->getPanier() !== $this) {
            $livraison->setPanier($this);
        }

        $this->livraison = $livraison;

        return $this;
    }

    public function createLivraison() :self
    {
        $livraison = new Livraison();

        $this->setLivraison($livraison);
        return $this;
    }

    public function getAdresseDeFacture(): ?Adresse
    {
        return $this->adresseDeFacture;
    }

    public function setAdresseDeFacture(Adresse $adresseDeFacture): self
    {
        $this->adresseDeFacture = $adresseDeFacture;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return Collection<int, PanierItem>
     */
    public function getPanierItems(): Collection
    {
        return $this->panierItems;
    }

    public function calculetteTotal() :void
    {
        $total = 0;
        /** @var PanierItem $panierItem */
        foreach ($this->panierItems as $panierItem) {
            $total = $total + $panierItem->getTotal();
        }
        $this->total = $total;
    }


    public function addPanierItem(PanierItem $panierItem): self
    {
        if (!$this->panierItems->contains($panierItem)) {
            $this->panierItems->add($panierItem);
            $this->calculetteTotal();
        }

        return $this;
    }

    public function removePanierItem(PanierItem $panierItem): self
    {
        if ($this->panierItems->removeElement($panierItem)) {
            // set the owning side to null (unless already changed)
            if ($panierItem->getPanier() === $this) {
                $this->calculetteTotal();
            }
        }

        return $this;
    }

    public function getPaiement(): ?Paiement
    {
        return $this->paiement;
    }

    public function setPaiement(Paiement $paiement): self
    {
        $paiement->setPanier($this);
        $this->paiement = $paiement;
        return  $this;
    }


}
?>