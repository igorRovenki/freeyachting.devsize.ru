<?php

namespace UserBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as RegistrationFormTypeBase;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationFormType extends RegistrationFormTypeBase
{
    public function __construct($class)
    {
        parent::__construct($class);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastName', null, ['label' => 'form.lastname'])
            ->add('name', null, ['label' => 'form.name'])
            ->add('patronomic', null, ['label' => 'form.patronomic'])
            ->add('gender', 'hidden', ['label' => 'form.gender'])
            ->add('username', null, ['label' => 'form.username'])
            ->add(
                'plainPassword',
                'repeated',
                [
                    'type' => 'password',
                    'first_options' => ['label' => 'form.password'],
                    'second_options' => ['label' => 'form.password_confirmation'],
                    'invalid_message' => 'fos_user.password.mismatch',
                ]
            )
            ->add('birthday', 'text', ['label' => 'form.birthday'])
            ->add('email', 'email', ['label' => 'form.email'])
            ->add('phone', 'email', ['label' => 'form.phone', 'required' => false])
            ->add('interests', 'textarea', ['label' => 'form.interests', 'required' => false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => 'AppBundle\Entity\User',
                'intention'  => 'registration',
                'translation_domain' => 'AppBundle',
            ]
        );
    }

    public function getName()
    {
        return 'app_user_registration';
    }
}
