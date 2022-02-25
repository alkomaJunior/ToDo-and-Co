<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UpdateUserPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('adminPassword', PasswordType::class, [
                'label_attr' => ["class" => "col-form-label"],
                'attr' => [
                    "class" => "form-control",
                    "placeholder" => "******"
                ],
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'label_attr' => ["class" => "col-form-label"],
                    'attr' => [
                        "class" => "form-control",
                        "placeholder" => "******"
                    ],
                ],
                'second_options' => [
                    'label_attr' => ["class" => "col-form-label"],
                    'attr' => [
                        "class" => "form-control",
                        "placeholder" => "******"
                    ],
                ],
                'invalid_message' => 'validator.message.repeatedType',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'validation_groups' => ['user_password_update'],
        ]);
    }
}
