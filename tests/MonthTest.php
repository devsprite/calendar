<?php

namespace App;

require(__DIR__ . '/../src/Month.php');

use ArgumentCountError;
use PHPUnit\Framework\TestCase;

class MonthTest extends TestCase
{

    /**
     * @expectedException   \Exception
     * @expectedExceptionMessage Le mois n'est pas valide.
     */
    public function testExceptionMonthNether0()
    {
        new Month(0, 2018);
    }

    /**
     * @expectedException   \Exception
     * @expectedExceptionMessage L'année est inférieure à 1970.
     */
    public function testExceptionYearNether1970()
    {
        new Month(2, 1969);
    }

    public function testConstructWithoutParams()
    {
        $month = new Month();
        $this->assertEquals((int)date('m'), $month->getMonth(), "Must return current month.");
        $this->assertEquals((int)date('Y'), $month->getYear(), "Must return current year.");
    }

    public function testGetWeeks()
    {
        $month = new Month(4, 2018);
        $this->assertEquals(6, $month->getWeeks() , 'April 2018, must return 6 weeks');

        $month->setMonth(7);
        $this->assertEquals(6, $month->getWeeks(), 'July 2018, must return 6 weeks');

        $month->setMonth(1);
        $this->assertEquals(5, $month->getWeeks(), 'January 2018, must return 5 weeks');

        $month->setMonth(12);
        $this->assertEquals(6, $month->getWeeks(), 'December 2018, must return 6 weeks');

        $month->setYear(2017);

        $month->setMonth(1);
        $this->assertEquals(6, $month->getWeeks(), 'January 2017 ,must return 5 weeks');

        $month->setMonth(12);
        $this->assertEquals(5, $month->getWeeks(), 'December 2017, must return 5 weeks');

        $month->setYear(2016);

        $month->setMonth(1);
        $this->assertEquals(5, $month->getWeeks(), 'January 2016 ,must return 5 weeks');

        $month->setMonth(2);
        $this->assertEquals(5, $month->getWeeks(), 'February 2016 ,must return 5 weeks');

    }

}
