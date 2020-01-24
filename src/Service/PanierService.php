<?php

namespace App\Service;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Psr\Log\LoggerInterface;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManager;
use App\Entity\Commande;
use App\Entity\LigneCommande;
use App\Entity\Usager;
use Doctrine\ORM\EntityManagerInterface;

// Service pour manipuler le panier et le stocker en session
class PanierService {
    ////////////////////////////////////////////////////////////////////////////
    const PANIER_SESSION = 'panier'; // Le nom de la variable de session du panier
    private $session;  // Le service Session
    private $panier;   // Tableau associatif idProduit => quantite
	                   //  donc $this->panier[$i] = quantite du produit dont l'id = $i
    private $usager;
    private $repo;
    // constructeur du service
    public function __construct(
        LoggerInterface $logger,
        EntityManagerInterface $em,
        ProduitRepository $repo,
        SessionInterface $session) {
        $this->session = $session;
        $this->logger = $logger;
        $this->repo = $repo;
        $this->panier = $this->session->get(self::PANIER_SESSION, []);
        $this->em = $em;
        //$this->usager = $usager;
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
    public function getTotal() {
        $total = 0;

        foreach ($this->getContenu() as $id => $quantite) {
            $total += $this->repo->findOneById($id)->getPrix() * $quantite;
        }

        return $total;
    }

    // getNbProduits renvoie le nombre de produits dans le panier
    public function getNbProduits() : int{
        $nombreTotaProduits = 0;

        foreach ($this->getContenu() as $quantite) {
            $nombreTotaProduits += $quantite;
        }

        return $nombreTotaProduits;
    }


    // vider vide complètement le panier
    public function vider() {
        $this->panier = [];
        $this->session->set(self::PANIER_SESSION, $this->panier);
    }

        public function panierToCommande(Usager $usager) {

            $contenu = $this->getContenu();
            if(!empty($contenu)) {
                $commande = new Commande();
                $commande->setDateCommande(new \DateTime());
                $commande->setUsager($usager);
                $commande->setStatut('En attente');

                foreach ($contenu as $productId => $quantity) {
                    $product = $this->repo->find($productId);
                    if ($product) {
                        $ligneCommande = new LigneCommande();
                        $ligneCommande->setProduit($product);
                        $ligneCommande->setQuantite($quantity);
                        $ligneCommande->setPrix($product->getPrix());
                        $ligneCommande->setCommande($commande);
                        $this->em->persist($ligneCommande);
                    }
                }

                $this->em->persist($commande);
                $this->em->flush();
                $this->vider();

//                $this->logger->debug('8888888888888');

                return $commande;

            }
        }
}
