<?php

namespace App\Service;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Psr\Log\LoggerInterface;
use Doctrine\ORM\EntityManager;

// Service pour manipuler le panier et le stocker en session
class PanierService {
    ////////////////////////////////////////////////////////////////////////////
    const PANIER_SESSION = 'panier'; // Le nom de la variable de session du panier
    private $session;  // Le service Session
    private $panier;   // Tableau associatif idProduit => quantite
	                   //  donc $this->panier[$i] = quantite du produit dont l'id = $i
    // constructeur du service
    public function __construct(
        LoggerInterface $logger,
        SessionInterface $session) {
        $this->session = $session;
        $this->logger = $logger;
        $this->panier = $this->session->get(self::PANIER_SESSION, []);

    }
    // getContenu renvoie le contenu du panier
    //  tableau d'éléments [ "produit" => un produit, "quantite" => quantite ]
    public function getContenu(): array {
        return $this->session->get(self::PANIER_SESSION, []);
    }


    function ajouterArticle(int $idProduit, int $quantite): void{
        if (isset($this->panier[$idProduit])) {
            $this->panier[$idProduit] += $quantite;
        } else {
            $this->panier[$idProduit] = $quantite;
        }

        $this->session->set(self::PANIER_SESSION, $this->panier);
    }

    // getTotal renvoie le montant total du panier
    //public function getTotal() { // à compléter }
    // getNbProduits renvoie le nombre de produits dans le panier
    //public function getNbProduits() { // à compléter }
    // enleverProduit enlève du panier le produit $idProduit en quantite $quantite
    //public function enleverProduit(int $idProduit, int $quantite = 1) { // à compléter }
    // supprimerProduit supprime complètement le produit $idProduit du panier
    //public function supprimerProduit(int $idProduit) { // à compléter }
    // vider vide complètement le panier
    //public function vider() { // à compléter }
}
