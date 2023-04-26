<?php

namespace App\Controller;

use App\Entity\Persona;
use App\Form\PersonaType;
use App\Repository\PersonaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


 



class basecontroller extends AbstractController
{
    /**
     * @Route("/", name="", methods={"GET"})
     */
    public function index(PersonaRepository $personaRepository): Response
    {
        return $this->render('base.html.twig', [
           
        ]);
    } 
}