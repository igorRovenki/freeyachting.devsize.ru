<?php

namespace AppBundle\Entity;

use Application\Sonata\MediaBundle\Entity\Media;
use Doctrine\ORM\Mapping as ORM;

/**
 * Yacht
 *
 * @ORM\Table(name="yachts")
 * @ORM\Entity
 */
class Yacht
{
    const SHIP_TYPE_YACHT = 'yacht';
    const SHIP_TYPE_CATAMARAN = 'catamaran';
    const SHIP_TYPE_OTHER = 'other';

    const YACHT_TYPE_SAIL_MOTOR = 'sail_motor';
    const YACHT_TYPE_SAIL = 'sail';
    const YACHT_TYPE_MOTOR = 'motor';

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
     * @ORM\Column(name="ship_type", type="string", length=64)
     */
    private $shipType;

    /**
     * @var string
     *
     * @ORM\Column(name="yacht_type", type="string", length=64)
     */
    private $yachtType;

    /**
     * @var string
     *
     * @ORM\Column(name="manufacturer", type="string", length=64)
     */
    private $manufacturer;

    /**
     * @var string
     *
     * @ORM\Column(name="year_of_production", type="string", length=64, nullable=true)
     */
    private $yearOfProduction;

    /**
     * @var string
     *
     * @ORM\Column(name="yacht_length_ft", type="string", length=64)
     */
    private $yachtLengthFt;

    /**
     * @var string
     *
     * @ORM\Column(name="yacht_length_m", type="string", length=64)
     */
    private $yachtLengthM;

    /**
     * @var string
     *
     * @ORM\Column(name="bathrooms_number", type="string", length=64, nullable=true)
     */
    private $bathroomsNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="double_cabins_number", type="integer", length=64)
     */
    private $doubleCabinsNumber;

    /**
     * @var int
     *
     * @ORM\Column(name="single_cabins_number", type="integer", length=64)
     */
    private $singleCabinsNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=1000, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="features", type="string", length=1000, nullable=true)
     */
    private $features;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"})
     * @ORM\JoinColumn(name="schema_image_id", referencedColumnName="id")
     */
    private $schemaImage;


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
     * Set shipType
     *
     * @param string $shipType
     * @return Yacht
     */
    public function setShipType($shipType)
    {
        $this->shipType = $shipType;

        return $this;
    }

    /**
     * Get shipType
     *
     * @return string
     */
    public function getShipType()
    {
        return $this->shipType;
    }

    /**
     * Set yachtType
     *
     * @param string $yachtType
     * @return Yacht
     */
    public function setYachtType($yachtType)
    {
        $this->yachtType = $yachtType;

        return $this;
    }

    /**
     * Get yachtType
     *
     * @return string
     */
    public function getYachtType()
    {
        return $this->yachtType;
    }

    /**
     * Set manufacturer
     *
     * @param string $manufacturer
     * @return Yacht
     */
    public function setManufacturer($manufacturer)
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    /**
     * Get manufacturer
     *
     * @return string
     */
    public function getManufacturer()
    {
        return $this->manufacturer;
    }

    /**
     * Set yearOfProduction
     *
     * @param string $yearOfProduction
     * @return Yacht
     */
    public function setYearOfProduction($yearOfProduction)
    {
        $this->yearOfProduction = $yearOfProduction;

        return $this;
    }

    /**
     * Get yearOfProduction
     *
     * @return string
     */
    public function getYearOfProduction()
    {
        return $this->yearOfProduction;
    }

    /**
     * Set yachtLengthFt
     *
     * @param string $yachtLengthFt
     * @return Yacht
     */
    public function setYachtLengthFt($yachtLengthFt)
    {
        $this->yachtLengthFt = $yachtLengthFt;

        return $this;
    }

    /**
     * Get yachtLengthFt
     *
     * @return string
     */
    public function getYachtLengthFt()
    {
        return $this->yachtLengthFt;
    }

    /**
     * Set yachtLengthM
     *
     * @param string $yachtLengthM
     * @return Yacht
     */
    public function setYachtLengthM($yachtLengthM)
    {
        $this->yachtLengthM = $yachtLengthM;

        return $this;
    }

    /**
     * Get yachtLengthM
     *
     * @return string
     */
    public function getYachtLengthM()
    {
        return $this->yachtLengthM;
    }

    /**
     * Set bathroomsNumber
     *
     * @param string $bathroomsNumber
     * @return Yacht
     */
    public function setBathroomsNumber($bathroomsNumber)
    {
        $this->bathroomsNumber = $bathroomsNumber;

        return $this;
    }

    /**
     * Get bathroomsNumber
     *
     * @return int
     */
    public function getBathroomsNumber()
    {
        return $this->bathroomsNumber;
    }

    /**
     * Set doubleCabinsNumber
     *
     * @param int $doubleCabinsNumber
     * @return Yacht
     */
    public function setDoubleCabinsNumber($doubleCabinsNumber)
    {
        $this->doubleCabinsNumber = $doubleCabinsNumber;

        return $this;
    }

    /**
     * Get doubleCabinsNumber
     *
     * @return int
     */
    public function getDoubleCabinsNumber()
    {
        return $this->doubleCabinsNumber;
    }

    /**
     * Set singleCabinsNumber
     *
     * @param int $singleCabinsNumber
     * @return Yacht
     */
    public function setSingleCabinsNumber($singleCabinsNumber)
    {
        $this->singleCabinsNumber = $singleCabinsNumber;

        return $this;
    }

    /**
     * Get singleCabinsNumber
     *
     * @return int
     */
    public function getSingleCabinsNumber()
    {
        return $this->singleCabinsNumber;
    }

    /**
     * @return int
     */
    public function getTotalCabinsNumber()
    {
        return (int)$this->singleCabinsNumber + (int)$this->doubleCabinsNumber;
    }

    public function getTotalPlacesNumber()
    {
        return (int)$this->singleCabinsNumber + ((int)$this->doubleCabinsNumber * 2);
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Yacht
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set features
     *
     * @param string $features
     * @return Yacht
     */
    public function setFeatures($features)
    {
        $this->features = $features;

        return $this;
    }

    /**
     * Get features
     *
     * @return string
     */
    public function getFeatures()
    {
        return $this->features;
    }

    /**
     * Set schemaImage
     *
     * @param Media $schemaImage
     * @return Yacht
     */
    public function setSchemaImage(Media $schemaImage)
    {
        $this->schemaImage = $schemaImage;

        return $this;
    }

    /**
     * Get schemaImage
     *
     * @return Media
     */
    public function getSchemaImage()
    {
        return $this->schemaImage;
    }
}
