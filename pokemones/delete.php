<?php
require_once '../helpers/utilities.php';
require_once './pokemon.php';
require_once '../services/IServiceBase.php';
require_once '../helpers/FileHandler/IFileHandler.php';
require_once '../helpers/FileHandler/JsonFileHandler.php';
require_once '../database/PokemonsContext.php';
require_once './PokemonServiceDatabase.php';

$service = new PokemonServiceDatabase('../database');
$utilities = new Utilities();

if (isset($_GET['id'])) {

    $pokemonId = $_GET['id'];

    $service->Delete($pokemonId);

}

if (isset($_GET['mode'])) {
    $mode = ($_GET['mode']);

    header('Location: ./list.php?mode=' . $mode);
    exit();
}

header('Location: ./list.php');
exit();
