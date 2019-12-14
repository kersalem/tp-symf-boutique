<?php


namespace App\Controller;
use App\Service\BoutiqueService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class BoutiqueController extends AbstractController
{
    public function index(BoutiqueService $boutique) {
        $categories = $boutique->findAllCategories();
        return $this->render("Boutique/index.html.twig", [
            "categories" =>$categories
        ]);
    }

    public function produits(BoutiqueService $boutique, int $idCategory) {
        $produits = $boutique->findProduitsByCategorie($idCategory);
        return $this->render("Boutique/produits.html.twig", [
            "produits" =>$produits
        ]);
    }

    public function searchProduits(BoutiqueService $boutique, string $search) {
        $produits = $boutique->findProduitsByLibelleOrTexte($search);
        return $this->render("Boutique/produits.html.twig", [
            "produits" =>$produits
        ]);
    }

}