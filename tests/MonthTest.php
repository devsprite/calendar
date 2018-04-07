<?php

namespace App;

require (__DIR__ . '/../src/Month.php');

use ArgumentCountError;
use PHPUnit\Framework\TestCase;

class MonthTest extends TestCase
{

    /**
     * @expectedException ArgumentCountError
     */
    public function testExceptionConstructWithoutParams()
    {
        new Month();
    }

    /**
     * @expectedException   \Exception
     * @expectedExceptionMessage Le mois n'est pas valide.
     */
    public function testExceptionMonthNether0()
    {
       new Month(0,2018);
    }

    /**
     * @expectedException   \Exception
     * @expectedExceptionMessage L'année est inférieure à 1970.
     */
    public function testExceptionYearNether1970()
    {
        new Month(2,1969);
    }

}
