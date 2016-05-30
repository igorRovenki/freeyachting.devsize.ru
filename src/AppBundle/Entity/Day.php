<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TravelDay
 *
 * @ORM\Table(name="travel_days")
 * @ORM\Entity
 */
class Day
{
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
     * @ORM\Column(name="city_departure", type="string", length=255)
     */
    private $cityDeparture;

    /**
     * @var string
     *
     * @ORM\Column(name="city_arrival", type="string", length=255)
     */
    private $cityArrival;

    /**
     * @var string
     *
     * @ORM\Column(name="city_departure_latitude", type="string", length=255, nullable=true)
     */
    private $cityDepartureLatitude;

    /**
     * @var string
     *
     * @ORM\Column(name="city_departure_longitude", type="string", length=255, nullable=true)
     */
    private $cityDepartureLongitude;

    /**
     * @var string
     *
     * @ORM\Column(name="city_arrival_latitude", type="string", length=255, nullable=true)
     */
    private $cityArrivalLatitude;

    /**
     * @var string
     *
     * @ORM\Column(name="city_arrival_longitude", type="string", length=255, nullable=true)
     */
    private $cityArrivalLongitude;

    /**
     * @var string
     *
     * @ORM\Column(name="route_length", type="string", length=64)
     */
    private $routeLength;

    /**
     * @var string
     *
     * @ORM\Column(name="full_description", type="text", length=2000, nullable=true)
     */
    private $fullDescription;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;


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
     * Set cityDeparture
     *
     * @param string $cityDeparture
     * @return Day
     */
    public function setCityDeparture($cityDeparture)
    {
        $this->cityDeparture = $cityDeparture;

        return $this;
    }

    /**
     * Get cityDeparture
     *
     * @return string
     */
    public function getCityDeparture()
    {
        return $this->cityDeparture;
    }

    /**
     * Set cityArrival
     *
     * @param string $cityArrival
     * @return Day
     */
    public function setCityArrival($cityArrival)
    {
        $this->cityArrival = $cityArrival;

        return $this;
    }

    /**
     * Get cityArrival
     *
     * @return string
     */
    public function getCityArrival()
    {
        return $this->cityArrival;
    }

    /**
     * Set cityDepartureLatitude
     *
     * @param string $cityDepartureLatitude
     * @return Day
     */
    public function setCityDepartureLatitude($cityDepartureLatitude)
    {
        $this->cityDepartureLatitude = $cityDepartureLatitude;

        return $this;
    }

    /**
     * Get cityDepartureLatitude
     *
     * @return string
     */
    public function getCityDepartureLatitude()
    {
        return $this->cityDepartureLatitude;
    }

    /**
     * Set cityDepartureLongitude
     *
     * @param string $cityDepartureLongitude
     * @return Day
     */
    public function setCityDepartureLongitude($cityDepartureLongitude)
    {
        $this->cityDepartureLongitude = $cityDepartureLongitude;

        return $this;
    }

    /**
     * Get cityDepartureLongitude
     *
     * @return string
     */
    public function getCityDepartureLongitude()
    {
        return $this->cityDepartureLongitude;
    }

    /**
     * Set cityArrivalLatitude
     *
     * @param string $cityArrivalLatitude
     * @return Day
     */
    public function setCityArrivalLatitude($cityArrivalLatitude)
    {
        $this->cityArrivalLatitude = $cityArrivalLatitude;

        return $this;
    }

    /**
     * Get cityArrivalLatitude
     *
     * @return string
     */
    public function getCityArrivalLatitude()
    {
        return $this->cityArrivalLatitude;
    }

    /**
     * Set cityArrivalLongitude
     *
     * @param string $cityArrivalLongitude
     * @return Day
     */
    public function setCityArrivalLongitude($cityArrivalLongitude)
    {
        $this->cityArrivalLongitude = $cityArrivalLongitude;

        return $this;
    }

    /**
     * Get cityArrivalLongitude
     *
     * @return string
     */
    public function getCityArrivalLongitude()
    {
        return $this->cityArrivalLongitude;
    }

    /**
     * Set routeLength
     *
     * @param string $routeLength
     * @return Day
     */
    public function setRouteLength($routeLength)
    {
        $this->routeLength = $routeLength;

        return $this;
    }

    /**
     * Get routeLength
     *
     * @return string
     */
    public function getRouteLength()
    {
        return $this->routeLength;
    }

    /**
     * Set fullDescription
     *
     * @param string $fullDescription
     * @return Day
     */
    public function setFullDescription($fullDescription)
    {
        $this->fullDescription = $fullDescription;

        return $this;
    }

    /**
     * Get fullDescription
     *
     * @return string
     */
    public function getFullDescription()
    {
        return $this->fullDescription;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        if (!$date instanceof \DateTime) {
            $date = new \DateTime($date);
        }

        $this->date = $date;
    }
}
