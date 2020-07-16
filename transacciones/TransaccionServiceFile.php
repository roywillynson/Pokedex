<?php

class TransaccionServiceFile implements IServiceBase
{

    //Atributos
    private $utilities;

    private $fileHandler;
    private $fileName;
    private $directory;
    private $log;
    

    //Constructores
    public function __construct($directory = "data")
    {
        $this->utilities = new Utilities();
        $this->fileName = "transacciones";
        $this->directory = $directory;
        $this->fileHandler = new CSVFileHandler($this->fileName, $this->directory);
        $this->log = new Log('transaccion','../log/');
    }

    //Funciones
    //Obtiene todos los transacciones en la cookie
    public function GetList()
    {

        $transaccionesDecode = $this->fileHandler->ReadFile();

        $transacciones = array();

        if ($transaccionesDecode == false) {

            $fileHandler = $this->fileHandler->SaveFile($transacciones);

        } else {

            foreach ($transaccionesDecode as $transaccionDecode) {

                $transaccion = new Transaccion();

                $transaccion->set($transaccionDecode);

                array_push($transacciones, $transaccion);

            }
            
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

        $this->fileHandler->SaveFile($transacciones);

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

        $this->fileHandler->SaveFile($transacciones);

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

        $this->fileHandler->SaveFile($transacciones);

        //LOG
        $this->log->agregar('Se Actualizo la transaccion id['.$id.']');

    }

}