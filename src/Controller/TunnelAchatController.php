<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Entity\Client;
use App\Entity\Livraison;
use App\Entity\Paiement;
use App\Entity\Panier;
use App\Form\Type\EtapeCoordonneType;
use App\Form\Type\EtapeLivraisonType;
use App\Form\Type\EtapePayementType;
use App\Form\Type\ClientType;
use App\Repository\PanierItemRepository;
use App\Repository\PanierRepository;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TunnelAchatController  extends AbstractController
{

    public function __construct(
        protected PanierRepository $panierRepository,
        protected ProduitRepository $produitRepository,
        protected PanierItemRepository $panierItemRepository
    )
    {}


    #[Route('/tunnel-achat/coordonne' , name: 'tunnel-achat-coordonnee')]
    public function coordonnee(Request $request) :Response
    {
        if (($panier = $this->getPanier($request)) instanceof Response) {
            return $panier;
        }

        $form = $this->createForm(EtapeCoordonneType::class, $panier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash("info", "Vos cooredonée on bien été entregister !");
            $panier = $form->getData();
            $this->panierRepository->save($panier, true);
            return $this->redirectToRoute('tunnel-achat-livraison');
        }

        return $this->render('tunnel_achat/coordonne.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/tunnel-achat/livraison' , name: 'tunnel-achat-livraison')]
    public function livraison(Request $request) :Response
    {
        if (($panier = $this->getPanier($request)) instanceof Response) {
            return $panier;
        }
        if (!($panier->getClient() instanceof Client && $panier->getAdresseDeFacture() instanceof Adresse)) {
            $this->addFlash("error", "Merci de completer les corrdonées");
            return $this->redirectToRoute('tunnel-achat-coordonnee');
        }

        if (!$panier->getLivraison() instanceof Livraison) {
            $panier->setLivraison(new Livraison($panier->getAdresseDeFacture()));
        }

        $form = $this->createForm(EtapeLivraisonType::class, $panier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash("info", "Vos livraison on bien été entregister !");
            $panier = $form->getData();
            $this->panierRepository->save($panier, true);
            return $this->redirectToRoute('tunnel-achat-payement');
        }

        return $this->render('tunnel_achat/livraison.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/tunnel-achat/payement' , name: 'tunnel-achat-payement')]
    public function payement(Request $request) :Response
    {
        if (($panier = $this->getPanier($request)) instanceof Response) {
            return $panier;
        }
        if (!($panier->getLivraison() instanceof Livraison)) {
            $this->addFlash("error", "Merci de completer la livraison");
            return $this->redirectToRoute('tunnel-achat-livraison');
        }

        $form = $this->createForm(EtapePayementType::class, $panier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash("info", "Vos payement on bien été entregister !");
            /** @var Panier $panier */
            $panier = $form->getData();

            $panier
                ->setStatus(Panier::STATUS_PAYER)
                ->getPaiement()
                    ->setStatus(Paiement::STATUS_VALIDER)
                    ->setTotal($panier->getTotal())
            ;
            $this->panierRepository->save($panier, true);

            return $this->redirectToRoute('tunnel-achat-validation');
        }

        return $this->render('tunnel_achat/payement.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/tunnel-achat/validation' , name: 'tunnel-achat-validation')]
    public function validation(Request $request) :Response
    {
        if (($panier = $this->getPanier($request)) instanceof Response) {
            return $panier;
        }
        if (!($panier->getLivraison() instanceof Livraison)) {
            $this->addFlash("error", "Merci de completer les payement");
            return $this->redirectToRoute('tunnel-achat-payement');
        }

        $request->getSession()->remove("panier_id");

        return $this->render('tunnel_achat/validation.html.twig', [
            'panier' => $panier
        ]);
    }

    private function getPanier(Request $request) :Panier|Response
    {
        $panier = null;
        $panier_id = $request->getSession()->get("panier_id");
        if (!empty($panier_id)) {
            $panier = $this->panierRepository->find($panier_id);
        }
        if ($panier instanceof Panier) {
            return $panier;
        }
        return $this->redirectToRoute('panier');
    }

}