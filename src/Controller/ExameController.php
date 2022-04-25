<?php

namespace App\Controller;

use App\Entity\Exame;
use App\Form\ExameType;
use App\Repository\ExameRepository;
use App\Repository\MedicoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/exame')]
class ExameController extends AbstractController
{
    #[Route('/', name: 'app_exame_index', methods: ['GET'])]
    public function index(ExameRepository $exameRepository, MedicoRepository $medicoRepository): Response
    {
        return $this->render('exame/index.html.twig', [
            'exames' => $exameRepository->findAll(),
            'medico' => $medicoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_exame_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ExameRepository $exameRepository): Response
    {
        $exame = new Exame();
        $form = $this->createForm(ExameType::class, $exame);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($form['dtExm']->getData() < $form['vencimento']->getData())
            {
                $exameRepository->add($exame);
                return $this->redirectToRoute('app_exame_index', [], Response::HTTP_SEE_OTHER);
            }
        }

        return $this->renderForm('exame/new.html.twig', [
            'exame' => $exame,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_exame_show', methods: ['GET'])]
    public function show(Exame $exame): Response
    {
        $medico = $exame->getMedico();
        return $this->render('exame/show.html.twig', [
            'exame' => $exame,
            'medico' => $medico,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_exame_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Exame $exame, ExameRepository $exameRepository): Response
    {
        $form = $this->createForm(ExameType::class, $exame);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $exameRepository->add($exame);
            return $this->redirectToRoute('app_exame_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('exame/edit.html.twig', [
            'exame' => $exame,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_exame_delete', methods: ['POST'])]
    public function delete(Request $request, Exame $exame, ExameRepository $exameRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$exame->getId(), $request->request->get('_token'))) {
            $exameRepository->remove($exame);
        }

        return $this->redirectToRoute('app_exame_index', [], Response::HTTP_SEE_OTHER);
    }
}
