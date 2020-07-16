<?php

class TransaccionServiceCookie implements IServiceBase
{

    //Atributos
    private $utilities;
    private $cookieName;
    private $log;

    //Constructores
    public function __construct()
    {
        $this->utilities = new Utilities();
        $this->log = new Log('transaccion','../log/');
        $this->cookieName = "transacciones";
    }

    //Funciones
    //Obtiene todos los transacciones en la cookie
    public function GetList()
    {

        $transacciones = array();

        if (isset($_COOKIE[$this->cookieName])) {

            $transaccionesDecode = json_decode($_COOKIE[$this->cookieName], false);

            foreach ($transaccionesDecode as $transaccionDecode) {

                $transaccion = new Transaccion();

                $transaccion->set($transaccionDecode);

                array_push($transacciones, $transaccion);

            }

        } else {

            setcookie($this->cookieName, json_encode($transacciones), $this->utilities->GetCookieTime(), "/");
        }

        return $transacciones;
    }

    //Devuelve el transaccion del $id proporcionado
    public function GetById($id)
    {

        $transacciones = $this->GetList();

        $transaccion = $this->utilities->filterByProperty($transacciones, 'id', $id)[0];

        return $transaccion;

    }

    //Agrega un transaccion a la lista de transaccion
    public function Add($transaccion)
    {

        $transacciones = $this->GetList();
        $transaccionId = 1;

        if (!empty($transaccion)) {
            $lastElement = $this->utilities->getLastArrayElement($transacciones);
            $transaccionId = $lastElement->id + 1;
        }

        $transaccion->id = $transaccionId;
        

        array_push($transacciones, $transaccion);

        setcookie($this->cookieName, json_encode($transacciones), $this->utilities->GetCookieTime(), "/");

        //LOG
        $this->log->agregar('Se agrego transaccion id['.$transaccion->id.']');
    }

    //Borrar el esudiante de la lista de transaccion, con el $id proporcionado
    public function Delete($id)
    {

        $transacciones = $this->GetList();

        $indexToDelete = $this->utilities->searchIndexElement($transacciones, 'id', $id);

        unset($transacciones[$indexToDelete]);

        $transacciones = array_values($transacciones);

        setcookie($this->cookieName, json_encode($transacciones), $this->utilities->GetCookieTime(), "/");

        //LOG
        $this->log->agregar('Se Borro la transaccion id['.$id.']');
    }

    //Actualizar transaccion
    public function Update($id, $transaccion)
    {
        $transaccionToUpdate = $this->GetById($id);

        $transacciones = $this->GetList();

        $indexToUpdate = $this->utilities->searchIndexElement($transacciones, 'id', $id);

        $transacciones[$indexToUpdate] = $transaccion;

        setcookie($this->cookieName, json_encode($transacciones), $this->utilities->GetCookieTime(), "/");

        //LOG
        $this->log->agregar('Se Actualizo la transaccion id['.$id.']');

    }

}