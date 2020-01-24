<?php

namespace App\Controller;
use App\Entity\Usager;
use App\Service\PanierService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Psr\Log\LoggerInterface;
use App\Entity\Produit;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

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

    /*  public function getTotalProduit(PanierService $panierService) {
        $panierService->getTotal();
        return $this->redirectToRoute('panier');
    } */


    public function validation(PanierService $panierService, SessionInterface $session){
        $em = $this->getDoctrine()->getManager();

        $id = $session->get("usager");

        $usager = $em->getRepository(Usager::class)->find($id);
        $commande = $panierService->panierToCommande($usager);

        //var_dump($id);
        return $this->render(
            'Panier/commande-finalisee.html.twig', [ "commande"=>$commande ]
        );

    }
}