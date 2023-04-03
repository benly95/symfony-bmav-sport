<?php

namespace App\Form\Type;

use App\Entity\Adresse;
use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdresseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('rue', TextareaType::class, [
                'required' => true
            ])
            ->add('codePostal', NumberType::class, [
                'required' => true
            ])
            ->add('ville',  TextType::class, [
                'required' => true
            ])
            ->add('pays', ChoiceType::class, [
                'required' => true,
                'choices' => [
                    'France' => 'FR',
                    'Belgique' => 'BE',
                    'Monaco'   => 'MC'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Adresse::class,
        ]);
    }

}