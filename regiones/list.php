<?php

require_once '../layout/layout.php';
require_once '../helpers/utilities.php';
require_once './region.php';
require_once '../services/IServiceBase.php';
require_once '../helpers/FileHandler/IFileHandler.php';
require_once '../helpers/FileHandler/JsonFileHandler.php';
require_once '../database/PokemonsContext.php';
require_once './RegionServiceDatabase.php';

$layout = new Layout();
$service = new RegionServiceDatabase('../database');

$utilities = new Utilities();

$regiones = $service->GetList();

?>
<!-- Header -->
<?php $layout->printHeader();?>
<!-- Page Content -->
<div class="container mt-6">
    <!-- Titulo -->
    <div>
        <h1 class="is-inline title">Regiones pokemones</h1>
        <a href="add.php" class="button is-primary is-medium is-pulled-right">Nuevo Region</a>
    </div>


    <hr>

    <div class="table-container">
        <table class="table is-fullwidth is-bordered is-striped has-text-centered">
            <thead>
                <tr>
                    <th class="is-dark">Id</th>
                    <th class="is-dark">Region</th>
                    <th class="is-dark">Accion</th>

                </tr>
            </thead>
            <tbody>

                <?php if (empty($regiones)): ?>
                <tr>
                    <td colspan="6">
                        <h2>No hay regiones registradas</h2>
                    </td>
                </tr>
                <?php else: ?>

                <?php foreach ($regiones as $region): ?>
                <tr>
                    <th><?php echo $region->id; ?></th>
                    <td><?php echo $region->region; ?></td>
                    <td>
                        <a href="delete.php?id=<?php echo $region->id; ?>"
                            class="button is-danger is-rounded">Eliminar</a>
                        <a href="edit.php?id=<?php echo $region->id; ?>"
                            class="button is-warning is-rounded">Editar</a>
                    </td>
                </tr>
                <?php endforeach?>

                <?php endif?>
            </tbody>
        </table>

    </div>


</div>

<!-- Footer -->
<?php $layout->printFooter()?>