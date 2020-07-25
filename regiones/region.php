<?php

class Region
{
    //Atributos
    public $id;
    public $region;

    //Constructores
    public function __construct()
    {

    }

    public function InitializeData($id, $region)
    {

        $this->id = $id;
        $this->region = $region;
    }

    //Encapsulamineto

    //Funcionalidad

    public function set($data)
    {

        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }

    public function get()
    {
        return get_object_vars($this);
    }

}
