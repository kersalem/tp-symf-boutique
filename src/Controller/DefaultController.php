<?php


namespace App\Controller;
use App\Entity\Produit;
use App\Entity\Categorie;


use Doctrine\ORM\Mapping\Entity;
use PhpParser\Node\Expr\Array_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
     public function index() {
         return $this->render("Default/Home.html.twig");
     }

    public function contact() {
        return $this->render("Default/Contact.html.twig");
    }

//    public function testDeBourin (){
//
//
//         $categories = [
//            [
//                "id" => 1,
//                "libelle" => "Fruits",
//                "visuel" => "images/fruits.jpg",
//                "texte" => "De la passion ou de ton imagination",
//            ],
//            [
//                "id" => 3,
//                "libelle" => "Junk Food",
//                "visuel" => "images/junk_food.jpg",
//                "texte" => "Chère et cancérogène, tu es prévenu(e)",
//            ],
//            [
//                "id" => 2,
//                "libelle" => "Légumes",
//                "visuel" => "images/legumes.jpg",
//                "texte" => "Plus tu en manges, moins tu en es un"],
//        ];
//        $produits = [
//            [
//                "id" => 1,
//                "idCategorie" => 1,
//                "libelle" => "Pomme",
//                "texte" => "Elle est bonne pour la tienne",
//                "visuel" => "images/pommes.jpg",
//                "prix" => 3.42
//            ],
//            [
//                "id" => 2,
//                "idCategorie" => 1,
//                "libelle" => "Poire",
//                "texte" => "Ici tu n'en es pas une",
//                "visuel" => "images/poires.jpg",
//                "prix" => 2.11
//            ],
//            [
//                "id" => 3,
//                "idCategorie" => 1,
//                "libelle" => "Pêche",
//                "texte" => "Elle va te la donner",
//                "visuel" => "images/peche.jpg",
//                "prix" => 2.84
//            ],
//            [
//                "id" => 4,
//                "idCategorie" => 2,
//                "libelle" => "Carotte",
//                "texte" => "C'est bon pour ta vue",
//                "visuel" => "images/carottes.jpg",
//                "prix" => 2.90
//            ],
//            [
//                "id" => 5,
//                "idCategorie" => 2,
//                "libelle" => "Tomate",
//                "texte" => "Fruit ou Légume ? Légume",
//                "visuel" => "images/tomates.jpg",
//                "prix" => 1.70
//            ],
//            [
//                "id" => 6,
//                "idCategorie" => 2,
//                "libelle" => "Chou Romanesco",
//                "texte" => "Mange des fractales",
//                "visuel" => "images/romanesco.jpg",
//                "prix" => 1.81
//            ],
//            [
//                "id" => 7,
//                "idCategorie" => 3,
//                "libelle" => "Nutella",
//                "texte" => "C'est bon, sauf pour ta santé",
//                "visuel" => "images/nutella.jpg",
//                "prix" => 4.50
//            ],
//            [
//                "id" => 8,
//                "idCategorie" => 3,
//                "libelle" => "Pizza",
//                "texte" => "Y'a pas pire que za",
//                "visuel" => "images/pizza.jpg",
//                "prix" => 8.25
//            ],
//            [
//                "id" => 9,
//                "idCategorie" => 3,
//                "libelle" => "Oreo",
//                "texte" => "Seulement si tu es un smartphone",
//                "visuel" => "images/oreo.jpg",
//                "prix" => 2.50
//            ],
//        ];
//
//      $em = $this->getDoctrine()->getManager();
//      $categorieEntityArray = Array();
//
//       foreach($categories as $categorie) {
//           $categorieEntity = new Categorie();
//
//           $categorieEntity->setLibelle($categorie["libelle"]);
//           $categorieEntity->setTexte($categorie["texte"]);
//           $categorieEntity->setVisuel($categorie["visuel"]);
//           array_push($categorieEntityArray, $categorieEntity);
//           $em -> persist ($categorieEntity);
//       }
//  // $em->flush();
//    foreach($produits as $produit) {
//        $produitEntity = new Produit();
//
//        $categorieId = $produit["idCategorie"];
//        //$categorieEntitty = $em->getRepository(Categorie::class)->find($categorieId);
//        $categorieEntitty = $categorieEntityArray[$categorieId - 1];
//        $produitEntity->setCategorie($categorieEntitty);
//
//        $produitEntity->setLibelle($produit["libelle"]);
//        $produitEntity->setTexte($produit["texte"]);
//        $produitEntity->setVisuel($produit["visuel"]);
//        $produitEntity->setPrix($produit["prix"]);
//
//        $em -> persist ($produitEntity);
//    }
//        $em->flush();
//
//        /*        $product = new Produit();
//                $product->setLibelle('Avocats');
//                $product->setPrix('2.5');
//                $product->setTexte('Variété espagnole');
//                $product->setVisuel('Variété espagnole');
//                $product->setCategorie($categorie);
//
//                $em -> persist ($product);*/
//
//
//        /*        $categorie = new Categorie();
//
//                $categorie->setLibelle('Fruit');
//                $categorie->setTexte('Variete espagnole');
//                $categorie->setVisuel('Variete espagnole');
//                $em = $this->getDoctrine()->getManager();
//
//                $em -> persist ($categorie);*/
//
//
//        return $this->redirectToRoute('index');
//    }


}