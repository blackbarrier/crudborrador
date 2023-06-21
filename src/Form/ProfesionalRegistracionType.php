<?php

namespace App\Form;

use App\Entity\ProfesionalRegistracion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfesionalRegistracionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('fechaRegistracion')
            // ->add('borrado')
            // ->add('profesional')
            ->add('origenRegistracion')
            // ->add('alcance')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProfesionalRegistracion::class,
        ]);
    }
}
