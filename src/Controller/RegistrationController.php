<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Entity\Escritorio;
use App\Form\EscritorioType;
use App\Form\RegistrationFormType;
use App\Repository\EscritorioRepository;
use App\Security\LoginFromAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, LoginFromAuthenticator $authenticator, EntityManagerInterface $entityManager, EscritorioRepository $escritorioRepository): Response
    {

        $user = new Usuario();
        $escritorio = new Escritorio();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
            $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $cnpj = $form->get('cnpj')->getData();
            $nome_escritorio = $form->get('nome')->getData();
            if ($escritorioRepository->findOneBy(array('cnpj' => $cnpj, 'nome' => $nome_escritorio)) == null )
            {
                $escritorio->setCnpj($cnpj);
                $escritorio->setNome($nome_escritorio);
                $escritorioRepository->add($escritorio);
                $user->addOffice($escritorio);
            }
            else
            {
                $escritorio = $escritorioRepository->findOneBy(array('cnpj' => $cnpj, 'nome' => $nome_escritorio));
                $user->addOffice($escritorio);
            }

            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            // return $userAuthenticator->authenticateUser(
            //     $user,
            //     $authenticator,
            //     $request
            // );
            return $this->redirectToRoute('app_usuario_index', [], Response::HTTP_SEE_OTHER); 
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
