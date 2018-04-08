<?php

namespace App;

use Exception;

class Month
{
    private $month;
    private $year;
    private $months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
    public $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];

    /**
     * Month constructor.
     * @param int|null $month Le mois entre 1 et 12, si null utilise le mois en cours
     * @param int|null $year L'année, si null utilise l'année en cours
     * @throws Exception
     */
    public function __construct(int $month = null, int $year = null)
    {
        if ($month === null || $month < 1 || $month > 12) {
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
    public function toString(): string
    {
        return $this->months[$this->month - 1] . ' ' . $this->year;
    }

    /**
     * Retourne le nombre de semaine dans un mois
     * @return int
     */
    public function getWeeks(): int
    {
        $start = $this->getStartingDay();
        $end = new \DateTime($start->format('Y-m-t'));

        $nbr_start = (int)$start->format('W');
        $nbr_end = (int)$end->format('W');

        if($nbr_end < $nbr_start) {
            if($nbr_start === 53) {
                $nbr_end += 53;
            } else {
                $nbr_end += 52;
            }
        }

        $nbr_weeks = $nbr_end - $nbr_start + 1;

        //var_dump($nbr_start, $nbr_end, $nbr_weeks);

        return $nbr_weeks;
    }

    /**
     * Retourne le premier jour du mois
     * @return \DateTime
     */
    public function getStartingDay(): \DateTime
    {
        return new \DateTime("{$this->year}-{$this->month}-01");
    }


    /**
     * Est-ce que le jour est dans le mois en cours
     * @param \DateTime $date
     * @return bool
     */
    public function withinMonth(\DateTime $date): bool
    {
        return $this->getStartingDay()->format('Y-m') === $date->format('Y-m');
    }

    /**
     * Retourne le mois suivant
     * @return Month
     * @throws Exception
     */
    public function nextMonth(): Month
    {
        $month = $this->month + 1;
        $year = $this->year;
        if($month > 12) {
            $month = 1;
            $year += 1;
        }

        return new Month($month, $year);
    }

    /**
     * Retourne le mois précédant
     * @return Month
     * @throws Exception
     */
    public function previousMonth(): Month
    {
        $month = $this->month - 1;
        $year = $this->year;
        if($month < 1) {
            $month = 12;
            $year -= 1;
        }

        return new Month($month, $year);
    }

    /**
     * @return int
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * @return int
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param int $month
     * @throws Exception
     */
    public function setMonth(int $month)
    {
        if($month > 0 && $month < 13) {
            $this->month = $month;
        } else {
            throw new Exception('Month must be between 1 and 12');
        }
    }

    /**
     * @param int $year
     * @throws Exception
     */
    public function setYear(int $year)
    {
        if($year > 1970) {
            $this->year = $year;
        } else {
            throw new Exception('Year must be greater than 1970');
        }
    }




}