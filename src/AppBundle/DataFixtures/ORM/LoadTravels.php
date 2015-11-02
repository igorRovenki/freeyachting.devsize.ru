<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Aquatory;
use AppBundle\Entity\Country;
use AppBundle\Entity\Travel;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadTravels implements FixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < count($this->getNames()); $i++) {
            $dayPrice = rand(300, 500);
            $dateString = sprintf('%s-%s-%s', 2016, rand(1, 12), rand(1, 28));
            $dateStart = new \DateTime($dateString);
            $dateEnd = new \DateTime($dateString);
            $travelDays = rand(5, 14);

            $travel = new Travel();
            $travel->setName($this->getNames()[$i]);
            $travel->setParticipantLevel(Travel::PARTICIPANT_LEVEL_BEGINNER);
            $travel->setDayPrice($dayPrice);
            $travel->setDayPriceCurrency(Travel::PRICE_CURRENCY_USD);
            $travel->setWeekPrice($dayPrice * 7);
            $travel->setWeekPriceCurrency(Travel::PRICE_CURRENCY_USD);
            $travel->setChildren(false);
            $travel->setMinPlacesForTravel(10);
            $travel->setSkipperConfirmation(false);
            $travel->setDateStart($dateStart);
            $travel->setDateEnd($dateEnd->modify("+{$travelDays} days"));
            $travel->setTravelDays($travelDays);
            $travel->setCountry(new Country($this->getCountries()[$i]));
            $travel->setAquatory(new Aquatory($this->getCountries()[$i]));
            $travel->setSkipperPaymentMethod('Оплата наличными капитану');
            $travel->setWebsiteComission(0);
            $travel->setPlaceOfArrival($this->getCountries()[$i] . ' аэропорт');
            $travel->setPlaceOfDeparture($this->getCountries()[$i] . ' аэропорт');
            $travel->setTransferFromAirport('Групповой');
            $travel->setTransferPrice('20');
            $travel->setTransferPriceCurrency(Travel::PRICE_CURRENCY_USD);
            $travel->setTeamGatheringAddress($this->getCountries()[$i] . ' street house #' . ($i + 1));
            $travel->setTeamGatheringLatitude(rand(5, 40));
            $travel->setTeamGatheringLongitude(rand(5, 40));
            $travel->setTeamGatheringTime($dateStart->modify('+12 hours'));
            $travel->setIncluded('Акваланги');
            $travel->setExcluded('Полотенца');

            if ($i % 2 == 0) {
                $travel->setHotOffers(true);
                $travel->setPercentOfDiscount(5);
                $travel->setTimeForDiscountActivation(7);
                $travel->setType(Travel::TYPE_STUDING);
            } else {
                $travel->setType(Travel::TYPE_REST);
            }
            $manager->persist($travel);
        }
        $manager->flush();
    }

    private function getNames()
    {
        return array_map(function ($country) {
            return $country . ' 2016';
        }, $this->getCountries());
    }

    private function getCountries()
    {
        return [
            'Испания',
            'Италия',
            'Турция',
            'Венеция',
            'Кипр',
            'Крит',
            'Тунис',
            'Афины',
            'Египет',
            'Греция',
        ];
    }
}
