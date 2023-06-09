<?php

namespace App\Controller;

use App\Entity\Persona;
use App\Entity\Profesional;
use App\Form\PersonaType;
use App\Form\ProfesionalType;
use App\Repository\PersonaRepository;
use App\Repository\ProfesionalRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;





/**
 * @Route("/profesionales")
 */
class ProfesionalesController extends AbstractController
{
    /**     
     *@Route("/", name="app_profesionales_index", methods={"GET"})
     */
    public function index(ProfesionalRepository $profesionalRepository): Response
    {    
        $profesionales =$profesionalRepository->findBy(['borrado' => "0"]);        

        return $this->render('profesionales/index.html.twig', [
            'profesionales' => $profesionales,
        ]);
    }


    /**
     * @Route("/new", name="app_profesionales_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $profesional = new Profesional();
        $form = $this->createForm(ProfesionalType::class, $profesional);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $persona = $form->get('persona')->getData();
            $profesional->setPersona($persona);
            $entityManager->persist($persona);
            $entityManager->persist($profesional);
            $entityManager->flush();     

            return $this->redirectToRoute('app_profesionales_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('profesionales/new.html.twig', [

            'form' => $form,
        ]);
    }



    /**
     * @Route("/{id}", name="app_profesionales_show", methods={"GET"})
     */
    public function show(Profesional $profesional, PersonaRepository $personaRepository): Response   
    {      
    
        $form = $this->createForm(ProfesionalType::class, $profesional);
               
        return $this->renderForm('profesionales/show.html.twig', [
            'form'=>$form,
        ]);
    }


    /**
     * @Route("/{id}/edit", name="app_profesionales_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Profesional $profesional, EntityManagerInterface $entityManager): Response
    {
        $id = $profesional->getId();
        $form = $this->createForm(ProfesionalType::class, $profesional);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $persona = $form->get('persona')->getData();
            $profesional->setPersona($persona);

            $entityManager->persist($persona);
            $entityManager->persist($profesional);
            $entityManager->flush();     

            return $this->redirectToRoute('app_profesionales_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('profesionales/edit.html.twig', [

            'form' => $form,
            'id' => $id
        ]);
    }

    /**
     * @Route("/delete/{id}", name="app_profesionales_delete", methods={"POST"})
     */
    public function borrado(Request $request, Profesional $profesional, EntityManagerInterface $entityManager, ProfesionalRepository $profesionalRepository): Response
    {

        
       
        if ($this->isCsrfTokenValid('delete'.$profesional->getId(), $request->request->get('_token'))) {

            $profesional->setBorrado(1);
            $entityManager->persist($profesional);
            $entityManager->flush();     
        }

        return $this->redirectToRoute('app_profesionales_index', [], Response::HTTP_SEE_OTHER);
    }

    
}
