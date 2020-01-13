<?php

namespace App\Controller;
use App\Service\PanierService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Psr\Log\LoggerInterface;
use App\Entity\Produit;

class PanierController extends AbstractController
{
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function index(PanierService $panierService) {
        $panierWithItems = [];
        $panier          = $panierService->getContenu();

        foreach ($panier as $id => $quantity) {

            $em = $this->getDoctrine()->getManager();
            $product = $em->getRepository(Produit::class)->find($id);

            $panierWithItems[] = ['item' =>$product, 'quantity' => $quantity];
        }
        return $this->render(
            'Panier/index.html.twig',
            [
                "panier" => $panierWithItems,

            ]
        );

    }

    public function panierAjouter(PanierService $panierService, $idProduit, $quantite=1)
    {
        $panierService->ajouterArticle($idProduit, $quantite);
        return $this->redirectToRoute('panier');
    }

    public function panierEnlever(PanierService $panierService, $idProduit, $quantite=1)
    {
        $panierService->enleverProduit($idProduit, $quantite);
        return $this->redirectToRoute('panier');
    }


    public function panierSupprimerLigne(PanierService $panierService, $idProduit, $quantite=1)
    {
        $panierService->supprimerProduit($idProduit, $quantite);
        return $this->redirectToRoute('panier');
    }

/*    public function getTotalProduit(PanierService $panierService) {
        $panierService->getTotal();
        return $this->redirectToRoute('panier');
    }*/



}