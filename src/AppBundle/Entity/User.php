<?php

namespace AppBundle\Entity;

use Application\Sonata\MediaBundle\Entity\Media;
use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User extends BaseUser
{
    const GENDER_M = 'm';
    const GENDER_W = 'w';

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    protected $lastName;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    protected $name;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $patronomic;

    /**
     * @var string
     * @ORM\Column(type="string", length=32)
     */
    protected $gender;

    /**
     * @var string
     * @ORM\Column(type="date", nullable=true)
     */
    protected $birthday;

    /**
     * @var string
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    protected $phone;

    /**
     * @var string
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    protected $interests;

    /**
     * @var Media
     * @ORM\OneToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="photo_id")
     */
    protected $photo;

    /**
     * @var string
     */
    private $photoPublicUrl;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Booking", mappedBy="user", cascade={"persist", "remove"}, fetch="EXTRA_LAZY")
     */
    private $bookings;


    public function __construct()
    {
        $this->gender = self::GENDER_M;
        parent::__construct();
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getPatronomic()
    {
        return $this->patronomic;
    }

    /**
     * @param string $patronomic
     */
    public function setPatronomic($patronomic)
    {
        $this->patronomic = $patronomic;
    }

    /**
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * @return \DateTime
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @param \DateTime|string $birthday
     */
    public function setBirthday($birthday)
    {
        if (!$birthday instanceof \DateTime) {
            $date = new \DateTime($birthday);
            $birthday = $date;
        }
        $this->birthday = $birthday;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getPhotoPublicUrl()
    {
        return $this->photoPublicUrl;
    }

    /**
     * @param $photoPublicUrl string
     */
    public function setPhotoPublicUrl($photoPublicUrl)
    {
        $this->photoPublicUrl = $photoPublicUrl;
    }

    /**
     * @return string
     */
    public function getInterests()
    {
        return $this->interests;
    }

    /**
     * @param string $interests
     */
    public function setInterests($interests)
    {
        $this->interests = $interests;
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
     * @return $this
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getBookings()
    {
        return $this->bookings;
    }

    /**
     * @param ArrayCollection $bookings
     */
    public function setBookings($bookings)
    {
        $this->bookings = $bookings;
    }
}
