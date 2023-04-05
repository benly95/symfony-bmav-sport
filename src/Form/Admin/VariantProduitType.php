<?php

namespace App\Form\Admin;

use App\Entity\Client;
use App\Entity\VariantProduit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VariantProduitType  extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('taille', ChoiceType::class, [
                'choices' => ['S' => 'S','L' => 'L','XL' => 'XL','XXL' => 'XXL']
            ])
            ->add('couleur', TextType::class, [
            ])
            ->add('prix',  MoneyType::class, [
                'divisor' => 100,
                'required' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => VariantProduit::class
        ]);
    }

}