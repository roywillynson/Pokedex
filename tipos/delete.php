<?php
require_once '../helpers/utilities.php';
require_once './tipo.php';
require_once '../services/IServiceBase.php';
require_once '../helpers/FileHandler/IFileHandler.php';
require_once '../helpers/FileHandler/JsonFileHandler.php';
require_once '../database/PokemonsContext.php';
require_once './TiposServiceDatabase.php';

$service = new TiposServiceDatabase('../database');

if (isset($_GET['id'])) {

    $tipoId = $_GET['id'];

    $service->Delete($tipoId);

}

header('Location: ./list.php');

exit();
