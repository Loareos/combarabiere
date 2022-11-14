<?php

namespace App\Form;

use App\Entity\Bar;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class BarType extends AbstractType
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
                'label'=>'Nom'])
            ->add('description', TextareaType::class,[
                'required'=>false,
                'label'=>'Description'
            ])
            ->add(
                $builder->create('menu', FormType::class,[
                    'by_reference' => true,
                    'label' => false
                ])
                    ->add('pricing', CollectionType::class,[
                        'label' => false,
                        'entry_type' => PricingType::class,
                        'entry_options' => [
                            'label' => false
                        ],
                        'allow_add' => true,
                        'allow_delete' => true,
                        'prototype_name' => '__pricing__'
                    ])
            )
            ->add(
                $builder->create('barLocation', FormType::class,['by_reference' => true])
                    ->add('street')
                    ->add('city')
                    ->add('country')
                    ->add('longitude')
                    ->add('latitude')
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Bar::class,
        ]);
    }
}
