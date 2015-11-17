<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\DataTransformer\DateTimeToStringTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

class ProfileFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->buildUserForm($builder, $options);

        $builder->add(
            'current_password',
            'password',
            [
                'label' => 'form.current_password',
                'mapped' => false,
                'constraints' => new UserPassword(),
            ]
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => 'AppBundle\Entity\User',
                'intention' => 'profile',
                'translation_domain' => 'AppBundle',
            ]
        );
    }

    public function getName()
    {
        return 'app_user_profile';
    }

    /**
     * Builds the embedded form representing the user.
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    protected function buildUserForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastName', null, ['label' => 'form.lastname'])
            ->add('name', null, ['label' => 'form.name'])
            ->add('patronomic', null, ['label' => 'form.patronomic'])
            ->add('gender', 'hidden', ['label' => 'form.gender'])
            ->add('username', null, ['label' => 'form.username'])
            ->add('birthday', 'text', ['label' => 'form.birthday'])
            ->add('email', 'email', ['label' => 'form.email'])
            ->add('phone', 'email', ['label' => 'form.phone', 'required' => false])
            ->add('interests', 'textarea', ['label' => 'form.interests', 'required' => false])
        ;
        $builder->get('birthday')->addModelTransformer(new DateTimeToStringTransformer(null, null, 'Y-m-d'));
    }
}
