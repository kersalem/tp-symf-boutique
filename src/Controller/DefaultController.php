<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
     public function index() {
         return $this->render("Default/Home.html.twig");
     }

    public function contact() {
        return $this->render("Default/Contact.html.twig");
    }

}