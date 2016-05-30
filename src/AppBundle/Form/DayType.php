<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DayType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cityDeparture', 'text', ['label' => 'travel.form.days.city_departure'])
            ->add('cityArrival', 'text', ['label' => 'travel.form.days.city_arrival'])
            ->add('cityDepartureLatitude', 'text')
            ->add('cityDepartureLongitude', 'text')
            ->add('cityArrivalLatitude', 'text')
            ->add('cityArrivalLongitude', 'text')
            ->add('routeLength', 'text', ['label' => 'travel.form.days.route_length'])
            ->add('fullDescription', 'textarea', ['label' => 'travel.form.days.full_description', 'required' => false])
            ->add('date', 'text', ['label' => 'travel.form.days.date'])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => 'AppBundle\Entity\Day',
                'translation_domain' => 'AppBundle'
            ]
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_day';
    }
}
