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

}
