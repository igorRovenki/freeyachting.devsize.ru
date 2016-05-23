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
            ->add('hotOffers', 'choice', [
                'label' => 'travel.form.hot_offers',
                'choices' => [0, 1],
                'choice_label' => function ($value, $key, $index) {
                    return 'form.yes_no.' . $key;
                }
            ])
            ->add('percentOfDiscount', 'choice', [
                'label' => 'travel.form.percent_of_discount',
                'choices' => [5, 10, 15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65, 70, 75, 80, 85, 90, 95]
            ])
            ->add('timeForDiscountActivation', 'choice', [
                'label' => 'travel.form.time_for_discount_activation',
                'choices' => range(1, 12)
            ])
            ->add('minPlacesForTravel', 'choice', [
                'label' => 'travel.form.min_places_for_travel',
                'choices' => range(1, 10)
            ])
            ->add('skipperConfirmation', 'choice', [
                'label' => 'travel.form.skipper_confirmation',
                'choices' => [0, 1],
                'choice_label' => function ($value, $key, $index) {
                    return 'form.yes_no.' . $key;
                }
            ])
            ->add('dateStart', 'text', ['label' => 'travel.form.date_start'])
            ->add('dateEnd', 'text', ['label' => 'travel.form.date_end'])
            ->add('country', 'entity', [
                'class' => 'AppBundle\Entity\Country',
                'label' => 'travel.form.country',
                'placeholder' => '',
                'empty_data' => null,
            ])
            ->add('aquatory', 'entity', [
                'class' => 'AppBundle\Entity\Aquatory',
                'label' => 'travel.form.aquatory',
                'placeholder' => '',
                'empty_data' => null,
            ])
            ->add('yacht', new YachtType(), [
                'label' => 'travel.form.yacht_info',
                'data_class' => 'AppBundle\Entity\Yacht'
            ])
            ->add('skipperPaymentMethod', 'choice', [
                'label' => 'travel.form.skipper_payment_method_title',
                'choices' => [
                    'via_site',
                    'cash',
                    'another_way',
                ],
                'choice_label' => function ($value, $key, $index) {
                    return 'travel.form.skipper_payment_method.' . $key;
                }
            ])
            ->add('websiteComission', 'text', ['label' => 'travel.form.website_comission'])
            ->add('placeOfArrival', 'text', ['label' => 'travel.form.place_of_arrival'])
            ->add('placeOfDeparture', 'text', ['label' => 'travel.form.place_of_departure'])
            ->add('transferFromAirport', 'choice', [
                'label' => 'travel.form.transfer_from_airport_title',
                'choices' => [
                    'group',
                    'individual',
                    'no_transfer',
                ],
                'choice_label' => function ($value, $key, $index) {
                    return 'travel.form.transfer_from_airport.' . $key;
                }
            ])
            ->add('transferPrice', 'text', ['label' => 'travel.form.transfer_price'])
            ->add('transferPriceCurrency', 'choice', [
                'label' => 'form.currency_title',
                'choices' => [
                    'EUR',
                    'USD',
                    'RUB',
                ],
                'choice_label' => function ($value, $key, $index) {
                    return 'form.currency.' . $key;
                }
            ])
            ->add('teamGatheringAddress', 'textarea', ['label' => 'travel.form.team_gathering_address'])
            ->add('teamGatheringLatitude', 'text')
            ->add('teamGatheringLongitude', 'text')
            ->add('teamGatheringTime', 'time', ['label' => 'travel.team_gathering_time'])
            ->add('included', 'textarea', ['label' => 'travel.form.included'])
            ->add('excluded', 'textarea', ['label' => 'travel.form.excluded'])
            ->add('photos', 'file', ['data_class' => null])
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
