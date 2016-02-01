<?php

namespace AppBundle\Form;

use AppBundle\Entity\Traveller;
use AppBundle\Form\DataTransformer\MediaToUploadedFileTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TravellerType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fullName', 'text', ['label' => 'traveller.full_name'])
            ->add('email', 'text', ['label' => 'traveller.email'])
            ->add('phone', 'text', ['label' => 'traveller.phone'])
            ->add('age', 'text', ['label' => 'traveller.age'])
            ->add('gender', 'hidden', [
                'label' => 'traveller.gender',
                'attr' => ['value' => Traveller::GENDER_M]
            ])
            ->add('initiator', 'hidden', ['attr' => ['value' => 1]])
            ->add('children', 'choice', [
                'label' => 'traveller.children',
                'choices' => [
                    'form.yes' => true,
                    'form.no' => false,
                ],
                'choices_as_values' => true,
                'preferred_choices' => [false]
            ])
            ->add('childNumber', 'choice', [
                'choices' => range(1, 10)
            ])
            ->add('childMinAge', 'choice', [
                'choices' => range(1, 21),
                'label' => 'traveller.min_child_age'
            ])
            ->add('oppositeGenderLiving', 'hidden', ['attr' => ['value' => 1]])
            ->add('livingWithParents', 'hidden', [
                'label' => 'traveller.living_with_parents',
                'attr' => ['value' => 0]
            ])
            ->add('type', 'hidden', ['attr' => ['value' => Traveller::TYPE_ADULT]])
            ->add('placeNumber', 'text', ['label' => 'traveller.place_number'])
            ->add('photo', 'file', ['required' => false])
        ;
        $builder->get('photo')->addModelTransformer(new MediaToUploadedFileTransformer());
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Traveller',
            'translation_domain' => 'AppBundle',
        ]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'app_traveller';
    }
}
