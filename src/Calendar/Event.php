<?php

namespace Calendar;

class Event
{
    private $id;

    private $name;

    private $description;

    private $start;

    private $end;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description ?? '';
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return \DateTime
     */
    public function getStart()
    {
        return new \DateTime($this->start);
    }

    /**
     * @param mixed $start
     */
    public function setStart($start): void
    {
        $this->start = $start;
    }

    /**
     * @return \DateTime
     */
    public function getEnd()
    {
        return new \DateTime($this->end);
    }

    /**
     * @param mixed $end
     */
    public function setEnd($end): void
    {
        $this->end = $end;
    }


}