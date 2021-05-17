<?php

namespace App\Form;

use App\Entity\Groupe;
use App\Entity\MaraudeSearchData;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MaraudeFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomGroupe', EntityType::class, [
                'class' => Groupe::class,
                'label' => 'Groupe :',
                'choice_label' => 'nom_groupe'
            ])
            ->add('motCle', SearchType::class, [
                'label' => 'Le nom de la maraude contient : ',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Rechercher',
                ],
            ])
            ->add('dateDebutSearch', DateTimeType::class, [
                'label' => 'Entre le :',
                'required' => false,
                'widget' => 'single_text',
            ])
            ->add('dateFinSearch', DateTimeType::class, [
                'label' => ' et le :',
                'required' => false,
                'widget' => 'single_text',

            ])
            ->add('maraudeOrganisateur', CheckboxType::class, [
                'label' =>  'Maraudes dont je suis organisateur',
                'required' => false,

            ])
            ->add('maraudeInscrit', CheckboxType::class, [
                'label' =>  'Maraudes auxquelles je suis inscrit/e',
                'required' => false,
            ])
            ->add('maraudeNonInscrit', CheckboxType::class, [
                'label' =>  'Maraudes auxquelles je ne suis pas inscrit/e',
                'required' => false,
            ])
            ->add('maraudePassees', CheckboxType::class, [
                'label' =>  'Maraudes passées',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MaraudeSearchData::class,

        ]);
    }
}
