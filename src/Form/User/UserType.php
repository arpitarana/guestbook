<?php

namespace App\Form\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\User\User;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //$roleTypes = $this->doctrine->getRepository(Role::class)->getRoles();
        //unset($roleTypes['ROLE_USER']);

        /** @var User $user */
        $builder
            ->add('username', TextType::class,
                [
                    'required' => true,
                    'attr' => [
                        'class' => 'form-control form-control-lg',
                        'placeholder' => 'Username'
                    ]
                ]
            )
            ->add('firstName', TextType::class,
                [
                    'required' => true,
                    'attr' => [
                        'class' => 'form-control form-control-lg',
                        'placeholder' => 'Firstname'
                    ]
                ]
            )
            ->add('lastName', TextType::class,
                [
                    'required' => true,
                    'attr' => [
                        'class' => 'form-control form-control-lg',
                        'placeholder' => 'Lastname'
                    ]
                ]
            )
            ->add('email', EmailType::class,
                [
                    'required' => true,
                    'attr' => [
                        'class' => 'form-control form-control-lg',
                        'placeholder' => 'Email'
                    ]
                ]
            )
            ->add('password', PasswordType::class,
                [
                    'required' => true,
                    'attr' => [
                        'class' => 'form-control form-control-lg',
                        'placeholder' => 'Password'
                    ]
                ]
            );
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'validation_groups' => [ 'add_edit_user' ],
            'form_type' => null
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'userbundle_user';
    }
}
