<?php

namespace App\Form;

use App\Entity\ProfesionalRegistracionArchivo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfesionalRegistracionArchivoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fechaCarga', BirthdayType::class)
            ->add('path')
            ->add('nombreArchivo')
            ->add('tipoArchivo')
            ->add('borrado')
            ->add('profesionalRegistracion')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProfesionalRegistracionArchivo::class,
        ]);
    }
}
