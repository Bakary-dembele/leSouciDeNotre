<?php

namespace App\Form;

use App\Entity\Groupe;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class,[
                'label' => 'Nom *',
            ])
            ->add('prenom', TextType::class,[
                'label' => 'Prénom *',
            ])
            ->add('telephone', TextType::class,[
                'label' => 'Télépone *',
            ])
            ->add('email', EmailType::class,[
                'label' => 'Email *',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci d\'entrer un e-mail',
                    ]),
                ],
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les champs du mot de passe doivent correspondre',
                'required' => true,
                'first_options'  => ['label' => 'Mot de passe *'],
                'second_options' => ['label' => 'Confirmation *
                '],

            ])
          /* ->add('administrateur')
            ->add('actif')*/
            ->add('roles' ,ChoiceType::class, [
               'choices' => [
                   'Utilisateur' => 'ROLE_USER',
                   'Editeur' => 'ROLE_EDITOR',
                   'Administrateur' => 'ROLE_ADMIN'
               ],
               'expanded' => true,
               'multiple' => true,
               'label' => 'Rôles'
           ])
           /* ->add('activation_token')
            ->add('reset_token')
            ->add('isVerified')*/
            ->add('groupe', EntityType::class, [
               'class' => Groupe::class,
               'placeholder' => 'Donnez un groupe à l\'utilisateur',
               'choice_label' => 'nomGroupe',
               'attr' => ['readonly' => true,
               ]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
