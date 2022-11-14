<?php

namespace App\Form;

use App\Entity\Beer;
use App\Entity\TypeOfBeer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PercentType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class BeerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,[
                'required'=>true,
                'constraints' =>[
                    new NotBlank([
                        'message' => 'Veuillez compléter ce champ.',
                    ])
                ],
                'label'=>'Nom'
            ])
            ->add('alcool', PercentType::class,[
                'required'=> false,
                'html5' => true,
                'attr' => ['step' => 0.1],
                'scale' => 1,
                'label'=>'pourcentage d\'alcool'
            ])
            ->add('description', TextareaType::class,[
                'required'=>false,
                'label'=>'Description'
            ])
            ->add('types', EntityType::class,[
                'class' => TypeOfBeer::class,
                'choice_label' => 'wording',
                'multiple' => true,
                'expanded' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Beer::class,
        ]);
    }
}
