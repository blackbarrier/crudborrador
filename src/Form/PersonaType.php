<?php

namespace App\Form;

use App\Entity\Persona;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numeroDocumento')
            ->add('tipoDocumento', null, [
                'required' => true,
            ])
            ->add('apellido')
            ->add('nombre')
            ->add('fechaNacimiento',BirthdayType::class,[
                'widget' => 'single_text',
            ])
            ->add('cuil')
            ->add('sexo', null, [
                'required' => true,
            ])
            ->add('pais', null, [
                'required' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Persona::class,
        ]);
    }
}
