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

class FrontHomeController extends AbstractController
{

    public function __construct(
        private CategorieRepository $categorieRepository,
        private CategorieProduitRepository $categorieProduitRepository,
        private ProduitRepository $produitRepository,
        private VariantProduitRepository $variantProduitRepository,
        private MarqueRepository $marqueRepository
    )
    {}

    #[Route('/', name: 'app_front')]
    public function index(Request $request): Response
    {
        
        $categories = $this->categorieRepository->findAll();
        dump($categories);

        $marques = $this->marqueRepository->findAll();
        dump($marques);
        
        $response = $this->render('front_home/index.html.twig', [
            'controller_name' => 'FrontHomeController',
            'categories'      => $categories,
            'marques'         => $marques
        ]);

        return $response;
    }

    #[route('/toto')]
    public function a(): Response
    {
        return new Response('toto');
    }

    #[route('/categorie', name: 'app_categorie')]
    public function categorie(Request $request): Response 
    {
        dump($request);

        $id = $request->get('id');
        dump($id);
        
        $categorie = $this->categorieRepository->find($id);
        $categorieProduits = $this->categorieProduitRepository->findWithProductForCategorie($categorie);
        dump($categorie);
        $html =  $this->renderView('front_home/categorie.html.twig',[
            "categorie" => $categorie,
            "categoriesproduits" => $categorieProduits
        ]);
        dump($html);
        $response = new Response($html);
        dump($response);
        
        return $response;
    }

    #[route('/categorieProduit' , name: 'app_categorieProduit')]
    
    public function categorieproduit(Request $request): Response 
    {   
        $id = $request->get('id');
        $categorie_id = $request->get('categorie_id');
        
        $categorieproduit = $this->categorieProduitRepository->find($id);
        $categorie = $this->categorieRepository->find($categorie_id);
        $produits = $this->produitRepository->findBy([
            "categorieProduit" => $categorieproduit,
            "Categorie" => $categorie
        ]);
        dump($id,$produits);
        
        $html =  $this->renderView('front_home/categorieProduit.html.twig',[
            "categorie" => $categorie,
            "categorieproduit" => $categorieproduit,
            "hrefsList" => $produits
        ]);
        dump($html);

        $response = new Response($html);
        dump($response);
        
        return $response;

    }
                        
    #[route('/produit' , name: 'app_produit')]
    public function produit(Request $request): Response
    {
        $id = $request->get('id');
        $produit = $this->produitRepository->find($id);
        $variantproduits = $this->variantProduitRepository->findBy(["Produit" => $id]);
        dump($id,$variantproduits);

        $mesParamTiwg = [
            "produit"           => $produit,
            "variantproduits"   => $variantproduits,
        
        ];

        $html = $this->renderView('front_home/produit.html.twig', $mesParamTiwg);
        dump($html);
        
        $response = new Response();
        $response->setContent($html);
        dump($response);
    
        return $response;
    }

    // création de la route marques >> app_marque
    // dans laquelle : 
    //  1 tu recpp la marque
    //  2 tu recupp tous les produits de cette marques
        
    #[route('/marque/{id}' , name: 'app_marque')]
    public function marque(Marque $marque) : Response
    {
        return $this->render('front_home/marque.html.twig', [
            "marque"  => $marque
        ]);
    }

}
