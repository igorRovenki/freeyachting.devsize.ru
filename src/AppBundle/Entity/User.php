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
    const USER_TYPE_TRAVELLER = 'traveller';
    const USER_TYPE_SKIPPER = 'skipper';
    const ROLE_SKIPPER = 'ROLE_SKIPPER';
    const ROLE_TRAVELLER = 'ROLE_TRAVELLER';

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

    /**
     * @var string
     * @ORM\Column(name="skype_login", type="string", length=255, nullable=true)
     */
    private $skypeLogin;

    /**
     * @var boolean
     * @ORM\Column(name="know_russian", type="boolean", nullable=true)
     */
    private $knowRussian;

    /**
     * @var boolean
     * @ORM\Column(name="know_english", type="boolean", nullable=true)
     */
    private $knowEnglish;

    /**
     * @var string
     * @ORM\Column(name="first_another_lang", type="string", length=64, nullable=true)
     */
    private $firstAnotherLang;

    /**
     * @var string
     * @ORM\Column(name="second_another_lang", type="string", length=64, nullable=true)
     */
    private $secondAnotherLang;

    /**
     * @var boolean
     * @ORM\Column(name="iyt_certificate", type="boolean", nullable=true)
     */
    private $iytCertificate;

    /**
     * @var boolean
     * @ORM\Column(name="rya_certificate", type="boolean", nullable=true)
     */
    private $ryaCertificate;

    /**
     * @var string
     * @ORM\Column(name="certificate_number", type="string", length=255, nullable=true)
     */
    private $certificateNumber;

    /**
     * @var \DateTime
     * @ORM\Column(name="certificate_issue_date", type="datetime", nullable=true)
     */
    private $certificateIssueDate;

    /**
     * @var string
     * @ORM\Column(name="experience_years", type="string", length=255, nullable=true)
     */
    private $experienceYears;

    /**
     * @var string
     * @ORM\Column(name="experience_miles", type="string", length=255, nullable=true)
     */
    private $experienceMiles;

    /**
     * @var boolean
     * @ORM\Column(name="job_offers_agree", type="boolean", nullable=true)
     */
    private $jobOffersAgree;

    /**
     * @var boolean
     * @ORM\Column(name="email_subscribtion", type="boolean", nullable=true)
     */
    private $emailSubscribtion;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\WaterAreasExperience", cascade={"persist"})
     * @ORM\JoinTable(name="skipper_has_water_experience",
     *  joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *  inverseJoinColumns={@ORM\JoinColumn(name="water_areas_experience_id", referencedColumnName="id")}
     * )
     */
    private $waterAreasExperience;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Travel", mappedBy="skipper", cascade={"persist", "remove"}, fetch="EXTRA_LAZY")
     */
    private $skipperTravels;


    public function __construct()
    {
        $this->gender = self::GENDER_M;
        $this->waterAreasExperience = new ArrayCollection();
        $this->skipperTravels = new ArrayCollection();
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

    /**
     * @return string
     */
    public function getSkypeLogin()
    {
        return $this->skypeLogin;
    }

    /**
     * @param string $skypeLogin
     */
    public function setSkypeLogin($skypeLogin)
    {
        $this->skypeLogin = $skypeLogin;
    }

    /**
     * @return boolean
     */
    public function isKnowRussian()
    {
        return $this->knowRussian;
    }

    /**
     * @param boolean $knowRussian
     */
    public function setKnowRussian($knowRussian)
    {
        $this->knowRussian = $knowRussian;
    }

    /**
     * @return boolean
     */
    public function isKnowEnglish()
    {
        return $this->knowEnglish;
    }

    /**
     * @param boolean $knowEnglish
     */
    public function setKnowEnglish($knowEnglish)
    {
        $this->knowEnglish = $knowEnglish;
    }

    /**
     * @return string
     */
    public function getFirstAnotherLang()
    {
        return $this->firstAnotherLang;
    }

    /**
     * @param string $firstAnotherLang
     */
    public function setFirstAnotherLang($firstAnotherLang)
    {
        $this->firstAnotherLang = $firstAnotherLang;
    }

    /**
     * @return string
     */
    public function getSecondAnotherLang()
    {
        return $this->secondAnotherLang;
    }

    /**
     * @param string $secondAnotherLang
     */
    public function setSecondAnotherLang($secondAnotherLang)
    {
        $this->secondAnotherLang = $secondAnotherLang;
    }

    /**
     * @return boolean
     */
    public function isIytCertificate()
    {
        return $this->iytCertificate;
    }

    /**
     * @param boolean $iytCertificate
     */
    public function setIytCertificate($iytCertificate)
    {
        $this->iytCertificate = $iytCertificate;
    }

    /**
     * @return boolean
     */
    public function isRyaCertificate()
    {
        return $this->ryaCertificate;
    }

    /**
     * @param boolean $ryaCertificate
     */
    public function setRyaCertificate($ryaCertificate)
    {
        $this->ryaCertificate = $ryaCertificate;
    }

    /**
     * @return string
     */
    public function getCertificateNumber()
    {
        return $this->certificateNumber;
    }

    /**
     * @param string $certificateNumber
     */
    public function setCertificateNumber($certificateNumber)
    {
        $this->certificateNumber = $certificateNumber;
    }

    /**
     * @return \DateTime
     */
    public function getCertificateIssueDate()
    {
        return $this->certificateIssueDate;
    }

    /**
     * @param \DateTime $certificateIssueDate
     */
    public function setCertificateIssueDate($certificateIssueDate)
    {
        $this->certificateIssueDate = $certificateIssueDate;
    }

    /**
     * @return string
     */
    public function getExperienceYears()
    {
        return $this->experienceYears;
    }

    /**
     * @param string $experienceYears
     */
    public function setExperienceYears($experienceYears)
    {
        $this->experienceYears = $experienceYears;
    }

    /**
     * @return string
     */
    public function getExperienceMiles()
    {
        return $this->experienceMiles;
    }

    /**
     * @param string $experienceMiles
     */
    public function setExperienceMiles($experienceMiles)
    {
        $this->experienceMiles = $experienceMiles;
    }

    /**
     * @return boolean
     */
    public function isJobOffersAgree()
    {
        return $this->jobOffersAgree;
    }

    /**
     * @param boolean $jobOffersAgree
     */
    public function setJobOffersAgree($jobOffersAgree)
    {
        $this->jobOffersAgree = $jobOffersAgree;
    }

    /**
     * @return boolean
     */
    public function isEmailSubscribtion()
    {
        return $this->emailSubscribtion;
    }

    /**
     * @param boolean $emailSubscribtion
     */
    public function setEmailSubscribtion($emailSubscribtion)
    {
        $this->emailSubscribtion = $emailSubscribtion;
    }

    /**
     * @return ArrayCollection
     */
    public function getWaterAreasExperience()
    {
        return $this->waterAreasExperience;
    }

    /**
     * @param ArrayCollection $waterAreasExperience
     */
    public function setWaterAreasExperience($waterAreasExperience)
    {
        $this->waterAreasExperience = $waterAreasExperience;
    }

    /**
     * @param WaterAreasExperience $waterAreasExperience
     */
    public function addWaterAreasExperience(WaterAreasExperience $waterAreasExperience)
    {
        $this->waterAreasExperience->add($waterAreasExperience);
    }

    /**
     * @param WaterAreasExperience $waterAreasExperience
     */
    public function removeWaterAreasExperience(WaterAreasExperience $waterAreasExperience)
    {
        $this->waterAreasExperience->removeElement($waterAreasExperience);
    }

    /**
     * @return ArrayCollection
     */
    public function getSkipperTravels()
    {
        return $this->skipperTravels;
    }

    /**
     * @param ArrayCollection $skipperTravels
     */
    public function setSkipperTravels($skipperTravels)
    {
        $this->skipperTravels = $skipperTravels;
    }

    /**
     * @param Travel $travel
     */
    public function addSkipperTravel(Travel $travel)
    {
        $this->skipperTravels->add($travel);
    }

    /**
     * @param Travel $travel
     */
    public function removeSkipperTravel(Travel $travel)
    {
        $this->skipperTravels->removeElement($travel);
    }
}
