<?php

namespace App\Controller;

use App\Entity\Obstetra;
use App\Form\ObstetraType;
use App\Repository\ObstetraRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/obstetra")
 */
class ObstetraController extends AbstractController
{
    /**
     * @Route("/", name="app_obstetra_index", methods={"GET"})
     */
    public function index(ObstetraRepository $obstetraRepository): Response
    {
        return $this->render('obstetra/index.html.twig', [
            'obstetras' => $obstetraRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_obstetra_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ObstetraRepository $obstetraRepository): Response
    {
        $obstetra = new Obstetra();
        $form = $this->createForm(ObstetraType::class, $obstetra);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $obstetraRepository->add($obstetra, true);

            return $this->redirectToRoute('app_obstetra_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('obstetra/new.html.twig', [
            'obstetra' => $obstetra,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_obstetra_show", methods={"GET"})
     */
    public function show(Obstetra $obstetra): Response
    {
        return $this->render('obstetra/show.html.twig', [
            'obstetra' => $obstetra,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_obstetra_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Obstetra $obstetra, ObstetraRepository $obstetraRepository): Response
    {
        $form = $this->createForm(ObstetraType::class, $obstetra);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $obstetraRepository->add($obstetra, true);

            return $this->redirectToRoute('app_obstetra_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('obstetra/edit.html.twig', [
            'obstetra' => $obstetra,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_obstetra_delete", methods={"POST"})
     */
    public function delete(Request $request, Obstetra $obstetra, ObstetraRepository $obstetraRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$obstetra->getId(), $request->request->get('_token'))) {
            $obstetraRepository->remove($obstetra, true);
        }

        return $this->redirectToRoute('app_obstetra_index', [], Response::HTTP_SEE_OTHER);
    }
}
