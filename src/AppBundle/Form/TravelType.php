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
                    'choices' => [
                        Travel::TYPE_REST => 'travel.type.' . Travel::TYPE_REST,
                        Travel::TYPE_STUDING => 'travel.type.' . Travel::TYPE_STUDING,
                        Travel::TYPE_REGATTA_PARTICIPATION => 'travel.type.' . Travel::TYPE_REGATTA_PARTICIPATION,
                    ],
                    'label' => 'travel.type_label'
                ]
            )
            ->add('participantLevel', 'choice', [
                'label' => 'travel.form.participant_level_title',
                'required' => false,
                'choices' => [
                    'advanced',
                    'averaged',
                    'first',
                ],
                'choice_label' => function ($value, $key, $index) {
                    return 'travel.form.participant_level.' . $key;
                },
            ])
            ->add('dayPrice', 'text', ['label' => 'travel.form.day_price'])
            ->add('dayPriceCurrency', 'choice', [
                'label' => 'travel.form.day_price_currency',
                'choices' => [
                    Travel::PRICE_CURRENCY_EUR => 'travel.form.currency.' . Travel::PRICE_CURRENCY_EUR,
                    Travel::PRICE_CURRENCY_USD => 'travel.form.currency.' . Travel::PRICE_CURRENCY_USD,
                    Travel::PRICE_CURRENCY_RUB => 'travel.form.currency.' . Travel::PRICE_CURRENCY_RUB,
                ]
            ])
            ->add('weekPrice', 'text', ['label' => 'travel.form.week_price'])
            ->add('weekPriceCurrency', 'choice', [
                'label' => 'travel.form.week_price_currency',
                'choices' => [
                    Travel::PRICE_CURRENCY_EUR => 'travel.form.currency.' . Travel::PRICE_CURRENCY_EUR,
                    Travel::PRICE_CURRENCY_USD => 'travel.form.currency.' . Travel::PRICE_CURRENCY_USD,
                    Travel::PRICE_CURRENCY_RUB => 'travel.form.currency.' . Travel::PRICE_CURRENCY_RUB,
                ]
            ])
            ->add('children', 'choice', [
                'label' => 'travel.form.has_children_title',
                'choices' => [0, 1],
                'choice_label' => function ($value, $key, $index) {
                    return 'travel.form.has_children.' . $key;
                },
            ])
            ->add('minChildAge', 'choice', [
                'choices' => range(1, 21),
                'label' => 'travel.form.min_child_age',
                'empty_data' => null
            ])
            ->add('hotOffers')
            ->add('percentOfDiscount')
            ->add('timeForDiscountActivation')
            ->add('minPlacesForTravel')
            ->add('skipperConfirmation')
            ->add('dateStart')
            ->add('dateEnd')
            ->add('country')
            ->add('aquatory')
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
