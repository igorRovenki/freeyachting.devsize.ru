<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Booking
 *
 * @ORM\Table(name="bookings")
 * @ORM\Entity
 */
class Booking
{
    const STATUS_PENDING = 'pending';

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
     * @ORM\Column(name="status", type="string", length=32)
     */
    private $status;

    /**
     * @var Travel
     * @ORM\ManyToOne(targetEntity="Travel", cascade={"persist"}, inversedBy="bookings")
     * @ORM\JoinColumn(name="travel_id", referencedColumnName="id")
     */
    private $travel;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="Traveller", cascade={"persist"}, fetch="EXTRA_LAZY")
     * @ORM\JoinTable(name="bookings_has_travellers",
     *     joinColumns={@ORM\JoinColumn(name="booking_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="traveller_id", referencedColumnName="id")}
     * )
     */
    private $travellers;


    public function __construct()
    {
        $this->status = self::STATUS_PENDING;
        $this->travellers = new ArrayCollection();
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
     * Set status
     *
     * @param string $status
     * @return Booking
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return Travel
     */
    public function getTravel()
    {
        return $this->travel;
    }

    /**
     * @param Travel $travel
     */
    public function setTravel(Travel $travel)
    {
        $this->travel = $travel;
    }

    /**
     * @return ArrayCollection
     */
    public function getTravellers()
    {
        return $this->travellers;
    }

    /**
     * @param ArrayCollection $travellers
     */
    public function setTravellers($travellers)
    {
        $this->travellers = $travellers;
    }

    public function addTraveller(Traveller $traveller)
    {
        $this->travellers->add($traveller);
    }
}
