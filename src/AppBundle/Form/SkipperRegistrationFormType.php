<?php

namespace AppBundle\Form;

use Symfony\Component\Form\Extension\Core\DataTransformer\DateTimeToStringTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use AppBundle\Form\DataTransformer\MediaToUploadedFileTransformer;
use Symfony\Component\Validator\Constraints\NotBlank;

class SkipperRegistrationFormType extends RegistrationFormType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastName', null, ['label' => 'form.lastname'])
            ->add('photo', 'file', ['required' => false])
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
            ->add('birthday', 'text', ['label' => 'form.birthday', 'required' => false])
            ->add('email', 'email', ['label' => 'form.email'])
            ->add('skypeLogin', 'text', ['label' => 'form.skypeLogin', 'required' => false])
            ->add('phone', 'email', ['label' => 'form.phone', 'required' => false])
            ->add('knowRussian', 'checkbox', ['label' => 'form.knowRussian', 'required' => false])
            ->add('knowEnglish', 'checkbox', ['label' => 'form.knowEnglish', 'required' => false])
            ->add('firstAnotherLang', 'choice', [
                'label' => 'form.another_lang',
                'required' => false,
                'choices' => $this->getLangs(),
                'choice_label' => $this->getChoiceCallable()
            ])
            ->add('secondAnotherLang', 'choice', [
                'label' => 'form.another_lang',
                'required' => false,
                'choices' => $this->getLangs(),
                'choice_label' => $this->getChoiceCallable()
            ])
            ->add('iytCertificate', 'checkbox', ['label' => 'form.iytCertificate'])
            ->add('ryaCertificate', 'checkbox', ['label' => 'form.ryaCertificate'])
            ->add('certificateNumber', 'text', ['label' => 'form.certificateNumber', 'constraints' => [new NotBlank()]])
            ->add('certificateIssueDate', 'text', ['label' => 'form.certificateIssueDate'])
            ->add('experienceYears', 'text', ['label' => 'form.experienceYears'])
            ->add('experienceMiles', 'text', ['label' => 'form.experienceMiles'])
            ->add('jobOffersAgree', 'checkbox', ['label' => 'form.jobOffersAgree', 'required' => false])
            ->add('emailSubscribtion', 'checkbox', ['label' => 'form.jobOffersAgree', 'required' => false])
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

        $builder->get('birthday')->addModelTransformer(new DateTimeToStringTransformer(null, null, 'Y-m-d'));
        $builder->get('photo')->addModelTransformer(new MediaToUploadedFileTransformer());

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => 'AppBundle\Entity\User',
                'intention'  => 'skipper_registration',
                'translation_domain' => 'AppBundle',
            ]
        );
    }

    public function getName()
    {
        return 'app_user_skipper_registration';
    }

    /**
     * @return array
     */
    protected function getLangs()
    {
        return [
            'english',
            'french',
            'spanish',
            'portuguese',
            'dutch',
            'italian',
            'japanese',
            'chinese',
        ];
    }

    /**
     * @return \Closure
     */
    protected function getChoiceCallable()
    {
        return function ($value, $key, $index) {
            return 'form.languages.' . $key;
        };
    }
}
