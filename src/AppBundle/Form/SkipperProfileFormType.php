<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\DataTransformer\DateTimeToStringTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use AppBundle\Form\DataTransformer\MediaToUploadedFileTransformer;
use Symfony\Component\Validator\Constraints\NotBlank;

class SkipperProfileFormType extends AbstractType
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
            ->add('lastName', null, ['label' => 'form.lastname', 'constraints'])
            ->add('photo', 'file', ['required' => false])
            ->add('name', null, ['label' => 'form.name'])
            ->add('patronomic', null, ['label' => 'form.patronomic'])
            ->add('gender', 'hidden', ['label' => 'form.gender'])
            ->add('username', null, ['label' => 'form.username'])
            ->add('birthday', 'text', ['label' => 'form.birthday', 'required' => false])
            ->add('email', 'email', ['label' => 'form.email'])
            ->add('skypeLogin', 'text', ['label' => 'form.skypeLogin', 'required' => false])
            ->add('phone', 'email', ['label' => 'form.phone', 'required' => false])
            ->add('knowRussian', 'checkbox', ['label' => 'form.knowRussian', 'required' => false])
            ->add('knowEnglish', 'checkbox', ['label' => 'form.knowEnglish', 'required' => false])
            ->add('firstAnotherLang', 'choice', ['label' => 'form.anotherLang', 'required' => false])
            ->add('secondAnotherLang', 'choice', ['required' => false])
            ->add('iytCertificate', 'checkbox', ['label' => 'form.iytCertificate'])
            ->add('ryaCertificate', 'checkbox', ['label' => 'form.ryaCertificate'])
            ->add('certificateNumber', 'text', ['label' => 'form.ryaCertificate', 'constraints' => [new NotBlank()]])
            ->add('certificateIssueDate', 'datetime', ['label' => 'form.certificateIssueDate'])
            ->add('experienceYears', 'text', ['label' => 'form.experienceYears'])
            ->add('experienceMiles', 'text', ['label' => 'form.experienceMiles'])
            ->add('jobOffersAgree', 'checkbox', ['label' => 'form.jobOffersAgree', 'required' => false])
            ->add('emailSubscribtion', 'checkbox', ['label' => 'form.jobOffersAgree', 'required' => false])
        ;
        $builder->get('birthday')->addModelTransformer(new DateTimeToStringTransformer(null, null, 'Y-m-d'));
        $builder->get('photo')->addModelTransformer(new MediaToUploadedFileTransformer());
    }
}
