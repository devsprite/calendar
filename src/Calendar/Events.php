<?php

namespace Calendar;


class Events
{
    private $pdo;

    /**
     * Events constructor.
     * @param \PDO $pdo
     */
    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Retourne les evenements commencant entre deux dates
     * @param \DateTime $start
     * @param \DateTime $end
     * @return array
     */
    public function  getEventsBetween(\DateTime $start, \DateTime $end): array
    {
        $sql = "SELECT * FROM `events` WHERE start BETWEEN '{$start->format('Y-m-d 00:00:00')}' AND '{$end->format('Y-m-d 23:59:59')}' ";
        $stmt = $this->pdo->query($sql);

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

    /**
     * recupere un evenement
     * @param int $id
     * @return \Calendar\Event
     * @throws \Exception
     */
    public function find(int $id): Event
    {
        $stmt = $this->pdo->query("SELECT * FROM `events` WHERE id = $id LIMIT 1");
        $stmt->setFetchMode(\PDO::FETCH_CLASS,  Event::class);
        $result = $stmt->fetch();
        if($result === false) {
            throw new \Exception('Enregistrement introuvable');
        }

        return $result;
    }

    public function create(Event $event): bool
    {
        $stmt = $this->pdo->prepare('INSERT INTO `events` (name, description, start, end) VALUES (?, ?, ?, ?)');
        return $stmt->execute([
            $event->getName(),
            $event->getDescription(),
            $event->getStart()->format('Y-m-d H:i:s'),
            $event->getEnd()->format('Y-m-d H:i:s'),
        ]);
    }

}