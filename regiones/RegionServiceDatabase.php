
<?php

class RegionServiceDatabase implements IServiceBase
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
    //Obtiene todos las regiones en la bd
    public function GetList()
    {

        $regiones = array();

        $stmt = $this->context->db->prepare('SELECT * FROM region');
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows !== 0) {

            while ($row = $result->fetch_object()) {

                $region = new Region();

                $region->InitializeData($row->id, $row->region);

                array_push($regiones, $region);

            }

        }

        $stmt->close();

        return $regiones;
    }

    //Devuelve la region del $id proporcionado
    public function GetById($id)
    {

        $region = new Region();

        $stmt = $this->context->db->prepare('SELECT * FROM region WHERE id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return null;
        } else {

            while ($row = $result->fetch_object()) {

                $region->InitializeData($row->id, $row->region);

            }

        }

        $stmt->close();

        return $region;

    }

    //Agrega un region pokemon a la lista de pokemon
    public function Add($region)
    {

        $stmt = $this->context->db->prepare('INSERT INTO region (region) VALUES (?)');
        $stmt->bind_param('s', $region->region);
        $stmt->execute();
        $stmt->close();

    }

    //Borrar el region pokemon de la lista de  region pokemon, con el $id proporcionado
    public function Delete($id)
    {

        $stmt = $this->context->db->prepare('DELETE FROM region WHERE id=?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->close();
    }

    //Actualizar region pokemon
    public function Update($id, $region)
    {
        $stmt = $this->context->db->prepare('UPDATE region SET region = ? WHERE id=?');
        $stmt->bind_param('si', $region->region, $id);
        $stmt->execute();
        $stmt->close();

    }

}
