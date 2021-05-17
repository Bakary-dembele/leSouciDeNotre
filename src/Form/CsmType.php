<?php

namespace App\Form;

use App\Entity\Csm;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CsmType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('details', TextType::class, [
                'label' => 'Details'
            ])
            ->add('dateHeure', DateTimeType::class, [
                'label' => 'Date/heure',
                'widget' => 'single_text',
            ])
            ->add('dateCloture', DateTimeType::class, [
                'label' => 'Date clôture',
                'widget' => 'single_text',
            ])
           /* ->add('referent', TextType::class, [
                'label' => 'Référent'
            ])*/
            ->add('adresse', TextType::class, [
                'label' => 'Adresse'
            ])
            ->add('nombreDePlace', IntegerType::class, [
                'label' => 'Nombre de place'
            ])
            /*  ->add('etat', EntityType::class, [
                  'class' => Etat::class,
              ])*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Csm::class,
        ]);
    }
}
