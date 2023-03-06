<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Marque;
use App\Repository\CategorieProduitRepository;
use App\Repository\CategorieRepository;
use App\Repository\MarqueRepository;
use App\Repository\ProduitRepository;
use App\Repository\VariantProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    
    
    #[Route('/ajout-panier', name: 'ajout_panier')]
    public function AjoutPanierAction (Resquest $resquest): Response
    {
        $id = $resquest->get("id");
        $qt = $resquest->get("qt",1); 
    }
}