<?php

class Pokemon
{
    //Atributos
    public $id;
    public $nombre;
    public $region;
    public $tipos;
    public $imagen;
    public $ataques;

    //Constructores
    public function __construct()
    {

    }

    public function InitializeData($id, $nombre, $imagen, $region, $tipos, $ataques)
    {

        $this->id = $id;
        $this->nombre = $nombre;
        $this->imagen = $imagen;
        $this->region = $region;
        $this->tipos = $tipos;
        $this->ataques = $ataques;
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

    public function getImage64()
    {
        if (!empty($this->imagen)) {

            return base64_encode($this->imagen);

        }

        return null;

    }

}
