<?php

namespace App\Form\Guest;

use App\Form\Guest\Model\GuestSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GuestSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'name',
                TextType::class,
                [
                    'required' => false,
                    'attr' => [
                        'class' => 'form-control form-control-sm'
                    ]
                ]
            )
            ->add(
                'status',
                ChoiceType::class,
                [
                    'choice_translation_domain' => false,
                    'label' => 'Status',
                    'choices' => ['Approved' => 1, 'Disapproved' => -1, 'Pending' => 0],
                    'placeholder' => 'Select Status',
                    'required' => false,
                    'attr' => [
                        'class' => 'form-control form-control-sm'
                    ]
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => GuestSearch::class,
            ]
        );
    }
}
