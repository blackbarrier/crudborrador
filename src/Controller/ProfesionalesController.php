<?php

namespace App\Controller;

use App\Entity\Persona;
use App\Entity\PersonaContacto;
use App\Entity\PersonaDomicilio;
use App\Entity\Profesional;
use App\Entity\ProfesionalRegistracion;
use App\Entity\ProfesionalRegistracionArchivo;
use App\Form\CombinatedFormType;
use App\Form\PersonaContactoType;
use App\Form\PersonaType;
use App\Form\ProfesionalType;
use App\Repository\AlcanceRepository;
use App\Repository\PersonaContactoRepository;
use App\Repository\PersonaDomicilioRepository;
use App\Repository\PersonaRepository;
use App\Repository\ProfesionalRepository;
use App\Repository\UsuarioRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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
    public function new(Request $request, EntityManagerInterface $entityManager, UsuarioRepository $usuarioRepository, AlcanceRepository $repoAlcance): Response
    {
        $userIdentifier=$this->getUser()->getUserIdentifier();
        $usuario = $usuarioRepository->findOneBy(["dni" => $userIdentifier]);
        $id_usuario = $usuario->getId();

        $profesional = new Profesional();
        $persona = new Persona();
        $personaContacto = new PersonaContacto();
        $personaDomicilio = new PersonaDomicilio();
        $profesionalRegistracion = new ProfesionalRegistracion();
        $archivo = new ProfesionalRegistracionArchivo();
    

        $form = $this->createForm(CombinatedFormType::class);

        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {           
            
                $personaContacto = $form->get('form_contacto')->getData();
                $personaDomicilio = $form->get('form_domicilio')->getData();
                $persona = $form->get('form_persona')->getData();
                $profesional = $form->get('form_profesional')->getData();
                $profesionalRegistracion = $form->get('form_reg')->getData();
               
                
                $profesional->setPersona($persona);
                $personaContacto->setPersona($persona);
                $personaDomicilio->setUsuarioActualizaId($usuario);
                $personaDomicilio->setPersona($persona);

                //Registracion
                $profesionalRegistracion->setProfesional($profesional);
                $profesionalRegistracion->setFechaRegistracion(new \DateTime());

                        $Matricula = $profesional->getTipoMatricula();
                        $id_tipoMatricula = $Matricula->getId();
                        if($id_tipoMatricula ==1){
                            $alcance_id = 2;
                        }else{
                            $alcance_id = 1;
                        }
                $alcance = $repoAlcance->findOneBy(['id' => $alcance_id]);
                $profesionalRegistracion->setAlcance($alcance);
                
                
                //Imagen
                $archivo = $form->get('form_archivo')->getData();                
                if ($archivo) {
                    try {
                        $file=$_FILES['combinated_form'];
                        $nombre_archivo= $file["name"]["form_archivo"]["nombreArchivo"];
                        // $tipo_archivo = $file["type"]["form_archivo"]["nombreArchivo"];
                        // $tamano_archivo = $file["size"]["form_archivo"]["nombreArchivo"];

                        $extension = explode(".", $nombre_archivo);
                        $ext = trim($extension[1]);                        
                        $nombre_unico = uniqid() . '_' . time();
                        $nombre_archivo = $nombre_unico . '.' . $ext;
                        $path = '../public/imagenes/' . $nombre_archivo . '';
                        move_uploaded_file($file["tmp_name"]["form_archivo"]["nombreArchivo"], $path);

                        $archivo->setNombreArchivo($nombre_archivo);                        
                        $archivo->setFechaCArga(new \DateTime());
                        $archivo->setPath($path);
                        $archivo->setTipoArchivo($ext);
                        $archivo->setProfesionalRegistracion($profesionalRegistracion);                  
                       
                    } catch (FileException $e) {
                        dd($e);
                    }                       
                }                              
                
                
                //Persistiendo
                
                $entityManager->persist($persona);
                $entityManager->persist($profesional);
                $entityManager->persist($personaContacto);
                $entityManager->persist($personaDomicilio);
                $entityManager->persist($profesionalRegistracion);
                $entityManager->persist($archivo);               
                $entityManager->flush();                
                return $this->redirectToRoute('app_profesionales_index', [], Response::HTTP_SEE_OTHER);                       
        }

        return $this->renderForm('profesionales/new.html.twig', [
            'form' => $form,
             //Este $id es el que va a pasar al Javascript para setear el campo Usuario de carga..
            'id_usuario' => $id_usuario
        ]);
    }



    /**
     * @Route("/{id}", name="app_profesionales_show", methods={"GET"})
     */
    public function show ($id, ProfesionalRepository $profesionalRepository, PersonaRepository $personaRepository, PersonaContactoRepository $personaContactoRepository, PersonaDomicilioRepository $personaDomicilioRepository): Response   
    {      
        $profesional = $profesionalRepository->findOneBy(["id" => $id]);
        $persona = $profesional->getPersona();       
        $contacto = $personaContactoRepository->findOneBy(["persona" => $persona]);
        $domicilio = $personaDomicilioRepository->findOneBy(["persona" => $persona]);  

        
        $form = $this->createForm(CombinatedFormType::class,  [
            'form_profesional' => $profesional,
            'form_persona' => $persona,
            'form_contacto' => $contacto,
            'form_domicilio' => $domicilio,
        ]);
               
        return $this->renderForm('profesionales/show.html.twig', [
            'form'=>$form,
        ]);
    }



    /**
     * @Route("/{id}/edit", name="app_profesionales_edit", methods={"GET", "POST"})
     */
    public function edit($id, Request $request, PersonaDomicilioRepository $personaDomicilioRepository, PersonaContactoRepository $personaContactoRepository,PersonaRepository $personaRepository, ProfesionalRepository $profesionalRepository, Profesional $profesional, EntityManagerInterface $entityManager, UsuarioRepository $usuarioRepository): Response
    {        
        $userIdentifier=$this->getUser()->getUserIdentifier();
        $usuario = $usuarioRepository->findOneBy(["dni" => $userIdentifier]);
        $id_usuario = $usuario->getId();

        $profesional = $profesionalRepository->findOneBy(["id" => $id]);
        $persona = $profesional->getPersona();       
        $contacto = $personaContactoRepository->findOneBy(["persona" => $persona]);
        $domicilio = $personaDomicilioRepository->findOneBy(["persona" => $persona]);  

       
        $id = $profesional->getId();

        $form = $this->createForm(CombinatedFormType::class,  [
            'form_profesional' => $profesional,
            'form_persona' => $persona,
            'form_contacto' => $contacto,
            'form_domicilio' => $domicilio,
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $contacto = $form->get('form_contacto')->getData();
            $domicilio = $form->get('form_domicilio')->getData();
            $persona = $form->get('form_persona')->getData();
            $profesional = $form->get('form_profesional')->getData();

            $profesional->setPersona($persona);
            $contacto->setPersona($persona);
            $domicilio->setUsuarioActualizaId($id_usuario);
            $domicilio->setPersona($persona);

            $entityManager->persist($persona);
            $entityManager->persist($profesional);            
            $entityManager->persist($contacto);
            $entityManager->persist($domicilio);
            $entityManager->flush();     

            return $this->redirectToRoute('app_profesionales_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('profesionales/edit.html.twig', [
            'form' => $form,
             //Este $id es el que va a pasar para el DELETE en caso de borrarse desde Editar.
            'id' => $id,   
             //Este $id es el que va a pasar al Javascript para setear el campo Usuario de carga..
            'id_usuario' => $id_usuario
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
