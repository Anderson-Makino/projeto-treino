<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Entity\Escritorio;
use App\Entity\Medico;
use App\Form\MedicoType;
use App\Repository\EscritorioRepository;
use App\Repository\MedicoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

#[Route('/medico')]
class MedicoController extends AbstractController
{

    public function __construct(Security $security)
    {
       $this->security = $security;
    }

    #[Route('/', name: 'app_medico_index', methods: ['GET'])]
    public function index(MedicoRepository $medicoRepository, EscritorioRepository $escritorioRepository): Response
    {
        $userLogged = new Usuario;
        $escritorio = new Escritorio;
        $medico = new Medico;
        $userLogged = $this->security->getUser();
        $escritorio = $userLogged->getOffice();
        //$myCollectionIds = $escritorio->map(function($obj){return $obj->getId();})->getValues();
        return $this->render('medico/index.html.twig', [
            //'medicos' => $medicoRepository->findAll(),
            'medicos' => $medicoRepository->findByEscritorio($escritorio),
        ]);
    }

    #[Route('/new', name: 'app_medico_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MedicoRepository $medicoRepository): Response
    {
        $medico = new Medico();
        $form = $this->createForm(MedicoType::class, $medico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $medicoRepository->add($medico);
            return $this->redirectToRoute('app_medico_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('medico/new.html.twig', [
            'medico' => $medico,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_medico_show', methods: ['GET'])]
    public function show(Medico $medico): Response
    {
        $escritorio = $medico->getEscritorio();
        //$escritorio = $medico->getCompanyId();
        return $this->render('medico/show.html.twig', [
            'medico' => $medico,
            'escritorio' => $escritorio,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_medico_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Medico $medico, MedicoRepository $medicoRepository): Response
    {
        $form = $this->createForm(MedicoType::class, $medico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $medicoRepository->add($medico);
            return $this->redirectToRoute('app_medico_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('medico/edit.html.twig', [
            'medico' => $medico,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_medico_delete', methods: ['POST'])]
    public function delete(Request $request, Medico $medico, MedicoRepository $medicoRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$medico->getId(), $request->request->get('_token'))) {
            $medicoRepository->remove($medico);
        }

        return $this->redirectToRoute('app_medico_index', [], Response::HTTP_SEE_OTHER);
    }
}
