<?php

namespace AppBundle\Tests\Entity;

use AppBundle\Entity\Travel;

class TravelTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        date_default_timezone_set('Europe/Moscow');
    }

    public function testDatesPeriod()
    {
        $travel = new Travel();
        $travel->setDateStart(new \DateTime('2015-04-9'));
        $travel->setDateEnd(new \DateTime('2015-05-24'));
        $this->assertEquals('9 Апр - 24 Май', $travel->getDates());
    }

    public function testDetailDatesPeriod()
    {
        $travel = new Travel();
        $travel->setDateStart(new \DateTime('2015-04-9'));
        $travel->setDateEnd(new \DateTime('2015-05-24'));
        $this->assertEquals('9 Апреля - 24 Мая 2015', $travel->getDetailDates());
    }

    public function testDaysCount()
    {
        $travel = new Travel();
        $travel->setDateStart(new \DateTime('2015-04-10'));
        $travel->setDateEnd(new \DateTime('2015-04-15'));
        $this->assertEquals(6, $travel->getDaysCount());
    }

    public function testDayDate()
    {
        $travel = new Travel();
        $travel->setDateStart(new \DateTime('2015-04-10'));
        $travel->setDateEnd(new \DateTime('2015-04-15'));
        $this->assertEquals('10 Апреля', $travel->getDayDate(1));
        $this->assertEquals('15 Апреля', $travel->getDayDate(6));
    }
}
