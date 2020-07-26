<?php

class Utilities
{

    public function joinArray($elements, $delimiter = '/')
    {
        if (count($elements) === 1) {
            return $elements[0];
        }

        $elementsFilter = array_filter($elements);

        return implode($delimiter, $elementsFilter);
    }

    public function splitString($cadena, $delimiter = '/')
    {
        return explode($delimiter, $cadena);
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

    public function getCurrentDateTime($format = 'd/m/Y H:i:s')
    {

        $currentDateTime = new DateTime('now', new DateTimeZone('America/Santo_Domingo'));

        return $currentDateTime->format($format);

    }

    public function hasThumbnailsMode()
    {
        session_start(); //abrir session

        if (isset($_SESSION['thumbnailsMode'])) {

            return filter_var($_SESSION['thumbnailsMode'], FILTER_VALIDATE_BOOLEAN);

        }

        return false;
    }

}
