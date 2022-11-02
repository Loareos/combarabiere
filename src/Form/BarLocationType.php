<?php

namespace App\Form;

use App\Entity\BarLocation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BarLocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('street')
            ->add('city')
            ->add('country')
            ->add('longitude')
            ->add('latitude')
            ->add('bar')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BarLocation::class,
        ]);
    }
}
