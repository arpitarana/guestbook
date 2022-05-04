<?php

namespace App\Form\User;

use App\Entity\User\User;
use App\Validator\User\PasswordConstraint;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'password',
                PasswordType::class,
                [
                    'mapped' => false,
                    'label' => 'Current Password',
                    'constraints' => [
                        new UserPassword(
                            ['message' => 'Wrong value given for current password']
                        ),
                    ],
                    'attr' => [
                        'class' => 'form-control form-control-sm',
                        'placeholder' => 'Current Password'
                    ]
                ]
            )
            ->add(
                'rawPassword',
                RepeatedType::class,
                [
                    'type' => PasswordType::class,
                    'invalid_message' => 'The new password fields must match.',
                    'first_options' => [
                        'label' => 'New Password',
                        'attr' => [
                            'class' => 'form-control form-control-sm',
                            'placeholder' => 'New Password'
                        ]
                    ],
                    'second_options' => [
                        'label' => 'Confirm New Password',
                        'attr' => [
                            'class' => 'form-control form-control-sm',
                            'placeholder' => 'Confirm New Password'
                        ]
                    ],
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => User::class,
                'constraints' => [
                    new PasswordConstraint()
                ]
            ]
        );
    }
}
