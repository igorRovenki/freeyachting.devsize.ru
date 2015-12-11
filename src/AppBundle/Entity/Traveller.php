<?php

namespace AppBundle\Entity;

use Application\Sonata\MediaBundle\Entity\Media;
use Doctrine\ORM\Mapping as ORM;

/**
 * Traveller
 *
 * @ORM\Table(name="travellers")
 * @ORM\Entity
 */
class Traveller
{
    const GENDER_M = 'm';
    const GENDER_W = 'w';
    const TYPE_ADULT = 'adult';
    const TYPE_CHILD = 'child';
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
     * @ORM\Column(name="full_name", type="string", length=255)
     */
    private $fullName;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=64, nullable=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="age", type="string", length=64, nullable=true)
     */
    private $age;

    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", length=32)
     */
    private $gender;

    /**
     * @var boolean
     *
     * @ORM\Column(name="children", type="boolean")
     */
    private $children;

    /**
     * @var integer
     *
     * @ORM\Column(name="child_number", type="smallint", nullable=true)
     */
    private $childNumber;

    /**
     * @var integer
     *
     * @ORM\Column(name="child_min_age", type="smallint", nullable=true)
     */
    private $childMinAge;

    /**
     * @var boolean
     *
     * @ORM\Column(name="opposite_gender_living", type="boolean")
     */
    private $oppositeGenderLiving;

    /**
     * @var boolean
     *
     * @ORM\Column(name="living_with_parents", type="boolean")
     */
    private $livingWithParents;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=32)
     */
    private $type;

    /**
     * @var integer
     * @ORM\Column(name="place_number", type="smallint")
     */
    private $placeNumber;

    /**
     * @var Media
     * @ORM\OneToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="photo_id")
     */
    private $photo;

    /**
     * @var string
     */
    private $photoPublicUrl;


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
     * Set fullName
     *
     * @param string $fullName
     * @return Traveller
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;

        return $this;
    }

    /**
     * Get fullName
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Traveller
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Traveller
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set age
     *
     * @param string $age
     * @return Traveller
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return string
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set gender
     *
     * @param string $gender
     * @return Traveller
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set children
     *
     * @param boolean $children
     * @return Traveller
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
    public function hasChildren()
    {
        return $this->children;
    }

    /**
     * Set childNumber
     *
     * @param integer $childNumber
     * @return Traveller
     */
    public function setChildNumber($childNumber)
    {
        $this->childNumber = $childNumber;

        return $this;
    }

    /**
     * Get childNumber
     *
     * @return integer
     */
    public function getChildNumber()
    {
        return $this->childNumber;
    }

    /**
     * Set childMinAge
     *
     * @param integer $childMinAge
     * @return Traveller
     */
    public function setChildMinAge($childMinAge)
    {
        $this->childMinAge = $childMinAge;

        return $this;
    }

    /**
     * Get childMinAge
     *
     * @return integer
     */
    public function getChildMinAge()
    {
        return $this->childMinAge;
    }

    /**
     * Set oppositeGenderLiving
     *
     * @param boolean $oppositeGenderLiving
     * @return Traveller
     */
    public function setOppositeGenderLiving($oppositeGenderLiving)
    {
        $this->oppositeGenderLiving = $oppositeGenderLiving;

        return $this;
    }

    /**
     * Get oppositeGenderLiving
     *
     * @return boolean
     */
    public function getOppositeGenderLiving()
    {
        return $this->oppositeGenderLiving;
    }

    /**
     * Set livingWithParents
     *
     * @param boolean $livingWithParents
     * @return Traveller
     */
    public function setLivingWithParents($livingWithParents)
    {
        $this->livingWithParents = $livingWithParents;

        return $this;
    }

    /**
     * Get livingWithParents
     *
     * @return boolean
     */
    public function getLivingWithParents()
    {
        return $this->livingWithParents;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Traveller
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
     * @return Media
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param Media $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    /**
     * @return int
     */
    public function getPlaceNumber()
    {
        return $this->placeNumber;
    }

    /**
     * @param int $placeNumber
     */
    public function setPlaceNumber($placeNumber)
    {
        $this->placeNumber = $placeNumber;
    }

    /**
     * @param $photoPublicUrl
     */
    public function setPhotoPublicUrl($photoPublicUrl)
    {
        $this->photoPublicUrl = $photoPublicUrl;
    }

    /**
     * @return string
     */
    public function getPhotoPublicUrl()
    {
        return $this->photoPublicUrl;
    }
}
