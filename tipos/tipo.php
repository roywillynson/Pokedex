<?php

class Tipo
{
    //Atributos
    public $id;
    public $tipo;

    //Constructores
    public function __construct()
    {

    }

    public function InitializeData($id, $tipo)
    {

        $this->id = $id;
        $this->tipo = $tipo;
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
