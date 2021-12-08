<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Contracts\Translation\TranslatorInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;

class UserType extends AbstractType
{
    private TranslatorInterface $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label_attr' => ["class" => "col-form-label"],
                'attr' => [
                    "class" => "form-control",
                    "placeholder" => "emma.samuel@gmail.com"
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
            ->add('firstName', TextType::class, [
                'label_attr' => ["class" => "col-form-label"],
                'attr' => [
                    "class" => "form-control",
                    "placeholder" => "Emma"
                ],
            ])
            ->add('lastName', TextType::class, [
                'label_attr' => ["class" => "col-form-label"],
                'attr' => [
                    "class" => "form-control",
                    "placeholder" => "SAMUEL"
                ],
            ])
            ->add('accountType', ChoiceType::class, [
                'label_attr' => ["class" => "col-form-label"],
                'choices' => [
                    "Simple user" => "Simple user",
                    "Administrator" => "Administrator"
                ],
                'placeholder' => $this->translator->trans('Please choose an account type')
            ])
            ->add('location', TextType::class, [
                'label_attr' => ["class" => "col-form-label"],
                'attr' => [
                    "class" => "form-control",
                    "placeholder" => 'Lagos, NIGERIA'
                ],
            ])
            ->add('contact', TextType::class, [
                'label_attr' => ["class" => "col-form-label"],
                'attr' => [
                    "class" => "form-control",
                    "placeholder" => '+228 78 90 54 33'
                ],
            ])
            ->add('avatarFile', VichImageType::class, [
                'required' => false,
                'allow_delete' => true,
                'delete_label' => 'Del',
                'download_uri' => false,
                'imagine_pattern' => 'avatar_sidebar',
                'attr' => [
                    'placeholder' => 'Image(.png/.jpg)'
                ],
                'label' => ' '
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'validation_groups' => ['user_creation', 'user_editing'],
        ]);
    }
}
