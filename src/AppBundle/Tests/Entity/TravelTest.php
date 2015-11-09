<?php

namespace AppBundle\Tests\Entity;

use AppBundle\Entity\Travel;

class TravelTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        date_default_timezone_set('Europe/Moscow');
    }

    public function testDaysCount()
    {
        $travel = new Travel();
        $travel->setDateStart(new \DateTime('2015-04-10'));
        $travel->setDateEnd(new \DateTime('2015-04-15'));
        $this->assertEquals(6, $travel->getDaysCount());
    }
}
