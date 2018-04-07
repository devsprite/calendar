<?php

namespace App;

use Exception;

class Month
{

    public function __construct(int $month, int $year)
    {
        if($month < 1 || $month > 12) {
            throw new Exception("Le mois n'est pas valide.");
        }

        if($year < 1970) {
            throw new Exception("L'année est inférieure à 1970.");
        }

    }

}