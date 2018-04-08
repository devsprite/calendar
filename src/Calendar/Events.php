<?php

namespace Calendar;

class Events
{
    /**
     * Retourne les evenements commencant entre deux dates
     * @param \DateTime $start
     * @param \DateTime $end
     * @return array
     */
    public function  getEventsBetween(\DateTime $start, \DateTime $end): array
    {
        $pdo = new \PDO('mysql:host=localhost;dbname=tutocalendar', 'root', 'root', [
           \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
           \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
        ]);

        $sql = "SELECT * FROM `events` WHERE start BETWEEN '{$start->format('Y-m-d 00:00:00')}' AND '{$end->format('Y-m-d 23:59:59')}' ";
        $stmt = $pdo->query($sql);

        return $stmt->fetchAll();
    }

    /**
     * Retourne les evenements commencant entre deux dates indexé par jours
     * @param \DateTime $start
     * @param \DateTime $end
     * @return array
     */
    public function getEventsBetweenByDays(\DateTime $start, \DateTime $end): array
    {
        $events = $this->getEventsBetween($start, $end);
        $days = [];
        foreach ($events as $event) {
            $date = explode(' ', $event['start']);
            $days[$date[0]][] = $event;
        }
        return $days;
    }

}