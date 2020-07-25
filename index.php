<?php

require_once './helpers/utilities.php';
require_once './layout/layout.php';
require_once './pokemones/pokemon.php';
require_once './services/IServiceBase.php';
require_once './helpers/FileHandler/IFileHandler.php';
require_once './helpers/FileHandler/JsonFileHandler.php';
require_once './database/PokemonsContext.php';
require_once './pokemones/PokemonServiceDatabase.php';

$layout = new Layout(true);
$service = new PokemonServiceDatabase('database');

$utilities = new Utilities();

$pokemones = $service->GetList();

?>
<!-- Header -->
<?php $layout->printHeader();?>
<!-- Page Content -->
<div class="container mt-6">
    <!-- Titulo -->
    <div>
        <h1 class="is-inline title">Pokedex</h1>
    </div>

    <hr>

    <div class="menu">

        <ul class="menu-list">
            <li class="mt-5"><a href="pokemones/list.php" class="px-3  button is-large is-danger has-text-centered">Listados de Pokemones</a></li>
            <li class="mt-5"><a href="regiones/list.php" class="px-3  button is-large is-primary has-text-centered">Listados de Regiones</a></li>
            <li class="mt-5"><a href="tipos/list.php" class="px-3  button is-large is-info has-text-centered">Listados de Tipos</a></li>
        </ul>
    </div>

</div>

<!-- Footer -->
<?php $layout->printFooter()?>