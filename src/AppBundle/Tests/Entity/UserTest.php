<?php

namespace AppBundle\Tests\Entity;

use AppBundle\Entity\User;

class UserTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        date_default_timezone_set('Europe/Moscow');
    }

    public function testSetBirthday()
    {
        $user = new User();
        $user->setBirthday('1986-12-02');
        $this->assertInstanceOf('\Datetime', $user->getBirthday());
        $this->assertEquals($user->getBirthday()->format('Y-m-d'), '1986-12-02');
    }
}
