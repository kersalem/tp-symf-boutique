<?php

namespace App\Controller;
use App\Service\PanierService;
use App\Service\BoutiqueService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Psr\Log\LoggerInterface;

class PanierController extends AbstractController
{
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

/*    public function index(PanierService $panierService, BoutiqueService $boutiqueService)
    {
        $panierWithItems = [];
        $panier = $panierService->getContenu();

        foreach ($panier as $id => $quantity) {
            $panierWithItems[] = ['item' =>$boutiqueService->findProduitById($id), 'quantity' => $quantity];
        }
        return $this->render(
            'panier/index.html.twig',
            [
                "panier" => $panierWithItems,
            ]
        );
    }*/

    public function index(PanierService $panier, BoutiqueService $boutiqueService) {
        $panier = $panier->getContenu();
       // $produit = $boutiqueService->findProduitById($productId);

        return $this->render("Panier/index.htlm.twig", [
            "produits" => $panier
        ]);

    }

    public function panierAjouter(PanierService $panierService, BoutiqueService $boutiqueService, $productId)
    {
        $produit = $boutiqueService->findProduitById($productId);
        $this->logger->info('On est bien ICIIIII');
        $panierService->ajouterArticle($productId, $produit["libelle"], $produit["prix"]);
        return $this->redirectToRoute('boutique');
    }

    /**
     * @Route("/PanierController/add/{id}", name="panier_add")
     */

/*    public function add($id, Request $request){
        $session = $request->getSession();
        $panier = $session->get('panier', []);
        $panier[$id] = 1;
        $session->set('panier', panier);

        //dd($session->get('panier'));
    }*/



}