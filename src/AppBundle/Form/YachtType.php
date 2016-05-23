<?php

namespace AppBundle\Form;

use AppBundle\Entity\Yacht;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class YachtType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('shipType', 'choice', [
                'label' => 'travel.form.yacht.ship_type_title',
                'choices' => [
                    Yacht::SHIP_TYPE_CATAMARAN,
                    Yacht::SHIP_TYPE_YACHT,
                    Yacht::SHIP_TYPE_OTHER,
                ],
                'choice_label' => function ($value, $key, $index) {
                    return 'travel.form.yacht.ship_type.' . $key;
                }
            ])
            ->add('yachtType', 'choice', [
                'label' => 'travel.form.yacht.yacht_type_title',
                'choices' => [
                    Yacht::YACHT_TYPE_SAIL_MOTOR,
                    Yacht::YACHT_TYPE_SAIL,
                    Yacht::YACHT_TYPE_MOTOR,
                ],
                'choice_label' => function ($value, $key, $index) {
                    return 'travel.form.yacht.yacht_type.' . $key;
                }
            ])
            ->add('manufacturer', 'choice', [
                'label' => 'travel.form.yacht.manufacturer_title',
                'choices' => [
                    Yacht::MANUFACTURER_BAVARIA_38
                ],
                'choice_label' => function ($value, $key, $index) {
                    return 'travel.form.yacht.manufacturer.' . $key;
                }
            ])
            ->add('yearOfProduction', 'text', ['label' => 'travel.form.yacht.year_of_production', 'required' => false])
            ->add('yachtLengthFt')
            ->add('yachtLengthM')
            ->add('bathroomsNumber', 'text', ['label' => 'travel.form.yacht.bathrooms_number', 'required' => false])
            ->add('doubleCabinsNumber', 'text', ['label' => 'travel.form.yacht.double_cabins_number'])
            ->add('singleCabinsNumber', 'text', ['label' => 'travel.form.yacht.single_cabins_number'])
            ->add('description', 'textarea', ['label' => 'travel.form.yacht.description'])
            ->add('features', 'textarea', ['label' => 'travel.form.yacht.features'])
            ->add('schemaImage', 'entity', [
                'class' => 'Application\Sonata\MediaBundle\Entity\Media',
                'placeholder' => '',
                'empty_data' => null,
            ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => 'AppBundle\Entity\Yacht'
            ]
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_yacht';
    }
}
