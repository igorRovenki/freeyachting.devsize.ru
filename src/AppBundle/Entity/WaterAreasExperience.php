<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WaterAreasExperience
 *
 * @ORM\Table(name="water_areas_experience")
 * @ORM\Entity
 */
class WaterAreasExperience
{
    const TYPE_EXPERIENCE = 'experience';
    const TYPE_WANTED = 'wanted';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Country
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Country", cascade={"persist"})
     */
    private $country;

    /**
     * @var Aquatory
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Aquatory", cascade={"persist"})
     */
    private $aquatory;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=64)
     */
    private $type;


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
     * Set country
     *
     * @param Country $country
     * @return WaterAreasExperience
     */
    public function setCountry($country)
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
     * @return WaterAreasExperience
     */
    public function setAquatory($aquatory)
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
     * Set type
     *
     * @param string $type
     * @return WaterAreasExperience
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
}
