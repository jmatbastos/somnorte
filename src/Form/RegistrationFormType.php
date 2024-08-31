<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('name', TextType::class, [
                'required' => true,                 
                'constraints' => [
                new NotBlank([
                    'message' => 'Please enter the user name',
                    ]),
                ],
            ])
            ->add('roles', TextType::class, [
                'mapped' => false,
                'required' => false,                 
                'constraints' => [
                new NotBlank([
                    'message' => 'Please enter the user role',
                    ]),
                ],
            ])
            ->add('nif', IntegerType::class, [
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter the user NIF',
                        ]),
                    ],
            ])            
            ->add('plainPassword', RepeatedType::class, [
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'type' => PasswordType::class, 
                'required' => false, 
                'first_options'  => ['label' => 'Password'], 
                'second_options' => ['label' => 'Repeat Password'], 
                'invalid_message' => 'The password fields must match.',
                'constraints' => [
                    new NotBlank([
                        'message' => 'The password fields must not be blank.',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
            ],
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
