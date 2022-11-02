<?php

namespace App\Form;

use App\Entity\Beer;
use App\Entity\Pricing;
use App\Entity\Service;
use Doctrine\DBAL\Types\FloatType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PricingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('price', MoneyType::class,[
                'divisor' => 100,
                'label' => 'Prix',
                'html5' => true,
                'required' => true,
                'attr' => ['step' => 0.01]
            ])
            ->add('quantity', IntegerType::class,[
                'label' => 'Quantité',
                'required' => true,
            ])
            ->add('service', EntityType::class,[
                'class' => Service::class,
                'choice_label' => 'wording'
            ])
            ->add('beer', EntityType::class,[
                'class' => Beer::class,
                'choice_label' => 'name'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pricing::class,
        ]);
    }
}
