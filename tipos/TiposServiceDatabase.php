<?php

class TiposServiceDatabase implements IServiceBase
{

    //Atributos
    private $context;
    private $utilities;

    //Constructores
    public function __construct($directory)
    {
        $this->utilities = new Utilities();
        $this->context = new PokemonsContext($directory);
    }

    //Funciones
    //Obtiene todos los tipos de pokemon en la bd
    public function GetList()
    {

        $tipos = array();

        $stmt = $this->context->db->prepare('SELECT * FROM tipos');
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows !== 0) {

            while ($row = $result->fetch_object()) {

                $tipo = new Tipo();

                $tipo->InitializeData($row->id, $row->tipo);

                array_push($tipos, $tipo);

            }

        }

        $stmt->close();

        return $tipos;
    }

    //Devuelve el tipo del $id proporcionado
    public function GetById($id)
    {

        $tipo = new Tipo();

        $stmt = $this->context->db->prepare('SELECT * FROM tipos WHERE id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return null;
        } else {

            while ($row = $result->fetch_object()) {

                $tipo->InitializeData($row->id, $row->tipo);

            }

        }

        $stmt->close();

        return $tipo;

    }

    //Agrega un tipos pokemon a la lista de pokemon
    public function Add($tipo)
    {
        $stmt = $this->context->db->prepare('INSERT INTO tipos (tipo) VALUES (?)');
        $stmt->bind_param('s', $tipo->tipo);
        $stmt->execute();
        $stmt->close();

    }

    //Borrar el tipos pokemon de la lista de  tipos pokemon, con el $id proporcionado
    public function Delete($id)
    {

        $stmt = $this->context->db->prepare('DELETE FROM tipos WHERE id=?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->close();
    }

    //Actualizar tipos pokemon
    public function Update($id, $tipo)
    {
        $stmt = $this->context->db->prepare('UPDATE tipos SET tipo = ? WHERE id=?');
        $stmt->bind_param('si', $tipo->tipo, $id);
        $stmt->execute();
        $stmt->close();

    }

}
