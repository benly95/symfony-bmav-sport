<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Marque;
use App\Entity\Panier;
use App\Entity\PanierItem;
use App\Entity\VariantProduit;
use App\Repository\PanierItemRepository;
use App\Repository\PanierRepository;
use App\Repository\ProduitRepository;
use App\Repository\VariantProduitRepository;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;

// dans un contrôleur Symfony

class PanierController extends AbstractController
{

    public function __construct(
        protected PanierRepository $panierRepository,
        protected ProduitRepository $produitRepository,
        protected PanierItemRepository $panierItemRepository,
        protected VariantProduitRepository $variantProduitRepository
    )
    {}


    #[Route('/panier', name: 'panier')]
    public function panierAction (Request $resquest): Response
    {

        $html =  $this->renderView('panier/panier.html.twig',[
            "panier" => $this->getPanier($resquest)
        ]);
        return new Response($html);
    }

    #[Route('/ajouter-au-panier', name: 'ajout_panier')]
    public function ajoutPanierAction (Request $resquest): Response
    {
        $qt = $resquest->get("qt",1);
        $variantProduit = $this->variantProduitRepository->find($resquest->get('id'));

        if (!$variantProduit instanceof VariantProduit) {
            $this->addFlash("error", "Le produit que vous avez voulu ajouter au panier n'est plus disponible");
            return $this->redirectToRoute('panier');
        }


        // 1) instancie ici une variable "$panier" la classe Panier
        $a = $this->getPanier($resquest);
        if ($a == null) {
            $a = new Panier();
        }

        // 1) init d'une varialble $b a null
        $b = null;

        // 2) tu dois boucler sur les panierItems existant du panier
        foreach ($a->getPanierItems() as $panierItem) {
            //2.A)  tu as test si le panierItem->produit->id == $produit->id
            if ($panierItem->getVariantProduit()->getId() == $variantProduit->getId()) {
                // tu affecte panierItem a $b
                $b = $panierItem;
                break;
            }
        }


        // 3) tu test si $b est null
        if ($b == null) {
            // 3.A) instancie ici une variable "$panierItem" la classe PanierItem
            $b = new PanierItem($variantProduit, $a);
        }

        // 4) tu ajoute la quantiter $qt a la quantiter existant dans le panierItem
        $b->addQuantite($qt);
        dump($b, $a);

        // 5) tu sauveagrde le panier
        $this->panierRepository->save($a, true);

        $resquest->getSession()->set("panier_id",$a->getId());

        return $this->render('panier/panier.html.twig',[
            "panier" => $this->getPanier($resquest)
        ]);
        //return $this->redirectToRoute("panier");
    }

    #[Route('/ajout-quantite', name: 'ajout_quantite')]
    public function ajoutQuantiteAction (Request $resquest): Response
    {
        // 1) je dois recupper l'itemPanier
        $id = $resquest->get("id");
        $panierItem = $this->panierItemRepository->find($id);
        if ($panierItem instanceof PanierItem) {
            // 2) je mets a jour la quantiter
            $panierItem->setQuantite($panierItem->getQuantite()+1);
            // 3) je sauvegarde le tous
            $this->panierItemRepository->save($panierItem, true);
            $this->addFlash("info","L'item de pannier a bien été supprimer");
        } else {
            $this->addFlash("error","L'item de pannier a n' pas été trouver");
        }

        // 4) je renvoie l'utilisateur sur le panier
        return $this->redirectToRoute("panier");
    }

    #[Route('/reduire-quantite', name: 'reduire_quantite')]
    public function reduireQuantiteAction (Request $resquest): Response
    {
        // 1) je dois recupper l'itemPanier
        $id = $resquest->get("id");
        $panierItem = $this->panierItemRepository->find($id);
        if ($panierItem instanceof PanierItem &&$panierItem->getQuantite() > 1) {
            // 2) je mets a jour la quantiter
            $panierItem->setQuantite($panierItem->getQuantite()-1);
            // 3) je sauvegarde le tous
            $this->panierItemRepository->save($panierItem, true);
            $this->addFlash("info","L'item de pannier a bien été supprimer");
        } else {
            $this->addFlash("error","L'item de pannier a n' pas été trouver");
        }

        // 4) je renvoie l'utilisateur sur le panier
        return $this->redirectToRoute("panier");


    }

    #[Route('/supression-item', name:'panier_item_suppersion')]
    public function panierItemSuppersion(Request $request) : Response
    {
        // 1) je dois recupper l'itemPanier
        $id = $request->get( "id");
        $panierItem = $this->panierItemRepository->find($id);
        if ($panierItem instanceof PanierItem) {
            // 2) je supprimme l'item
            $this->panierItemRepository->remove($panierItem, true);
            $this->addFlash("info","L'item de pannier a bien été supprimer");
        } else {
            $this->addFlash("error","L'item de pannier a n' pas été trouver");
        }


        // 3) je renvoie l'utilisateur sur le panier
        return $this->redirectToRoute("panier");
    }

    #[Route('/clean-panier', name: 'clean_panier')]
    public function cleanPanierAction (Request $resquest): Response
    {
        // 1) instancie ici une variable "$panier" la classe Panier
        $a = $this->getPanier($resquest);
        // dump(['c', $a, ($a instanceof Panier) == false]);
        if (($a instanceof Panier) == false) {
            $a = new Panier();
        }
        // dump(['d', $a]);

        foreach ($a->getPanierItems() as $panierItem) {
            $a->removePanierItem($panierItem);
        }

        $this->panierRepository->save($a, true);

        $resquest->getSession()->set("panier_id",$a->getId());

        //dump([$a, $b, $a->getId()] );

        $html =  $this->renderView('panier/panier.html.twig',[
            "panier" => $a
        ]);
        return new Response($html);

    }



    private function getPanier(Request $request) : ?Panier
    {
        $panier = null;
        $panier_id = $request->getSession()->get("panier_id");
        if (!empty($panier_id)) {
            $panier = $this->panierRepository->find($panier_id);
        }
        if ($panier instanceof Panier && $panier->getDateDeCommande() instanceof \DateTime) {
            $request->getSession()->remove("panier_id");
            return null;
        }
        return $panier;
    }
}


?>