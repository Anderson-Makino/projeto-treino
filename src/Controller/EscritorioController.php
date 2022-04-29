<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Entity\Escritorio;
use App\Form\EscritorioType;
use App\Repository\EscritorioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

#[Route('/escritorio')]
class EscritorioController extends AbstractController
{

    public function __construct(Security $security)
    {
       $this->security = $security;
    }

    #[Route('/', name: 'app_escritorio_index', methods: ['GET'])]
    public function index(EscritorioRepository $escritorioRepository): Response
    {
        $userLogged = new Usuario;
        $userLogged = $this->security->getUser();
        return $this->render('escritorio/index.html.twig', [
            //'escritorios' => $escritorioRepository->findAll(),
            'escritorios' => $userLogged->getOffice(),
        ]);
    }

    #[Route('/new', name: 'app_escritorio_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EscritorioRepository $escritorioRepository): Response
    {
        $userLogged = new Usuario;
        $userLogged = $this->security->getUser();
        $escritorio = new Escritorio();
        $form = $this->createForm(EscritorioType::class, $escritorio);
        $escritorio->addUserOffice($userLogged);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $escritorioRepository->add($escritorio);
            return $this->redirectToRoute('app_escritorio_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('escritorio/new.html.twig', [
            'escritorio' => $escritorio,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_escritorio_show', methods: ['GET'])]
    public function show(Escritorio $escritorio): Response
    {
        $empresa = $escritorio->getOfficeCompany();
        return $this->render('escritorio/show.html.twig', [
            'escritorio' => $escritorio,
            'empresa' => $empresa
        ]);
    }

    #[Route('/{id}/edit', name: 'app_escritorio_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Escritorio $escritorio, EscritorioRepository $escritorioRepository): Response
    {
        $form = $this->createForm(EscritorioType::class, $escritorio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $escritorioRepository->add($escritorio);
            return $this->redirectToRoute('app_escritorio_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('escritorio/edit.html.twig', [
            'escritorio' => $escritorio,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_escritorio_delete', methods: ['POST'])]
    public function delete(Request $request, Escritorio $escritorio, EscritorioRepository $escritorioRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$escritorio->getId(), $request->request->get('_token'))) {
            $escritorioRepository->remove($escritorio);
        }

        return $this->redirectToRoute('app_escritorio_index', [], Response::HTTP_SEE_OTHER);
    }
}
