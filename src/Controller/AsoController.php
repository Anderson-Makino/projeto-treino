<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Entity\Escritorio;
use App\Entity\Empresa;
use App\Entity\Aso;
use App\Entity\Exame;
use App\Form\AsoType;
use App\Form\ExameType;
use App\Repository\AsoRepository;
use App\Repository\EmpresaRepository;
use App\Repository\ExameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

#[Route('/aso')]
class AsoController extends AbstractController
{

    public function __construct(Security $security)
    {
       $this->security = $security;
    }

    #[Route('/', name: 'app_aso_index', methods: ['GET'])]
    public function index(AsoRepository $asoRepository, EmpresaRepository $empresaRepository): Response
    {
        $userLogged = new Usuario;
        $escritorio = new Escritorio;
        $empresa = new Empresa;
        $userLogged = $this->security->getUser();
        $escritorio = $userLogged->getOffice();
        $empresa = $empresaRepository->findByEscritorio($escritorio);
        return $this->render('aso/index.html.twig', [
            //'asos' => $asoRepository->findAll(),
            'asos' => $asoRepository->findByEmpresa($empresa),

        ]);
    }

    #[Route('/new', name: 'app_aso_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AsoRepository $asoRepository, ExameRepository $exameRepository): Response
    {
        $aso = new Aso();
        $exame = new Exame();
        $aso->getExames()->add($exame);
        $form = $this->createForm(AsoType::class, $aso);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) 
        {
            if ($form['medico_aso']->getData() != $form['medico_pcmso']->getData())
            {
                $exame->addAso($aso);
                $asoRepository->add($aso);
                $exameRepository->add($exame);
                return $this->redirectToRoute('app_aso_index', [], Response::HTTP_SEE_OTHER);
            }
        }

        return $this->renderForm('aso/new.html.twig', [
            'aso' => $aso,
            'exames' => $exame,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_aso_show', methods: ['GET'])]
    public function show(Aso $aso): Response
    {
        $empresa = $aso->getEmpresa();
        $funcionario = $aso->getFuncionario();
        $medico = $aso->getMedicoAso();
        $medico2 = $aso->getMedicoPcmso();
        return $this->render('aso/show.html.twig', [
            'aso' => $aso,
            'empresa' => $empresa,
            'funcionario' => $funcionario,
            'medico' => $medico,
            'medicoResponsavel' => $medico2,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_aso_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Aso $aso, AsoRepository $asoRepository): Response
    {
        $form = $this->createForm(AsoType::class, $aso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $asoRepository->add($aso);
            return $this->redirectToRoute('app_aso_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('aso/edit.html.twig', [
            'aso' => $aso,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_aso_delete', methods: ['POST'])]
    public function delete(Request $request, Aso $aso, AsoRepository $asoRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$aso->getId(), $request->request->get('_token'))) {
            $asoRepository->remove($aso);
        }

        return $this->redirectToRoute('app_aso_index', [], Response::HTTP_SEE_OTHER);
    }
}
