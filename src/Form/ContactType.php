<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class, [
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Nom'
                )
            ])
            ->add('prenom',TextType::class, [
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Prénom'
                )
            ])
            ->add('email',EmailType::class, [
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Adresse e-mail'
                )
            ])
            ->add('message',TextareaType::class, [
                'label' => false,
                'attr' => [
                    'rows' => "5",
                    'placeholder' => 'Message',


                ]

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {

        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
