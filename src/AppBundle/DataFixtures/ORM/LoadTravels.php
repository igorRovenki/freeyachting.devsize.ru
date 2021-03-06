<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Aquatory;
use AppBundle\Entity\Booking;
use AppBundle\Entity\Country;
use AppBundle\Entity\Day;
use AppBundle\Entity\Travel;
use AppBundle\Entity\Traveller;
use AppBundle\Entity\Yacht;
use Application\Sonata\MediaBundle\Entity\Media;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Filesystem\Filesystem;

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
        $this->prepareFilesystem();

        foreach ($this->getCountries() as $key => $country) {
            $dayPrice = rand(300, 500);
            $dateString = sprintf('%s-%s-%s', 2016, rand(1, 12), rand(1, 28));
            $dateStart = new \DateTime($dateString);
            $dateEnd = new \DateTime($dateString);
            $daysCount = rand(5, 14);

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
            $travel->setDateEnd($dateEnd->modify("+{$daysCount} days"));
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
            $travel->setType($this->getTypes()[rand(0, 2)]);

            if (rand(0, 1) == 0) {
                $travel->setHotOffers(true);
                $travel->setPercentOfDiscount(5);
                $travel->setTimeForDiscountActivation(7);
                $travel->setChildren(true);
                $travel->setMinChildAge(rand(1, 10));
            }
            $this->loadPhotos($travel, $key);
            $this->loadDays($travel);
            $this->loadYacht($travel);
            $this->loadBookings($travel);

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

    private function loadDays(Travel $travel)
    {
        $date = clone($travel->getDateStart());
        $date->modify('-1 day');
        for ($i = 0; $i < $travel->getDaysCount() + 1; $i++) {
            $day = new Day();
            $day->setCityArrival('Рим');
            $day->setCityDeparture('Катания');
            $day->setCityDepartureLatitude($this->getGeoLocations()[$i]['lat']);
            $day->setCityDepartureLongitude($this->getGeoLocations()[$i]['lng']);
            $day->setRouteLength(rand(70, 200));
            $day->setFullDescription(
                'Аренда катамарана в Черногории позволит вам свободно перемещаться по всей
                акватории, обойти все острова и заливы, насладиться уединенными гаванями и пляжами, а также получить
                удовольствие от морских развлечений, как рыбалка, снорклинг и др. – все это включено в круизную
                программу. Наша база находится в трех километрах от международного аэропорта Тиват (марина MarinaSolila)
                и оснащена всем необходимым для обслуживания яхт.'
            );
            $day->setDate(clone($date->modify('+1 day')));
            $travel->addDay($day);
        }
    }

    private function getGeoLocations()
    {
        return [
            ['lat' => '41.993540', 'lng' => '12.524000'],
            ['lat' => '41.271093', 'lng' => '11.718615'],
            ['lat' => '40.641434', 'lng' => '11.575792'],
            ['lat' => '39.845113', 'lng' => '11.285424'],
            ['lat' => '39.442977', 'lng' => '10.415022'],
            ['lat' => '39.164592', 'lng' => '9.138432'],
            ['lat' => '38.459249', 'lng' => '8.825087'],
            ['lat' => '36.962828', 'lng' => '8.372478'],
            ['lat' => '37.415846', 'lng' => '9.683884'],
            ['lat' => '37.092539', 'lng' => '11.088133'],
            ['lat' => '36.758549', 'lng' => '11.946930'],
            ['lat' => '37.196286', 'lng' => '13.518334'],
            ['lat' => '35.962060', 'lng' => '14.472771'],
            ['lat' => '36.988654', 'lng' => '15.414813'],
            ['lat' => '37.580377', 'lng' => '15.030559'],

        ];
    }

    private function getTypes()
    {
        return [
            0 => Travel::TYPE_REST,
            1 => Travel::TYPE_STUDING,
            2 => Travel::TYPE_REGATTA_PARTICIPATION,
        ];
    }

    private function loadYacht(Travel $travel)
    {
        $yacht = new Yacht();
        $yacht->setShipType(Yacht::SHIP_TYPE_YACHT);
        $yacht->setYachtType(Yacht::YACHT_TYPE_SAIL_MOTOR);
        $yacht->setManufacturer('Bavaria Yachts');
        $yacht->setYearOfProduction(rand(2001, 2015));
        $ft = rand(25, 50);
        $yacht->setYachtLengthFt($ft);
        $yacht->setYachtLengthM($ft * 0.30);
        $yacht->setDoubleCabinsNumber(4);
        $yacht->setSingleCabinsNumber(0);
        $yacht->setBathroomsNumber(2);
        $yacht->setDescription('Это особенная яхта!');
        $yacht->setFeatures(
            'Аренда катамарана в Черногории позволит вам свободно перемещаться по всей
            акватории, обойти все острова и заливы, насладиться уединенными гаванями и пляжами, а также получить
            удовольствие от морских развлечений, как рыбалка, снорклинг и др. – все это включено в круизную
            программу. Наша база находится в трех километрах от международного аэропорта Тиват (марина MarinaSolila)
            и оснащена всем необходимым для обслуживания яхт.'
        );
        $mediaManager = $this->container->get('sonata.media.manager.media');
        $schemaImage = $mediaManager->findOneBy(['context' => 'yacht']);

        if (!$schemaImage) {
            $schemaImage = new Media();
            $schemaImage->setBinaryContent(__DIR__ . '/../images/schemes/01.jpg');
            $schemaImage->setContext('yacht');
            $schemaImage->setProviderName('sonata.media.provider.image');
            $mediaManager->save($schemaImage);
        }
        $yacht->setSchemaImage($schemaImage);
        $travel->setYacht($yacht);
    }

    private function loadBookings(Travel $travel)
    {
        $booking = new Booking();

        for ($i = 0; $i < rand(rand(3, 6), 6); $i++) {
            if ($i == 0) {
                continue;
            }
            $traveller = new Traveller();
            $traveller->setFullName($this->getTravellers()[$i]['full_name']);
            $traveller->setAge($this->getTravellers()[$i]['age']);
            $traveller->setGender($this->getTravellers()[$i]['gender']);
            $traveller->setEmail('traveller@gmail.com');
            $traveller->setPlaceNumber($i + 1);
            $traveller->setType(Traveller::TYPE_ADULT);

            if (rand(0, 1) == 0) {
                $traveller->setLivingWithParents(true);
                $traveller->setOppositeGenderLiving(false);
                $traveller->setChildren(true);
                $traveller->setChildMinAge(2);
                $traveller->setChildNumber(rand(1, 2));
            } else {
                $traveller->setLivingWithParents(false);
                $traveller->setOppositeGenderLiving(true);
                $traveller->setChildren(false);
            }
            if ($this->getTravellers()[$i]['photo']) {
                $photo = new Media();
                $photo->setBinaryContent($this->getTravellers()[$i]['photo']);
                $photo->setContext('traveller');
                $photo->setProviderName('sonata.media.provider.image');
                $traveller->setPhoto($photo);
            }

            $booking->addTraveller($traveller);
            $booking->setTravel($travel);
        }
        $travel->addBooking($booking);
    }

    private function prepareFilesystem()
    {
        $fs = new Filesystem();
        $dirs = [
            __DIR__ . '/../../../../web/uploads/media/travel',
            __DIR__ . '/../../../../web/uploads/media/traveller',
            __DIR__ . '/../../../../web/uploads/media/yacht',
            __DIR__ . '/../../../../web/uploads/media/user',
        ];
        if ($fs->exists($dirs)) {
            $fs->remove($dirs);
        }
    }

    /**
     * @return array
     */
    private function getTravellers()
    {
        return [
            [
                'full_name' => 'Иванов Александр Сергеевич',
                'gender' => Traveller::GENDER_M,
                'photo' => __DIR__ . '/../images/travellers/1.jpg',
                'age' => '25 лет',
            ],
            [
                'full_name' => 'Новый Аркадий Иванович',
                'gender' => Traveller::GENDER_M,
                'photo' => null,
                'age' => '21 год',
            ],
            [
                'full_name' => 'Иванова Наталья Андреевна',
                'gender' => Traveller::GENDER_W,
                'photo' => __DIR__ . '/../images/travellers/2.jpg',
                'age' => '25 лет',
            ],
            [
                'full_name' => 'Новикова Зинаида Петровна',
                'gender' => Traveller::GENDER_W,
                'photo' => null,
                'age' => '31 год',
            ],
            [
                'full_name' => 'Белый Иван Алексеевич',
                'gender' => Traveller::GENDER_M,
                'photo' => __DIR__ . '/../images/travellers/3.jpg',
                'age' => '25 лет',
            ],
            [
                'full_name' => 'Сидорова Елена Михайловна',
                'gender' => Traveller::GENDER_W,
                'photo' => __DIR__ . '/../images/travellers/4.jpg',
                'age' => '25 лет',
            ],
            [
                'full_name' => 'Зеньков Миша',
                'gender' => Traveller::GENDER_M,
                'photo' => __DIR__ . '/../images/travellers/5.jpg',
                'age' => '4 года',
            ],
        ];
    }
}
