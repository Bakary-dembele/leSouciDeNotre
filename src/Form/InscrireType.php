<?php

namespace App\Form;

use App\Entity\Inscrire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscrireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Nom'
                )
            ])
            ->add('prenom', TextType::class, [
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Prénom'
                )
            ])
            ->add('telephone', TextType::class, [
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Téléphone'
                )
            ])
            ->add('email', EmailType::class, [
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Adresse e-mail'
                )
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Inscrire::class,
        ]);
    }
}
