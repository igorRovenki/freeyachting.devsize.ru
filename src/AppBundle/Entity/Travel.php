<?php

namespace AppBundle\Entity;

use Application\Sonata\MediaBundle\Entity\Media;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Travel
 *
 * @ORM\Table(name="travels")
 * @ORM\Entity(repositoryClass="TravelRepository")
 */
class Travel
{
    const TYPE_REST = 'rest';
    const TYPE_STUDING = 'studing';
    const TYPE_REGATTA_PARTICIPATION = 'regatta_participation';

    const PARTICIPANT_LEVEL_BEGINNER = 'beginner';
    const PARTICIPANT_LEVEL_ADVANCED = 'advanced';

    const PRICE_CURRENCY_EUR = 'EUR';
    const PRICE_CURRENCY_USD = 'USD';
    const PRICE_CURRENCY_RUB = 'RUB';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=64)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="participant_level", type="string", length=64)
     */
    private $participantLevel;

    /**
     * @var string
     *
     * @ORM\Column(name="day_price", type="decimal")
     */
    private $dayPrice;

    /**
     * @var string
     *
     * @ORM\Column(name="day_price_currency", type="string", length=32)
     */
    private $dayPriceCurrency;

    /**
     * @var string
     *
     * @ORM\Column(name="week_price", type="decimal")
     */
    private $weekPrice;

    /**
     * @var string
     *
     * @ORM\Column(name="week_price_currency", type="string", length=32)
     */
    private $weekPriceCurrency;

    /**
     * @var boolean
     *
     * @ORM\Column(name="children", type="boolean")
     */
    private $children;

    /**
     * @var integer
     *
     * @ORM\Column(name="min_child_age", type="smallint", nullable=true)
     */
    private $minChildAge;

    /**
     * @var boolean
     *
     * @ORM\Column(name="hot_offers", type="boolean")
     */
    private $hotOffers;

    /**
     * @var integer
     *
     * @ORM\Column(name="percent_of_discount", type="smallint")
     */
    private $percentOfDiscount;

    /**
     * @var integer
     *
     * @ORM\Column(name="time_for_discount_activation", type="smallint", nullable=true)
     */
    private $timeForDiscountActivation;

    /**
     * @var integer
     *
     * @ORM\Column(name="min_places_for_travel", type="smallint")
     */
    private $minPlacesForTravel;

    /**
     * @var boolean
     *
     * @ORM\Column(name="skipper_confirmation", type="boolean")
     */
    private $skipperConfirmation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_start", type="datetime")
     */
    private $dateStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_end", type="datetime")
     */
    private $dateEnd;

    /**
     * @var integer
     *
     * @ORM\Column(name="days_count", type="smallint")
     */
    private $daysCount;

    /**
     * @var Country
     *
     * @ORM\ManyToOne(targetEntity="Country", cascade={"persist"})
     * @ORM\JoinColumn(name="country_id", referencedColumnName="id")
     */
    private $country;

    /**
     * @var Aquatory
     *
     * @ORM\ManyToOne(targetEntity="Aquatory", cascade={"persist"})
     * @ORM\JoinColumn(name="aquatory_id", referencedColumnName="id")
     */
    private $aquatory;

    /**
     * @var \stdClass
     *
     * @ORM\Column(name="yacht", type="object")
     */
    private $yacht;

    /**
     * @var string
     *
     * @ORM\Column(name="skipper_payment_method", type="string", length=64)
     */
    private $skipperPaymentMethod;

    /**
     * @var integer
     *
     * @ORM\Column(name="website_comission", type="smallint")
     */
    private $websiteComission;

    /**
     * @var string
     *
     * @ORM\Column(name="place_of_arrival", type="string", length=255)
     */
    private $placeOfArrival;

    /**
     * @var string
     *
     * @ORM\Column(name="place_of_departure", type="string", length=255)
     */
    private $placeOfDeparture;

    /**
     * @var string
     *
     * @ORM\Column(name="transfer_from_airport", type="string", length=64)
     */
    private $transferFromAirport;

    /**
     * @var string
     *
     * @ORM\Column(name="transfer_price", type="decimal")
     */
    private $transferPrice;

    /**
     * @var string
     *
     * @ORM\Column(name="transfer_price_currency", type="string", length=64)
     */
    private $transferPriceCurrency;

    /**
     * @var string
     *
     * @ORM\Column(name="team_gathering_address", type="text", length=1000)
     */
    private $teamGatheringAddress;

    /**
     * @var string
     *
     * @ORM\Column(name="team_gathering_latitude", type="string", length=255)
     */
    private $teamGatheringLatitude;

    /**
     * @var string
     *
     * @ORM\Column(name="team_gathering_longitude", type="string", length=255)
     */
    private $teamGatheringLongitude;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="team_gathering_time", type="time")
     */
    private $teamGatheringTime;

    /**
     * @var string
     *
     * @ORM\Column(name="included", type="text", length=1000)
     */
    private $included;

    /**
     * @var string
     *
     * @ORM\Column(name="excluded", type="text", length=1000)
     */
    private $excluded;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Application\Sonata\MediaBundle\Entity\Media")
     * @ORM\JoinTable(name="travels_photos",
     *  joinColumns={@ORM\JoinColumn(name="travel_id", referencedColumnName="id")},
     *  inverseJoinColumns={@ORM\JoinColumn(name="image_id", referencedColumnName="id")}
     * )
     */
    private $photos;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Day", cascade={"persist"})
     * @ORM\JoinTable(name="travel_has_days",
     *  joinColumns={@ORM\JoinColumn(name="travel_id", referencedColumnName="id")},
     *  inverseJoinColumns={@ORM\JoinColumn(name="day_id", referencedColumnName="id", unique=true)}
     * )
     */
    private $days;

    public function __construct()
    {
        $this->hotOffers = false;
        $this->children = false;
        $this->websiteComission = 0;
        $this->skipperConfirmation = false;
        $this->percentOfDiscount = 0;
        $this->photos = new ArrayCollection();
        $this->days = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Travel
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Travel
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set participantLevel
     *
     * @param string $participantLevel
     * @return Travel
     */
    public function setParticipantLevel($participantLevel)
    {
        $this->participantLevel = $participantLevel;

        return $this;
    }

    /**
     * Get participantLevel
     *
     * @return string
     */
    public function getParticipantLevel()
    {
        return $this->participantLevel;
    }

    /**
     * Set dayPrice
     *
     * @param string $dayPrice
     * @return Travel
     */
    public function setDayPrice($dayPrice)
    {
        $this->dayPrice = $dayPrice;

        return $this;
    }

    /**
     * Get dayPrice
     *
     * @return string
     */
    public function getDayPrice()
    {
        return $this->dayPrice;
    }

    /**
     * Set dayPriceCurrency
     *
     * @param string $dayPriceCurrency
     * @return Travel
     */
    public function setDayPriceCurrency($dayPriceCurrency)
    {
        $this->dayPriceCurrency = $dayPriceCurrency;

        return $this;
    }

    /**
     * Get dayPriceCurrency
     *
     * @return string
     */
    public function getDayPriceCurrency()
    {
        return $this->dayPriceCurrency;
    }

    /**
     * Set weekPrice
     *
     * @param string $weekPrice
     * @return Travel
     */
    public function setWeekPrice($weekPrice)
    {
        $this->weekPrice = $weekPrice;

        return $this;
    }

    /**
     * Get weekPrice
     *
     * @return string
     */
    public function getWeekPrice()
    {
        return $this->weekPrice;
    }

    /**
     * Set weekPriceCurrency
     *
     * @param string $weekPriceCurrency
     * @return Travel
     */
    public function setWeekPriceCurrency($weekPriceCurrency)
    {
        $this->weekPriceCurrency = $weekPriceCurrency;

        return $this;
    }

    /**
     * Get weekPriceCurrency
     *
     * @return string
     */
    public function getWeekPriceCurrency()
    {
        return $this->weekPriceCurrency;
    }

    /**
     * Set children
     *
     * @param boolean $children
     * @return Travel
     */
    public function setChildren($children)
    {
        $this->children = $children;

        return $this;
    }

    /**
     * Get children
     *
     * @return boolean
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set minChildAge
     *
     * @param integer $minChildAge
     * @return Travel
     */
    public function setMinChildAge($minChildAge)
    {
        $this->minChildAge = $minChildAge;

        return $this;
    }

    /**
     * Get minChildAge
     *
     * @return integer
     */
    public function getMinChildAge()
    {
        return $this->minChildAge;
    }

    /**
     * Set hotOffers
     *
     * @param boolean $hotOffers
     * @return Travel
     */
    public function setHotOffers($hotOffers)
    {
        $this->hotOffers = $hotOffers;

        return $this;
    }

    /**
     * Get hotOffers
     *
     * @return boolean
     */
    public function getHotOffers()
    {
        return $this->hotOffers;
    }

    /**
     * Set percentOfDiscount
     *
     * @param integer $percentOfDiscount
     * @return Travel
     */
    public function setPercentOfDiscount($percentOfDiscount)
    {
        $this->percentOfDiscount = $percentOfDiscount;

        return $this;
    }

    /**
     * Get percentOfDiscount
     *
     * @return integer
     */
    public function getPercentOfDiscount()
    {
        return $this->percentOfDiscount;
    }

    /**
     * Set timeForDiscountActivation
     *
     * @param integer $timeForDiscountActivation
     * @return Travel
     */
    public function setTimeForDiscountActivation($timeForDiscountActivation)
    {
        $this->timeForDiscountActivation = $timeForDiscountActivation;

        return $this;
    }

    /**
     * Get timeForDiscountActivation
     *
     * @return integer
     */
    public function getTimeForDiscountActivation()
    {
        return $this->timeForDiscountActivation;
    }

    /**
     * Set minPlacesForTravel
     *
     * @param integer $minPlacesForTravel
     * @return Travel
     */
    public function setMinPlacesForTravel($minPlacesForTravel)
    {
        $this->minPlacesForTravel = $minPlacesForTravel;

        return $this;
    }

    /**
     * Get minPlacesForTravel
     *
     * @return integer
     */
    public function getMinPlacesForTravel()
    {
        return $this->minPlacesForTravel;
    }

    /**
     * Set skipperConfirmation
     *
     * @param boolean $skipperConfirmation
     * @return Travel
     */
    public function setSkipperConfirmation($skipperConfirmation)
    {
        $this->skipperConfirmation = $skipperConfirmation;

        return $this;
    }

    /**
     * Get skipperConfirmation
     *
     * @return boolean
     */
    public function getSkipperConfirmation()
    {
        return $this->skipperConfirmation;
    }

    /**
     * Set dateStart
     *
     * @param \DateTime $dateStart
     * @return Travel
     */
    public function setDateStart($dateStart)
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    /**
     * Get dateStart
     *
     * @return \DateTime
     */
    public function getDateStart()
    {
        return $this->dateStart;
    }

    /**
     * Set dateEnd
     *
     * @param \DateTime $dateEnd
     * @return Travel
     */
    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    /**
     * @todo refactor this to use Intl extension
     * @return string
     */
    public function getDates()
    {
        $months = ['Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн', 'Июл', 'Авг', 'Сен', 'Окт',  'Нояб', 'Дек'];

        return sprintf(
            '%s %s - %s %s',
            (int)$this->dateStart->format('d'),
            $months[(int)$this->dateStart->format('m') - 1],
            (int)$this->dateEnd->format('d'),
            $months[(int)$this->dateEnd->format('m') - 1]
        );
    }

    /**
     * @todo refactor this to use Intl extension
     * @return string
     */
    public function getDetailDates()
    {
        $months = [
            'Января',
            'Февраля',
            'Марта',
            'Апреля',
            'Мая',
            'Июня',
            'Июля',
            'Августа',
            'Сентября',
            'Октября',
            'Ноября',
            'Декабря'
        ];

        return sprintf(
            '%s %s - %s %s %s',
            (int)$this->dateStart->format('d'),
            $months[(int)$this->dateStart->format('m') - 1],
            (int)$this->dateEnd->format('d'),
            $months[(int)$this->dateEnd->format('m') - 1],
            $this->dateEnd->format('Y')
        );
    }

    /**
     * Get dateEnd
     *
     * @return \DateTime
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * Set travelDays
     *
     * @param integer $daysCount
     * @return Travel
     */
    public function setDaysCount($daysCount)
    {
        $this->daysCount = $daysCount;

        return $this;
    }

    /**
     * Get travelDays
     *
     * @return integer
     */
    public function getDaysCount()
    {
        return $this->daysCount;
    }

    /**
     * Set country
     *
     * @param Country $country
     * @return Travel
     */
    public function setCountry(Country $country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return Country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set aquatory
     *
     * @param Aquatory $aquatory
     * @return Travel
     */
    public function setAquatory(Aquatory $aquatory)
    {
        $this->aquatory = $aquatory;

        return $this;
    }

    /**
     * Get aquatory
     *
     * @return Aquatory
     */
    public function getAquatory()
    {
        return $this->aquatory;
    }

    /**
     * Set yacht
     *
     * @param \stdClass $yacht
     * @return Travel
     */
    public function setYacht($yacht)
    {
        $this->yacht = $yacht;

        return $this;
    }

    /**
     * Get yacht
     *
     * @return \stdClass
     */
    public function getYacht()
    {
        return $this->yacht;
    }

    /**
     * Set skipperPaymentMethod
     *
     * @param string $skipperPaymentMethod
     * @return Travel
     */
    public function setSkipperPaymentMethod($skipperPaymentMethod)
    {
        $this->skipperPaymentMethod = $skipperPaymentMethod;

        return $this;
    }

    /**
     * Get skipperPaymentMethod
     *
     * @return string
     */
    public function getSkipperPaymentMethod()
    {
        return $this->skipperPaymentMethod;
    }

    /**
     * Set websiteComission
     *
     * @param integer $websiteComission
     * @return Travel
     */
    public function setWebsiteComission($websiteComission)
    {
        $this->websiteComission = $websiteComission;

        return $this;
    }

    /**
     * Get websiteComission
     *
     * @return integer
     */
    public function getWebsiteComission()
    {
        return $this->websiteComission;
    }

    /**
     * Set placeOfArrival
     *
     * @param string $placeOfArrival
     * @return Travel
     */
    public function setPlaceOfArrival($placeOfArrival)
    {
        $this->placeOfArrival = $placeOfArrival;

        return $this;
    }

    /**
     * Get placeOfArrival
     *
     * @return string
     */
    public function getPlaceOfArrival()
    {
        return $this->placeOfArrival;
    }

    /**
     * Set placeOfDeparture
     *
     * @param string $placeOfDeparture
     * @return Travel
     */
    public function setPlaceOfDeparture($placeOfDeparture)
    {
        $this->placeOfDeparture = $placeOfDeparture;

        return $this;
    }

    /**
     * Get placeOfDeparture
     *
     * @return string
     */
    public function getPlaceOfDeparture()
    {
        return $this->placeOfDeparture;
    }

    /**
     * Set transferFromAirport
     *
     * @param string $transferFromAirport
     * @return Travel
     */
    public function setTransferFromAirport($transferFromAirport)
    {
        $this->transferFromAirport = $transferFromAirport;

        return $this;
    }

    /**
     * Get transferFromAirport
     *
     * @return string
     */
    public function getTransferFromAirport()
    {
        return $this->transferFromAirport;
    }

    /**
     * Set transferPrice
     *
     * @param string $transferPrice
     * @return Travel
     */
    public function setTransferPrice($transferPrice)
    {
        $this->transferPrice = $transferPrice;

        return $this;
    }

    /**
     * Get transferPrice
     *
     * @return string
     */
    public function getTransferPrice()
    {
        return $this->transferPrice;
    }

    /**
     * Set transferPriceCurrency
     *
     * @param string $transferPriceCurrency
     * @return Travel
     */
    public function setTransferPriceCurrency($transferPriceCurrency)
    {
        $this->transferPriceCurrency = $transferPriceCurrency;

        return $this;
    }

    /**
     * Get transferPriceCurrency
     *
     * @return string
     */
    public function getTransferPriceCurrency()
    {
        return $this->transferPriceCurrency;
    }

    /**
     * Set teamGatheringAddress
     *
     * @param string $teamGatheringAddress
     * @return Travel
     */
    public function setTeamGatheringAddress($teamGatheringAddress)
    {
        $this->teamGatheringAddress = $teamGatheringAddress;

        return $this;
    }

    /**
     * Get teamGatheringAddress
     *
     * @return string
     */
    public function getTeamGatheringAddress()
    {
        return $this->teamGatheringAddress;
    }

    /**
     * Set teamGatheringLatitude
     *
     * @param string $teamGatheringLatitude
     * @return Travel
     */
    public function setTeamGatheringLatitude($teamGatheringLatitude)
    {
        $this->teamGatheringLatitude = $teamGatheringLatitude;

        return $this;
    }

    /**
     * Get teamGatheringLatitude
     *
     * @return string
     */
    public function getTeamGatheringLatitude()
    {
        return $this->teamGatheringLatitude;
    }

    /**
     * Set teamGatheringLongitude
     *
     * @param string $teamGatheringLongitude
     * @return Travel
     */
    public function setTeamGatheringLongitude($teamGatheringLongitude)
    {
        $this->teamGatheringLongitude = $teamGatheringLongitude;

        return $this;
    }

    /**
     * Get teamGatheringLongitude
     *
     * @return string
     */
    public function getTeamGatheringLongitude()
    {
        return $this->teamGatheringLongitude;
    }

    /**
     * Set teamGatheringTime
     *
     * @param \DateTime $teamGatheringTime
     * @return Travel
     */
    public function setTeamGatheringTime($teamGatheringTime)
    {
        $this->teamGatheringTime = $teamGatheringTime;

        return $this;
    }

    /**
     * Get teamGatheringTime
     *
     * @return \DateTime
     */
    public function getTeamGatheringTime()
    {
        return $this->teamGatheringTime;
    }

    /**
     * Set included
     *
     * @param string $included
     * @return Travel
     */
    public function setIncluded($included)
    {
        $this->included = $included;

        return $this;
    }

    /**
     * Get included
     *
     * @return string
     */
    public function getIncluded()
    {
        return $this->included;
    }

    /**
     * Set excluded
     *
     * @param string $excluded
     * @return Travel
     */
    public function setExcluded($excluded)
    {
        $this->excluded = $excluded;

        return $this;
    }

    /**
     * Get excluded
     *
     * @return string
     */
    public function getExcluded()
    {
        return $this->excluded;
    }

    /**
     * Set photos
     *
     * @param array $photos
     * @return Travel
     */
    public function setPhotos($photos)
    {
        $this->photos = $photos;

        return $this;
    }

    /**
     * Get photos
     *
     * @return ArrayCollection
     */
    public function getPhotos()
    {
        return $this->photos;
    }

    /**
     * Add photo to travel
     * @param Media $photo
     * @return $this
     */
    public function addPhoto(Media $photo)
    {
        $this->photos->add($photo);

        return $this;
    }

    /**
     * Set days
     *
     * @param array $days
     * @return Travel
     */
    public function setDays($days)
    {
        $this->days = $days;

        return $this;
    }

    /**
     * Get days
     *
     * @return ArrayCollection
     */
    public function getDays()
    {
        return $this->days;
    }

    public function addDay(Day $day)
    {
        $this->days->add($day);
    }
}
