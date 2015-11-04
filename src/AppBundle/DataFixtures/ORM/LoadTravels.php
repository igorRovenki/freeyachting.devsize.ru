<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Aquatory;
use AppBundle\Entity\Country;
use AppBundle\Entity\Travel;
use Application\Sonata\MediaBundle\Entity\Media;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadTravels implements FixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->getCountries() as $key => $country) {
            $dayPrice = rand(300, 500);
            $dateString = sprintf('%s-%s-%s', 2016, rand(1, 12), rand(1, 28));
            $dateStart = new \DateTime($dateString);
            $dateEnd = new \DateTime($dateString);
            $travelDays = rand(5, 14);

            $travel = new Travel();
            $travel->setName($this->getNames()[$key]);
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
            $travel->setCountry(new Country($this->getCountries()[$key]));
            $travel->setAquatory(new Aquatory($this->getCountries()[$key]));
            $travel->setSkipperPaymentMethod('Оплата наличными капитану');
            $travel->setWebsiteComission(0);
            $travel->setPlaceOfArrival($this->getCountries()[$key] . ' аэропорт');
            $travel->setPlaceOfDeparture($this->getCountries()[$key] . ' аэропорт');
            $travel->setTransferFromAirport('Групповой');
            $travel->setTransferPrice('20');
            $travel->setTransferPriceCurrency(Travel::PRICE_CURRENCY_USD);
            $travel->setTeamGatheringAddress($this->getCountries()[$key] . ' street house #' . ($key + 1));
            $travel->setTeamGatheringLatitude(rand(5, 40));
            $travel->setTeamGatheringLongitude(rand(5, 40));
            $travel->setTeamGatheringTime($dateStart->modify('+12 hours'));
            $travel->setIncluded('Акваланги');
            $travel->setExcluded('Полотенца');

            if ($key % 2 == 0) {
                $travel->setHotOffers(true);
                $travel->setPercentOfDiscount(5);
                $travel->setTimeForDiscountActivation(7);
                $travel->setType(Travel::TYPE_STUDING);
            } else {
                $travel->setType(Travel::TYPE_REST);
            }
            $this->loadPhotos($travel, $key);

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
            'spain' => 'Испания',
            'italy' => 'Италия',
            'turkey' => 'Турция',
            'venice' => 'Венеция',
            'cyprus' => 'Кипр',
            'crete' => 'Крит',
            'tunis' => 'Тунис',
            'athens' => 'Афины',
            'egipt' => 'Египет',
            'greece' => 'Греция',
        ];
    }

    private function loadPhotos(Travel $travel, $country)
    {
        foreach ([0, 1] as $number) {
            $photo = new Media();
            $photo->setBinaryContent(__DIR__ . '/../images/' . $country . $number . '.jpg');
            $photo->setContext('travel');
            $photo->setProviderName('sonata.media.provider.image');
            $mediaManager = $this->container->get('sonata.media.manager.media');
            $mediaManager->save($photo);
            $travel->addPhoto($photo);
        }
    }

    /**
     * Sets the Container.
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     *
     * @api
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}
