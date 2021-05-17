<?php

namespace App\Form;

use App\Entity\Evenement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EvenementMainType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class, [
                'label' => 'Titre'
            ])
            ->add('descriptif', TextareaType::class,[
                'label' => 'Descriptif'])
            ->add('prix', TextType::class, [
                'label' => 'Prix'
            ])
            ->add('date', DateType::class, [
                'label' => 'Date de l\'événement',
                'widget' => 'single_text',
                'html5' => true,
            ])
            ->add('adresse', TextType::class, [
                'label' => 'Adresse'
            ])
            ->add('heureDebut', TimeType::class, [
                'label' => 'Heure début',
                'widget' => 'single_text',
                'html5' => true,
            ])
            ->add('heureFin', TimeType::class, [
                'label' => 'Heure fin',
                'widget' => 'single_text',
                'html5' => true,
            ])
            ->add('details', TextareaType::class,[
                'label' => 'Descriptif'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
        ]);
    }
}
