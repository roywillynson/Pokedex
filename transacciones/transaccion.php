<?php

class Transaccion
{
    //Atributos
    public $id;
    public $time;
    public $date;
    public $monto;
    public $description;

    //Constructores
    public function __construct()
    {
        
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

    public function get(){
        return get_object_vars($this);
    }

}