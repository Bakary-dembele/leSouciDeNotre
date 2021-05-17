<?php

namespace App\Form;

use App\Entity\Groupe;
use App\Entity\Lieu;
use App\Entity\Maraude;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnnulationMaraudeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom de la maraude :',
                'attr' => [
                    'placeholder' => ''
                ]
            ])
            ->add('dateDebut', DateTimeType::class, [
                'label' => 'Date et heure de la Maraude:',
                'widget' => 'single_text',
                'html5' => true
            ])
            ->add('descriptionInfos', TextareaType::class, [
                'label' => 'Motif :',
                'attr' => [
                    'rows' => "5",
                ]
            ])
            ->add('groupe', EntityType::class, [
                'class' => Groupe::class,
                'choice_label' => 'nomGroupe',
                'attr' => ['readonly' => true,
                ]])
            ->add('lieu', EntityType::class, [
                'class' => Lieu::class,
                'choice_label' => 'nomLieu',
                'attr' => ['readonly' => true,
                ]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Maraude::class,
        ]);
    }
}
