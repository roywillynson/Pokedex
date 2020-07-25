<?php

class Utilities
{

    public function joinArray($elements, $delimiter = '/')
    {
        if (count($elements) === 1) {
            return $elements[0];
        }

        return implode($delimiter, $elements);
    }

    public function splitArray($elements, $delimiter = '/')
    {
        return explode($delimiter, $elements);
    }

    public function getLastArrayElement($elements)
    {
        $lastElement = $elements[count($elements) - 1];
        return $lastElement;
    }

    public function filterByProperty($elements, $property, $value)
    {
        $filter = [];

        foreach ($elements as $el) {
            if ($el->$property == $value) {
                array_push($filter, $el);
            }
        }

        return $filter;
    }

    public function searchIndexElement($elements, $property, $value)
    {
        $index = 0;

        foreach ($elements as $key => $val) {
            if ($val->$property == $value) {
                $index = $key;
                break;
            }
        }

        return $index;
    }

    public function GetCookieTime()
    {
        return time() + 60 * 60 * 24 * 30; //Un mes de la cookie
    }

    public function getCurrentDateTime($format = 'd/m/Y H:i:s')
    {

        $currentDateTime = new DateTime('now', new DateTimeZone('America/Santo_Domingo'));

        return $currentDateTime->format($format);

    }

}
