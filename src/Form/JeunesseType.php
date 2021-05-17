<?php

namespace App\Form;

use App\Entity\Etat;
use App\Entity\PoleJeunesse;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JeunesseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('details')
            ->add('dateHeure')
            ->add('dateCloture')
            ->add('adresse')
            ->add('nombreDePlace')
            ->add('referent')
            ->add('etat', EntityType::class, [
                'class' => Etat::class,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PoleJeunesse::class,
        ]);
    }
}
