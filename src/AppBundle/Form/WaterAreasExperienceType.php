<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WaterAreasExperienceType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', 'hidden')
            ->add('country', 'entity', [
                'class' => 'AppBundle\Entity\Country',
                'label' => 'form.region_water',
                'placeholder' => '',
                'empty_data' => null,
            ])
            ->add('aquatory', 'entity', [
                'class' => 'AppBundle\Entity\Aquatory',
                'label' => 'form.region_aquatory',
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
                'data_class' => 'AppBundle\Entity\WaterAreasExperience',
                'translation_domain' => 'AppBundle'
            ]
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'app_water_arease_xperience';
    }
}
