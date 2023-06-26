<?php

namespace App\Form;

use App\Entity\ProfesionalEspecialista;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfesionalEspecialistaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('borrado')
            // ->add('fechaActualizacion')
            ->add('especialidad')
            // ->add('profesional')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProfesionalEspecialista::class,
        ]);
    }
}
