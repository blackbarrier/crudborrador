<?php

namespace App\Form;

use App\Entity\ProfesionalRegistracionArchivo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfesionalRegistracionArchivoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('fechaCarga')
            // ->add('path')
            ->add('nombreArchivo', FileType::class,[
                'mapped' => false,
                'required' => false])
            // ->add('tipoArchivo')
            // ->add('borrado')
            // ->add('profesionalRegistracion')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProfesionalRegistracionArchivo::class,
        ]);
    }
}
