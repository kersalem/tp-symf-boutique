<?php

namespace App\Service;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Service\BoutiqueService;
use Psr\Log\LoggerInterface;


// Service pour manipuler le panier et le stocker en session
class PanierService {
    ////////////////////////////////////////////////////////////////////////////
    const PANIER_SESSION = 'panier'; // Le nom de la variable de session du panier
    private $session;  // Le service Session
    private $boutiqueService; // Le service Boutique
    private $panier;   // Tableau associatif idProduit => quantite
	                   //  donc $this->panier[$i] = quantite du produit dont l'id = $i
    // constructeur du service
    public function __construct(
        LoggerInterface $logger,
        SessionInterface $session,
        BoutiqueService $boutiqueService
    ) {
        $this->session = $session;
        $this->boutiqueService = $boutiqueService;
/*        $this->panier = $this->session->get(self::PANIER_SESSION, []); //self::varStatik pour statik*/
        $this->logger = $logger;

    }
    // getContenu renvoie le contenu du panier
    //  tableau d'éléments [ "produit" => un produit, "quantite" => quantite ]
    public function getContenu(): array {
        return $this->session->get(self::PANIER_SESSION, []);
    }


    function ajouterArticle($productId,$libelleProduit,$prixProduit){
        // $this->creationPanier();
        //Si le produit existe déjà on ajoute seulement la quantité
            //$positionProduit = array_search($libelleProduit,  $_SESSION['panier']['libelle']);
                //Sinon on ajoute le produit
        // $this->logger->info(implode($_SESSION));
       $panier = $this->session->get(self::PANIER_SESSION, []);
        $ligneProduit = array( "id"=>$productId,"libelle" =>$libelleProduit, "prix"=> $prixProduit);
        array_push( $panier, $ligneProduit);
        $this->session->set(self::PANIER_SESSION, $panier);
    }

/*    public function ajouterProduit(int $idProduit, int $quantity = 1): void
    {
        if (isset($this->panier[$idProduit])) {
            $initialQuantity = $this->panier[$idProduit];
        } else {
            $initialQuantity = null;
        }
        if ($initialQuantity !== null) {
            $this->panier[$idProduit] += $quantity;
        } else {
            $this->panier[$idProduit] = $quantity;
        }
        $this->session->set(self::PANIER_SESSION, $this->panier);
    }*/
    // getTotal renvoie le montant total du panier
    //public function getTotal() { // à compléter }
    // getNbProduits renvoie le nombre de produits dans le panier
    //public function getNbProduits() { // à compléter }
    // ajouterProduit ajoute au panier le produit $idProduit en quantite $quantite
    //public function ajouterProduit(int $idProduit, int $quantite = 1) { // à compléter }
    // enleverProduit enlève du panier le produit $idProduit en quantite $quantite
    //public function enleverProduit(int $idProduit, int $quantite = 1) { // à compléter }
    // supprimerProduit supprime complètement le produit $idProduit du panier
    //public function supprimerProduit(int $idProduit) { // à compléter }
    // vider vide complètement le panier
    //public function vider() { // à compléter }
}
