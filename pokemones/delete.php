<?php
require_once '../helpers/utilities.php';
require_once './pokemon.php';
require_once '../services/IServiceBase.php';
require_once '../helpers/FileHandler/IFileHandler.php';
require_once '../helpers/FileHandler/JsonFileHandler.php';
require_once '../database/PokemonsContext.php';
require_once './PokemonServiceDatabase.php';

$service = new PokemonServiceDatabase('../database');

if (isset($_GET['id'])) {

    $pokemonId = $_GET['id'];

    $service->Delete($pokemonId);

}

header('Location: ./list.php');
exit();
