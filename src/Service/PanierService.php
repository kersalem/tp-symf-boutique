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
    // getContenu renvoie le contenu du w
    //  tableau d'éléments [ "produit" => un produit, "quantite" => quantite ]
    public function getContenu(): array {
        return $this->session->get(self::PANIER_SESSION, []);
    }


    function ajouterArticle(int $idProduit, int $quantity=1): void{
        if (isset($this->panier[$idProduit])) {
            $this->panier[$idProduit] += $quantity;
        } else {
            $this->panier[$idProduit] = $quantity;
        }

        $this->session->set(self::PANIER_SESSION, $this->panier);
    }

    // enleverProduit enlève du panier le produit $idProduit en quantite $quantite
    public function enleverProduit(int $idProduit, int $quantity = 1) {

        if (isset($this->panier[$idProduit])) {
            $initialQuantity = $this->panier[$idProduit];
        } else {
            $initialQuantity = 0;
        }
        if ($initialQuantity !== null && $initialQuantity > $quantity) {
            $this->panier[$idProduit] -= $quantity;
        } else {
            unset($this->panier[$idProduit]);
        }
        $this->session->set(self::PANIER_SESSION, $this->panier);
    }

    // supprimerProduit supprime complètement le produit $idProduit du panier
    public function supprimerProduit(int $idProduit) {
        unset($this->panier[$idProduit]);
        $this->session->set(self::PANIER_SESSION, $this->panier);
    }

    // getTotal renvoie le montant total du panier
   /* public function getTotal() {
        $total = 0;

        foreach ($this->getContenu() as $id => $quantite) {
            $total += $this->repo->findOneById($id)->getPrix() * $quantite;
        }

        return $total;
    } */

    // getNbProduits renvoie le nombre de produits dans le panier
    //public function getNbProduits() { // à compléter }


    // vider vide complètement le panier
    //public function vider() { // à compléter }
}
