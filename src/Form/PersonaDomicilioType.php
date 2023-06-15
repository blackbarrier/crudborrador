<?php

namespace App\Form;

use App\Entity\PersonaDomicilio;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonaDomicilioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('calle')
            ->add('numero')
            ->add('piso')
            ->add('departamento')
            // ->add('borradoestado')
            ->add('fechaActualizacion',BirthdayType::class,[
                'widget' => 'single_text',
                'data' => new \DateTime()
            ])
            // ->add('usuarioActualizaId')
            // ->add('persona')
            ->add('localidad')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PersonaDomicilio::class,
        ]);
    }
}
