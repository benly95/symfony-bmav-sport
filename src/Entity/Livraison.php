<?php

namespace App\Entity;

use App\Repository\LivraisonRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: LivraisonRepository::class)]
class Livraison
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank, Assert\Length(max: 255)]
    private ?string $transporteur = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank, Assert\Length(max: 255)]
    private ?string $modeDeLivraison = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(max: 255)]
    private ?string $informationLivraison = null;

    #[ORM\OneToOne(inversedBy: 'livraison', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Panier $panier = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotBlank, Assert\Valid]
    private ?Adresse $adresse = null;

    public function __construct(?Adresse $copieAdresse = null)
    {
        if ($copieAdresse instanceof Adresse) {
            $this->adresse = (new Adresse())->duplicate($copieAdresse);
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTransporteur(): ?string
    {
        return $this->transporteur;
    }

    public function setTransporteur(string $transporteur): self
    {
        $this->transporteur = $transporteur;

        return $this;
    }

    public function getModeDeLivraison(): ?string
    {
        return $this->modeDeLivraison;
    }

    public function setModeDeLivraison(string $modeDeLivraison): self
    {
        $this->modeDeLivraison = $modeDeLivraison;

        return $this;
    }

    public function getInformationLivraison(): ?string
    {
        return $this->informationLivraison;
    }

    public function setInformationLivraison(string $informationLivraison): self
    {
        $this->informationLivraison = $informationLivraison;

        return $this;
    }

    public function getPanier(): ?Panier
    {
        return $this->panier;
    }

    public function setPanier(Panier $panier): self
    {
        $this->panier = $panier;

        return $this;
    }

    public function getAdresse(): ?Adresse
    {
        return $this->adresse;
    }

    public function setAdresse(Adresse $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }
}
