<?php

namespace App\Form;

use App\Entity\Persona;
use App\Entity\Hospital;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class PersonaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nombre')
            ->add('dni')
            ->add('sexo', ChoiceType::class, [
                'choices' => [
                    'Masculino' => 'M',
                    'Femenino' => 'F'
                ],
                'expanded' => true,
                "multiple"=>false
            ])
            ->add('fNac', DateType::class,[
                'data' => new \DateTime(),
                'widget'=> 'single_text'        
            ])
            
            ->add('hospitalNac', EntityType::class, [
                
                'class' => Hospital::class,
                'choice_label' => 'nombre',
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
