<?php

namespace App\Controller;

use App\Repository\HospitalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



/**
 * @Route("/hospital")
 */
class HospitalController extends AbstractController
{
   
    /**
     * @Route("/", name="app_hospital_index")
     */
    public function index(HospitalRepository $hospitalRepository): Response
    {
        return $this->render('hospital/index.html.twig', [
            'hospitales' => $hospitalRepository->findAll(),
        ]);
    }


    
}
