<?php

namespace App\Controller;

use App\Entity\Usager;
use App\Form\UsagerType;
use App\Repository\UsagerRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;




class UsagerController extends AbstractController
{

    const USAGER_SESSION = 'usager';
    public function index(UsagerRepository $usagerRepository, SessionInterface $session): Response
    {
        $idUserSession = $session->get(self::USAGER_SESSION);
        $usager = null;
        if($idUserSession) {
            $usager = $usagerRepository->find($idUserSession);
        }

        $usagers = $usagerRepository->findAll();
        return $this->render('usager/index.html.twig', [
            'usager' => $usager,
            'usagers' => $usagers,
        ]);
    }

    public function new(Request $request, SessionInterface $session, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $usager = new Usager();
        $form = $this->createForm(UsagerType::class, $usager);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $usager->setPassword($passwordEncoder->encodePassword($usager,$usager->getPassword()));
          $usager->setRoles(["ROLE_CLIENT"]);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($usager);
            $entityManager->flush();


            $id = $usager->getId();
            $session->set(self::USAGER_SESSION, $id);

          /*  dump($usager);
            exit;*/


            return $this->redirectToRoute('usager_accueil');

        }

        return $this->render('usager/new.html.twig', [
            'usager' => $usager,
            'form' => $form->createView(),
        ]);
    }
}
