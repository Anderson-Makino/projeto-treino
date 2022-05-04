<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Entity\Escritorio;
use App\Entity\Empresa;
use App\Entity\Funcionario;
use App\Form\FuncionarioType;
use App\Repository\EmpresaRepository;
use App\Repository\FuncionarioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

#[Route('/funcionario')]
class FuncionarioController extends AbstractController
{

    public function __construct(Security $security)
    {
       $this->security = $security;
    }

    #[Route('/', name: 'app_funcionario_index', methods: ['GET'])]
    public function index(FuncionarioRepository $funcionarioRepository, EmpresaRepository $empresaRepository): Response
    {
        $userLogged = new Usuario;
        $escritorio = new Escritorio;
        $empresa = new Empresa;
        $userLogged = $this->security->getUser();
        $escritorio = $userLogged->getOffice();
        $empresa = $empresaRepository->findByEscritorio($escritorio);
        return $this->render('funcionario/index.html.twig', [
            //'funcionarios' => $funcionarioRepository->findAll(),
            'funcionarios' => $funcionarioRepository->findByEmpresa($empresa),
        ]);
    }

    #[Route('/new', name: 'app_funcionario_new', methods: ['GET', 'POST'])]
    public function new(Request $request, FuncionarioRepository $funcionarioRepository, EmpresaRepository $empresaRepository): Response
    {
        /*$userLogged = new Usuario;
        $escritorios = new Escritorio;
        $empresa = new Empresa;
        $userLogged = $this->security->getUser();
        $escritorios = $userLogged->getOffice();*/
        $funcionario = new Funcionario();
        $form = $this->createForm(FuncionarioType::class, $funcionario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
        /*    foreach ($escritorios as $escritorio) 
        {
            $empresa = $empresaRepository->findByEscritorio($escritorio);
            foreach ($empresa as $company)
            $funcionario->setCompanyId($company);
        }*/
            $funcionarioRepository->add($funcionario);
            return $this->redirectToRoute('app_funcionario_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('funcionario/new.html.twig', [
            'funcionario' => $funcionario,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_funcionario_show', methods: ['GET'])]
    public function show(Funcionario $funcionario, Empresa $empresa): Response
    {
        $empresa = $funcionario->getCompanyId();
        return $this->render('funcionario/show.html.twig', [
            'funcionario' => $funcionario,
            'empresa' => $empresa,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_funcionario_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Funcionario $funcionario, FuncionarioRepository $funcionarioRepository): Response
    {
        $form = $this->createForm(FuncionarioType::class, $funcionario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $funcionarioRepository->add($funcionario);
            return $this->redirectToRoute('app_funcionario_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('funcionario/edit.html.twig', [
            'funcionario' => $funcionario,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_funcionario_delete', methods: ['POST'])]
    public function delete(Request $request, Funcionario $funcionario, FuncionarioRepository $funcionarioRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$funcionario->getId(), $request->request->get('_token'))) {
            $funcionarioRepository->remove($funcionario);
        }

        return $this->redirectToRoute('app_funcionario_index', [], Response::HTTP_SEE_OTHER);
    }
}
