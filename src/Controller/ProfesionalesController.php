<?php

namespace App\Controller;

use App\Entity\Alcance;
use App\Entity\Persona;
use App\Entity\PersonaContacto;
use App\Entity\PersonaDomicilio;
use App\Entity\Profesional;
use App\Entity\ProfesionalEspecialista;
use App\Entity\ProfesionalRegistracion;
use App\Entity\ProfesionalRegistracionArchivo;
use App\Entity\TipoMatricula;
use App\Form\CombinatedFormType;
use App\Form\PersonaContactoType;
use App\Form\PersonaType;
use App\Form\ProfesionalType;
use App\Repository\AlcanceRepository;
use App\Repository\EspecialidadRepository;
use App\Repository\PersonaContactoRepository;
use App\Repository\PersonaDomicilioRepository;
use App\Repository\PersonaRepository;
use App\Repository\ProfesionalEspecialistaRepository;
use App\Repository\ProfesionalRegistracionArchivoRepository;
use App\Repository\ProfesionalRegistracionRepository;
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
        //Identificacion para DELETE y usuario de CARGA
        $userIdentifier=$this->getUser()->getUserIdentifier();
        $usuario = $usuarioRepository->findOneBy(["dni" => $userIdentifier]);
        $id_usuario = $usuario->getId();

        //Creacion de instancias de todas las entidades a crear
        $profesional = new Profesional();
        $persona = new Persona();
        $contacto = new PersonaContacto();
        $domicilio = new PersonaDomicilio();
        $registracion = new ProfesionalRegistracion();
        $archivo = new ProfesionalRegistracionArchivo();
        $especialista = new ProfesionalRegistracionArchivo();
    
        //Formulario Combinado
        $form = $this->createForm(CombinatedFormType::class);        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {           
                
                //Levantar datos del formulario para las instancias
                $contacto = $form->get('form_contacto')->getData();
                $domicilio = $form->get('form_domicilio')->getData();
                $persona = $form->get('form_persona')->getData();
                $profesional = $form->get('form_profesional')->getData();
                $registracion = $form->get('form_reg')->getData();
                $especialista = $form->get('form_especialista')->getData();

               
                //Pisa datos con objetos correspondietes
                $profesional->setPersona($persona);                
                $contacto->setPersona($persona);
                
                $domicilio->setPersona($persona);
                $domicilio->setUsuarioActualizaId($usuario);

                $especialista->setFechaActualizacion(new \DateTime());
                $especialista->setProfesional($profesional);

                

                //RegistracionProfesional. Se lo carga en detalle. VER TEMA DE ALCANCE.
                $registracion->setProfesional($profesional);
                $registracion->setFechaRegistracion(new \DateTime());
                            $Matricula = $profesional->getTipoMatricula();
                            $id_tipoMatricula = $Matricula->getId();
                            if($id_tipoMatricula == TipoMatricula::MEDICO){
                                $alcance_id = Alcance::DEFUNCIONES;
                            }else{
                                $alcance_id = Alcance::NACIMIENTOS;
                            }
                $alcance = $repoAlcance->findOneBy(['id' => $alcance_id]);
                $registracion->setAlcance($alcance);
                $entityManager->persist($registracion);      

                
                
                //Proceso de carga de archivo
                $archivo = $form->get('form_archivo')->getData(); 
                        
                if ($archivo) {
                    $file=$_FILES['combinated_form'];
                    if($file["name"]["form_archivo"]["nombreArchivo"]){
                        try {                    
                            $nombre_archivo= $file["name"]["form_archivo"]["nombreArchivo"];
                            
                            $extension = explode(".", $nombre_archivo);
                            $ext = trim($extension[1]);                        
                            $nombre_unico = uniqid() . '_' . time();
                            $nombre_archivo = $nombre_unico . '.' . $ext;
                            $path = '../public/imagenes/' . $nombre_archivo . '';
                            move_uploaded_file($file["tmp_name"]["form_archivo"]["nombreArchivo"], $path);

                            $archivo->setNombreArchivo($nombre_archivo);                        
                            $archivo->setFechaCarga(new \DateTime());
                            $archivo->setPath($path);
                            $archivo->setTipoArchivo($ext);
                            $archivo->setProfesionalRegistracion($registracion);
                            $entityManager->persist($archivo);
                            
                        } catch (FileException $e) {
                            throw new \Exception($e);
                        }      
                    }                    
                }              
                
                //Persistiendo             
                $entityManager->persist($persona);
                $entityManager->persist($profesional);
                $entityManager->persist($contacto);
                $entityManager->persist($domicilio);                                                              
                $entityManager->persist($especialista);                               
                $entityManager->flush();       
                return $this->redirectToRoute('app_profesionales_index', [], Response::HTTP_SEE_OTHER);                       
        }

        return $this->renderForm('profesionales/new.html.twig', [
            'form' => $form,
             //Este $id es el que va a pasar al Javascript para setear el campo Usuario de carga..
            'id_usuario' => $id_usuario,    
            'archivo'=> $archivo->getNombreArchivo()
        ]);
    }



    /**
     * @Route("/{id}", name="app_profesionales_show", methods={"GET"})
     */
    public function show ($id, ProfesionalEspecialistaRepository $especialistaRepository, ProfesionalRegistracionArchivoRepository $archivoRepo, ProfesionalRegistracionRepository $profesionalRegistracionRepository,ProfesionalRepository $profesionalRepository, PersonaRepository $personaRepository, PersonaContactoRepository $personaContactoRepository, PersonaDomicilioRepository $personaDomicilioRepository): Response   
    {   
        //Se buscan por los objetos correspondietes por repositorio usando ID de Profesional
        $profesional = $profesionalRepository->findOneBy(["id" => $id]);
        $persona = $profesional->getPersona();       
        $contacto = $personaContactoRepository->findOneBy(["persona" => $persona]);
        $domicilio = $personaDomicilioRepository->findOneBy(["persona" => $persona]);  
        $registracion = $profesionalRegistracionRepository->findOneBy(["profesional" => $id]);
        $archivo = $archivoRepo->findOneBy(["profesionalRegistracion" => $registracion->getId()]);
        $especialista = $especialistaRepository->findOneBy(["profesional" => $id]);

        //Se Crea el formulario y se carga con los datos de los objetos tomados arriba
        $form = $this->createForm(CombinatedFormType::class,  [
            'form_profesional' => $profesional,
            'form_persona' => $persona,
            'form_contacto' => $contacto,
            'form_domicilio' => $domicilio,
            'form_reg' => $registracion,
            'form_archivo' => $archivo,
            'form_especialista' => $especialista,
        ]);      

        if($archivo == NULL){
            return $this->renderForm('profesionales/show.html.twig', [
                'form'=>$form,
                'archivo'=> "null.png"
            ]);    
        }else{
            return $this->renderForm('profesionales/show.html.twig', [
                'form'=>$form,
                'archivo'=> $archivo->getNombreArchivo()
            ]);            
        }
        
    }



    /**
     * @Route("/{id}/edit", name="app_profesionales_edit", methods={"GET", "POST"})
     */
    public function edit($id, ProfesionalEspecialistaRepository $especialistaRepository, AlcanceRepository $repoAlcance, Request $request, ProfesionalRegistracionArchivoRepository $archivoRepo, ProfesionalRegistracionRepository $profesionalRegistracionRepository, PersonaDomicilioRepository $personaDomicilioRepository, PersonaContactoRepository $personaContactoRepository,PersonaRepository $personaRepository, ProfesionalRepository $profesionalRepository, Profesional $profesional, EntityManagerInterface $entityManager, UsuarioRepository $usuarioRepository): Response
    {        
        //Identificacion para DELETE y usuario de CARGA
        $userIdentifier=$this->getUser()->getUserIdentifier();
        $usuario = $usuarioRepository->findOneBy(["dni" => $userIdentifier]);
        $id_usuario = $usuario->getId();

        //Se buscan por los objetos correspondietes por repositorio usando ID de Profesional
        $profesional = $profesionalRepository->findOneBy(["id" => $id]);
        $persona = $profesional->getPersona();       
        $contacto = $personaContactoRepository->findOneBy(["persona" => $persona]);
        $domicilio = $personaDomicilioRepository->findOneBy(["persona" => $persona]);  
        $registracion = $profesionalRegistracionRepository->findOneBy(["profesional" => $id]);
        $archivo = $archivoRepo->findOneBy(["profesionalRegistracion" => $registracion->getId()]);
        $especialista = $especialistaRepository->findOneBy(["profesional" => $id]);
        

       //Id pada Javascript
        $id = $profesional->getId();
        
       //Se Crea el formulario y se carga con los datos de los objetos tomados arriba
        $form = $this->createForm(CombinatedFormType::class,  [
            'form_profesional' => $profesional,
            'form_persona' => $persona,
            'form_contacto' => $contacto,
            'form_domicilio' => $domicilio,
            'form_reg' => $registracion,
            'form_archivo' => $archivo,
            'form_especialista' => $especialista,
        ]);

        //Proceso de carga de archivo
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $contacto = $form->get('form_contacto')->getData();
            $domicilio = $form->get('form_domicilio')->getData();
            $persona = $form->get('form_persona')->getData();
            $profesional = $form->get('form_profesional')->getData();
            $registracion = $form->get('form_reg')->getData();
            $especialista = $form->get('form_especialista')->getData();


            //Pisa datos con objetos correspondietes
            $profesional->setPersona($persona);
            $contacto->setPersona($persona);

            $domicilio->setPersona($persona);
            $domicilio->setUsuarioActualizaId($usuario);

            $especialista->setFechaActualizacion(new \DateTime());
            $especialista->setProfesional($profesional);

            //RegistracionProfesional. Se lo carga en detalle. VER TEMA DE ALCANCE.
            $registracion->setProfesional($profesional);
            $registracion->setFechaRegistracion(new \DateTime());

                    $Matricula = $profesional->getTipoMatricula();
                    $id_tipoMatricula = $Matricula->getId();
                    if($id_tipoMatricula == TipoMatricula::MEDICO){
                        $alcance_id = Alcance::DEFUNCIONES;
                    }else{
                        $alcance_id = Alcance::NACIMIENTOS;
                    }
            $alcance = $repoAlcance->findOneBy(['id' => $alcance_id]);
            $registracion->setAlcance($alcance);
            $entityManager->persist($registracion); 
            
            

            //Proceso de carga de archivo
            $archivo = $form->get('form_archivo')->getData(); 
                        
                if ($archivo) {
                    $file=$_FILES['combinated_form'];
                    if($file["name"]["form_archivo"]["nombreArchivo"]){
                        try {                    
                            $nombre_archivo= $file["name"]["form_archivo"]["nombreArchivo"];
                            
                            $extension = explode(".", $nombre_archivo);
                            $ext = trim($extension[1]);                        
                            $nombre_unico = uniqid() . '_' . time();
                            $nombre_archivo = $nombre_unico . '.' . $ext;
                            $path = '../public/imagenes/' . $nombre_archivo . '';
                            move_uploaded_file($file["tmp_name"]["form_archivo"]["nombreArchivo"], $path);

                            $archivo->setNombreArchivo($nombre_archivo);                        
                            $archivo->setFechaCarga(new \DateTime());
                            $archivo->setPath($path);
                            $archivo->setTipoArchivo($ext);
                            $archivo->setProfesionalRegistracion($registracion);                            
                            $entityManager->persist($archivo);               
                                                                
                        } catch (FileException $e) {
                            throw new \Exception($e);
                        }      
                    }                    
                }              
            
            //Persistiendo  
            $entityManager->persist($persona);
            $entityManager->persist($profesional);            
            $entityManager->persist($contacto);
            $entityManager->persist($domicilio);               
            $entityManager->persist($especialista);    
            $entityManager->flush();     

            return $this->redirectToRoute('app_profesionales_index', [], Response::HTTP_SEE_OTHER);
        }

        if($archivo == NULL){
            return $this->renderForm('profesionales/edit.html.twig', [
                'form' => $form,
                 //Este $id es el que va a pasar para el DELETE en caso de borrarse desde Editar.
                'id' => $id,   
                 //Este $id es el que va a pasar al Javascript para setear el campo Usuario de carga..
                'id_usuario' => $id_usuario,
                'archivo'=> "null.png"
            ]);      
        }else{
            return $this->renderForm('profesionales/edit.html.twig', [
                'form' => $form,
                 //Este $id es el que va a pasar para el DELETE en caso de borrarse desde Editar.
                'id' => $id,   
                 //Este $id es el que va a pasar al Javascript para setear el campo Usuario de carga..
                'id_usuario' => $id_usuario,
                'archivo'=> $archivo->getNombreArchivo()
            ]);       
        }        
       
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
