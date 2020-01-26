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

    public function monCompte(UsagerRepository $usagerRepository, SessionInterface $session): Response
    {

        return $this->render('usager/myAccount.html.twig', [
            'usager' => $this->getUser(),
        ]);
    }

    public function new(Request $request, SessionInterface $session, UserPasswordEncoderInterface $passwordEncoder): Response
    {

        $entityManager = $this->getDoctrine()->getManager();

        // Créer nvelle entité usager
        $usager = new Usager();
        // creer form à partir de la classe & associer form avec var usager
        $form = $this->createForm(UsagerType::class, $usager);
        // VOir dans contenu request si form est rempli si oui rempli usager avec val form
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $email = $usager->getEmail();
            $usagerRepository = $entityManager->getRepository(Usager::class);
            $usagerExist = $usagerRepository->findBy(['email' => $email]);

            if($usagerExist != null) {

                return $this->render('usager/new.html.twig', [
                    'usager' => $usager,
                    'form' => $form->createView(),
                    'usagerExist' =>$usagerExist
                ]);
            }

            $usager->setPassword($passwordEncoder->encodePassword($usager,$usager->getPassword()));
            $usager->setRoles(["ROLE_CLIENT"]);

            $entityManager->persist($usager);
            $entityManager->flush();

            $id = $usager->getId();
            $session->set(self::USAGER_SESSION, $id);
            dump($usager);

            return $this->redirectToRoute('usager_accueil');
        }

        return $this->render('usager/new.html.twig', [
            'usager' => $usager,
            'form' => $form->createView(),
            'usagerExist' => false,
        ]);
    }
}
