<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Entity\Escritorio;
use App\Entity\Empresa;
use App\Form\EmpresaType;
use App\Repository\EmpresaRepository;
use App\Repository\EscritorioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

#[Route('/empresa')]
class EmpresaController extends AbstractController
{
    public function __construct(Security $security)
    {
       $this->security = $security;
    }

    #[Route('/', name: 'app_empresa_index', methods: ['GET'])]
    public function index(EmpresaRepository $empresaRepository, EscritorioRepository $escritorioRepository): Response
    {
        $userLogged = new Usuario;
        $escritorio = new Escritorio;
        $empresa = new Empresa;
        $userLogged = $this->security->getUser();
        $escritorio = $userLogged->getOffice();
        return $this->render('empresa/index.html.twig', [
            //'empresas'$empresaRepository->findAll(),
            'empresas' => $empresaRepository->findByEscritorio($escritorio),
        ]);
    }

    #[Route('/new', name: 'app_empresa_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EmpresaRepository $empresaRepository): Response
    {
        $userLogged = new Usuario;
        $escritorios = new Escritorio;
        $escritorio = new Escritorio;
        $empresa = new Empresa();
        $userLogged = $this->security->getUser();
        $escritorios = $userLogged->getOffice();
        $form = $this->createForm(EmpresaType::class, $empresa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            foreach($escritorios as $escritorio)
            $empresa->setEscritorio($escritorio);
            $empresaRepository->add($empresa);
            return $this->redirectToRoute('app_empresa_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('empresa/new.html.twig', [
            'empresa' => $empresa,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_empresa_show', methods: ['GET'])]
    public function show(Empresa $empresa): Response
    {
        return $this->render('empresa/show.html.twig', [
            'empresa' => $empresa,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_empresa_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Empresa $empresa, EmpresaRepository $empresaRepository): Response
    {
        $form = $this->createForm(EmpresaType::class, $empresa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $empresaRepository->add($empresa);
            return $this->redirectToRoute('app_empresa_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('empresa/edit.html.twig', [
            'empresa' => $empresa,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_empresa_delete', methods: ['POST'])]
    public function delete(Request $request, Empresa $empresa, EmpresaRepository $empresaRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$empresa->getId(), $request->request->get('_token'))) {
            $empresaRepository->remove($empresa);
        }

        return $this->redirectToRoute('app_empresa_index', [], Response::HTTP_SEE_OTHER);
    }
}
