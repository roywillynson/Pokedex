
<?php

class PokemonServiceDatabase implements IServiceBase
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
    //Obtiene todos los pokemon en la bd
    public function GetList()
    {

        $pokemones = array();

        $stmt = $this->context->db->prepare('SELECT * FROM pokemons');
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows !== 0) {

            while ($row = $result->fetch_object()) {

                $pokemon = new Pokemon();

                $pokemon->InitializeData($row->id, $row->nombre, $row->imagen, $row->region, $row->tipos, $row->ataques);

                array_push($pokemones, $pokemon);

            }

        }

        $stmt->close();

        return $pokemones;
    }

    //Devuelve el pokemon del $id proporcionado
    public function GetById($id)
    {

        $pokemon = new Pokemon();

        $stmt = $this->context->db->prepare('SELECT * FROM pokemons WHERE id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return null;
        } else {

            while ($row = $result->fetch_object()) {

                $pokemon->InitializeData($row->id, $row->nombre, $row->imagen, $row->region, $row->tipos, $row->ataques);

            }

        }

        $stmt->close();

        return $pokemon;

    }

    //Agrega un pokemon a la lista de pokemon
    public function Add($pokemon)
    {

        $stmt = $this->context->db->prepare('INSERT INTO pokemons (nombre,imagen ,region, tipos, ataques) VALUES (?,?,?,?,?)');

        $stmt->bind_param('sbsss', $pokemon->nombre, $pokemon->imagen, $pokemon->region, $pokemon->tipos, $pokemon->ataques);

        //Insertar imagen
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0) {

            $tmpName = $_FILES['imagen']['tmp_name'];

            $photo = fopen($tmpName, 'rb');

            $contents = fread($photo, filesize($tmpName));

            $pokemon->imagen = $contents;

            fclose($photo);

            //Enviar imagen
            $stmt->send_long_data(1, $pokemon->imagen);

        }

        $stmt->execute();
        $stmt->close();

    }

    //Borrar el pokemon de la lista de pokemon, con el $id proporcionado
    public function Delete($id)
    {

        $stmt = $this->context->db->prepare('DELETE FROM pokemons WHERE id=?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->close();
    }

    //Actualizar trpokemon
    public function Update($id, $pokemon)
    {

        $stmt = $this->context->db->prepare('UPDATE pokemons SET nombre = ?, imagen = ?, region = ?, tipos = ?,ataques = ? WHERE id=?');

        $stmt->bind_param('sbsssi', $pokemon->nombre, $pokemon->imagen, $pokemon->region, $pokemon->tipos, $pokemon->ataques, $id);

        //Insertar imagen
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0) {

            $tmpName = $_FILES['imagen']['tmp_name'];

            $photo = fopen($tmpName, 'rb');

            $contents = fread($photo, filesize($tmpName));

            $pokemon->imagen = $contents;

            fclose($photo);

        }

        //Enviar imagen
        $stmt->send_long_data(1, $pokemon->imagen);

        $stmt->execute();
        $stmt->close();

    }

}
