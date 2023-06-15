<?php

namespace App\Form;

use App\Entity\Persona;
use App\Entity\PersonaDomicilio;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CombinatedFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('form_profesional', ProfesionalType::class)
        ->add('form_persona', PersonaType::class)
        ->add('form_contacto', PersonaContactoType::class)
        ->add('form_domicilio', PersonaDomicilioType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => null,
        ]);
    }
}
