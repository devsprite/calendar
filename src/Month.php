<?php

namespace App;

use Exception;

class Month
{
    private $month;
    private $year;
    private $months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];

    /**
     * Month constructor.
     * @param int|null $month Le mois entre 1 et 12, si null utilise le mois en cours
     * @param int|null $year L'année, si null utilise l'année en cours
     * @throws Exception
     */
    public function __construct(int $month = null, int $year = null)
    {
        if ($month === null) {
            $month = (int)date('m');
        }

        if ($year === null) {
            $year = (int)date('Y');
        }

        if ($month < 1 || $month > 12) {
            throw new Exception("Le mois n'est pas valide.");
        }

        if ($year < 1970) {
            throw new Exception("L'année est inférieure à 1970.");
        }

        $this->month = $month;
        $this->year = $year;

    }

    /**
     * Retourne le mois est l'année en toute lettres ex : Mars 2018
     * @return string
     */
    public function toString()
    {
        return $this->months[$this->month - 1] . ' ' . $this->year;
    }

    public function getMonth()
    {
        return $this->month;
    }

    public function getYear()
    {
        return $this->year;
    }

}