<?php

class Transaccion
{
    //Atributos
    public $id;
    public $time;
    public $date;
    public $monto;
    public $description;

    private $utilities = null;

    //Constructores
    public function __construct()
    {
        $this->utilities = new Utilities();
    }

    public function InitializeData($id, $monto, $description, $date, $time)
    {

        $this->id = $id;
        $this->time = $time;
        $this->date = $date;
        $this->monto = $monto;
        $this->description = $description;
    }

    //Encapsulamineto

    //Funcionalidad

    public function set($data)
    {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }

}