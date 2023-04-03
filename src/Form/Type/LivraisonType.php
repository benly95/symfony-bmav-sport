<?php

namespace App\Form\Type;

use App\Entity\Livraison;
use App\Entity\Panier;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class LivraisonType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('transporteur', ChoiceType::class, [
                'required' => true,
                'choices' => [
                    'Chronopost' => 'CHR',
                    'DHL' => 'DHL',
                    'DPD' => 'DPD'
                ]
            ])
            ->add('modeDeLivraison', ChoiceType::class, [
                'required' => true,
                'choices' => [
                    'Normal' => 'normal',
                    'Expresse (24 heures max)' => 'expresse'
                ]
            ])
            ->add('adresse',  AdresseType::class, [
                'label' => 'Adresse de livraison',
                'required' => true
            ])
            ->add('informationLivraison',  TextareaType::class, [
                'label' => 'Instuction pour le livreaure'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Livraison::class,
        ]);
    }
}