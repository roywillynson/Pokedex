<?php
require_once '../helpers/utilities.php';
require_once './region.php';
require_once '../services/IServiceBase.php';
require_once '../helpers/FileHandler/IFileHandler.php';
require_once '../helpers/FileHandler/JsonFileHandler.php';
require_once '../database/PokemonsContext.php';
require_once './RegionServiceDatabase.php';

$service = new RegionServiceDatabase('../database');

if (isset($_GET['id'])) {

    $regionId = $_GET['id'];

    $service->Delete($regionId);

}

header('Location: ../index.php');
exit();
