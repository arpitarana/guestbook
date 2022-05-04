<?php

namespace App\Form\Guest;

use App\Entity\Guest\GuestDetail;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GuestDetailType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class,
                [
                    'required' => true,
                    'attr' => [
                        'class' => 'form-control form-control-sm',
                        'placeholder' => 'Guest name'
                    ]
                ]
            )
            ->add('information', TextareaType::class,
                [
                    'attr' => [
                        'class' => 'form-control form-control-sm',
                        'placeholder' => 'Guest information'
                    ]
                ]
            )
            ->add(
                'imageFile',
                FileType::class,
                [
                    'label' => 'Upload image',
                    'data_class' => null,
                    'required'   => false,
                ]
            )
            ->add('type', ChoiceType::class,
                [
                    'choices'  => [
                        'Text' => 'text',
                        'Image' => 'image'
                    ],
                    'expanded' => true,
                    'multiple' => false,
                    'required' => true,
                    'attr' => [
                        'class' => 'select-type'
                    ],
                    'data' => 'text'
                ]
            );
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => GuestDetail::class,
            'csrf_protection' => true,
            'validation_groups' => [ 'add_edit_guestdetail' ],
            'form_type' => null
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'guestbundle_guestdetail';
    }
}
