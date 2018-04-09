<?php

namespace App;

class Validator
{
    private $data;
    protected $errors = [];

    /**
     * @param array $data
     * @return array|bool
     */
    public function validates(array $data)
    {
        $this->errors = [];
        $this->data = $data;
    }

    public function validate(string $field, string $method, ...$params)
    {
        if (!isset($this->data[$field])) {
            $this->errors[$field] = "Le champ $field n'est pas rempli";
        } else {
            call_user_func([$this, $method], $field, ...$params);
        }
    }

    /**
     * @param string $field
     * @param int $length
     * @return bool
     */
    public function minLength(string $field, int $length): bool
    {
        if (mb_strlen($this->data[$field]) < $length) {
            $this->errors[$field] = "Le champs $field doit avoir plus de $length caractères";
            return false;
        }
        return true;
    }

    /**
     * @param string $field
     * @return bool
     */
    public function date(string $field): bool
    {
        if (\DateTime::createFromFormat('Y-m-d', $this->data[$field]) === false) {
            $this->errors[$field] = "La date ne semble pas être au bon format";
            return false;
        }
        return true;
    }


    /**
     * @param string $field
     * @return bool
     */
    public function time(string $field): bool
    {
        if (\DateTime::createFromFormat('H:i', $this->data[$field]) === false) {
            $this->errors[$field] = "Le temps ne semble pas être au bon format";
            return false;
        }
        return true;
    }

    /**
     * @param string $startField
     * @param string $endField
     * @return bool
     */
    public function beforeTime(string $startField, string $endField)
    {
        if ($this->time($startField) && $this->time($endField)) {
            $timeStart = \DateTime::createFromFormat('H:i', $this->data[$startField]);
            $timeEnd = \DateTime::createFromFormat('H:i', $this->data[$endField]);
            if ($timeStart->getTimestamp() > $timeEnd->getTimestamp()) {
                $this->errors[$startField] = "Le temps de départ doit être inférieur au temps de fin";
                return false;
            }
            return true;
        }
        return false;
    }
}