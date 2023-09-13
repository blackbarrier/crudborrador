<?php

namespace App\Controller;

use App\Repository\ProfesionalRegistracionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="app_admin_registracion")
     */
    public function profesional_registraciones(ProfesionalRegistracionRepository $profesionalRegRepository): Response
    {  
        dd("En construccion");
    }
    
}
