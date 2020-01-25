<?php


namespace App\Controller;
use App\Entity\Categorie;
use App\Entity\Produit;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BoutiqueController extends AbstractController
{
    public function index() {

        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository(Categorie::class)->findAll();

                return $this->render("Boutique/index.html.twig", [
                    "categories" =>$categories
                ]);
    }

    public function produits(int $idCategory) {

        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository(Produit::class)->findByCategorie($idCategory);
        $categorie = $em->getRepository(Categorie::class)->find($idCategory);


        return $this->render("Boutique/produits.html.twig", [
            "produits" =>$product,
            "categorie" =>$categorie
        ]);
    }

/*    public function searchProduits(BoutiqueService $boutique, string $search) {
        $produits = $boutique->findProduitsByLibelleOrTexte($search);
        return $this->render("Boutique/produits.html.twig", [
            "produits" =>$produits
        ]);
    }*/

}