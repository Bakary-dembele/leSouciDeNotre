<?php

namespace App\Form;

use App\Entity\EvenementFoot;
use App\Entity\InscriptionEvenementFoot;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionEvenementFootType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class,[
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Nom'
                )
            ])
            ->add('prenom', TextType::class,[
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Prénom'
                )
            ])
            ->add('telephone', TextType::class,[
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
           /* ->add('evenementFoot', EntityType::class, [
                'class' => EvenementFoot::class,
            ])*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => InscriptionEvenementFoot::class,
        ]);
    }
}
