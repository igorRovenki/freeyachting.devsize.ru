<?php

namespace AppBundle\Form;

use AppBundle\Entity\Travel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TravelType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', ['label' => 'travel.name'])
            ->add(
                'type',
                'choice',
                [
                    'choices' =>
                    [
                        Travel::TYPE_REST => 'travel.type.' . Travel::TYPE_REST,
                        Travel::TYPE_STUDING => 'travel.type.' . Travel::TYPE_STUDING,
                        Travel::TYPE_REGATTA_PARTICIPATION => 'travel.type.' . Travel::TYPE_REGATTA_PARTICIPATION,
                    ],
                    'label' => 'travel.type_label'
                ]
            )
            ->add('participantLevel')
            ->add('dayPrice')
            ->add('dayPriceCurrency')
            ->add('weekPrice')
            ->add('weekPriceCurrency')
            ->add('children')
            ->add('minChildAge')
            ->add('hotOffers')
            ->add('percentOfDiscount')
            ->add('timeForDiscountActivation')
            ->add('minPlacesForTravel')
            ->add('skipperConfirmation')
            ->add('dateStart')
            ->add('dateEnd')
            ->add('daysCount')
            ->add('country')
            ->add('aquatory')
            ->add('yacht')
            ->add('skipperPaymentMethod')
            ->add('websiteComission')
            ->add('placeOfArrival')
            ->add('placeOfDeparture')
            ->add('transferFromAirport')
            ->add('transferPrice')
            ->add('transferPriceCurrency')
            ->add('teamGatheringAddress')
            ->add('teamGatheringLatitude')
            ->add('teamGatheringLongitude')
            ->add('teamGatheringTime')
            ->add('included')
            ->add('excluded')
            ->add('photos')
            ->add('days')
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Travel',
            'translation_domain' => 'AppBundle'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_travel';
    }
}
