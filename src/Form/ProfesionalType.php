<?php

namespace App\Form;

use App\Entity\Persona;
use App\Entity\Profesional;
use Doctrine\DBAL\Types\BooleanType;
use Doctrine\DBAL\Types\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType as TypeDateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfesionalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('matricula') 
            ->add('fallecido', ChoiceType::class,[
            'choices' => [
                'NO' => 'NO',               
                'SI' => 'SI'
            ],
        ])
            ->add('fechaFallecido',BirthdayType::class,[
                'widget' => 'single_text',
            ])
            ->add('habilitado', ChoiceType::class,[
                'choices' => [                    
                    'SI' => 'SI',
                    'NO' =>'NO'                
                ],
        ])
            ->add('fechaAlta',BirthdayType::class,[
                'widget' => 'single_text',
            ])
            ->add('fechaBaja',BirthdayType::class,[
                'widget' => 'single_text'
            ])
            ->add('fechaCarga',BirthdayType::class,[
                'widget' => 'single_text',
                'data' => new \DateTime()
            ])
            // ->add('borrado')
            // ->add('persona', PersonaType::class)
            ->add('usuario')
            ->add('tipoMatricula', null, [
                'required' => true,
            ])
            ->add('distrito', null, [
                'required' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Profesional::class,
        ]);
    }
}
