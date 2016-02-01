<?php

namespace AppBundle\Form;

use AppBundle\Entity\User;
use AppBundle\Form\DataTransformer\MediaToUploadedFileTransformer;
use FOS\UserBundle\Form\Type\RegistrationFormType as RegistrationFormTypeBase;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationFormType extends RegistrationFormTypeBase
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastName', null, ['label' => 'form.lastname'])
            ->add('photo', 'file', ['required' => false])
            ->add('name', null, ['label' => 'form.name'])
            ->add('patronomic', null, ['label' => 'form.patronomic'])
            ->add('gender', 'hidden', [
                'label' => 'form.gender',
                'attr' => ['value' => User::GENDER_M, 'class' => 'gender']
            ])
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
            ->add('birthday', 'text', ['label' => 'form.birthday', 'required' => false])
            ->add('email', 'email', ['label' => 'form.email'])
            ->add('phone', 'email', ['label' => 'form.phone', 'required' => false])
            ->add('interests', 'textarea', ['label' => 'form.interests', 'required' => false])
            ->add(
                'captcha',
                'captcha',
                [
                    'label' => 'form.captcha',
                    'as_url' => true,
                    'reload' => 'reload',
                    'height' => 40,
                    'width' => 130,
                    'length' => 4,
                ]
            )
        ;
        $builder->get('photo')->addModelTransformer(new MediaToUploadedFileTransformer());
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
