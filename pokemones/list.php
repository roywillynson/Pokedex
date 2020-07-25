<?php

require_once '../layout/layout.php';
require_once '../helpers/utilities.php';
require_once './pokemon.php';
require_once '../services/IServiceBase.php';
require_once '../helpers/FileHandler/IFileHandler.php';
require_once '../helpers/FileHandler/JsonFileHandler.php';
require_once '../database/PokemonsContext.php';
require_once './PokemonServiceDatabase.php';

$layout = new Layout();
$service = new PokemonServiceDatabase('../database');

$utilities = new Utilities();

$pokemones = $service->GetList();

?>
<!-- Header -->
<?php $layout->printHeader();?>
<!-- Page Content -->
<div class="container mt-6">
    <!-- Titulo -->
    <div>
        <h1 class="is-inline title">Tus Transacciones</h1>
        <a href="add.php" class="button is-primary is-medium is-pulled-right">Nuevo Pokemon</a>
    </div>


    <hr>

    <div class="table-container">
        <table class="table is-fullwidth is-bordered is-striped has-text-centered">
            <thead>
                <tr>
                    <th class="is-dark">Id</th>
                    <th class="is-dark">Nombre</th>
                    <th class="is-dark">Imagen</th>
                    <th class="is-dark">Region</th>
                    <th class="is-dark">Tipos</th>
                    <th class="is-dark">Accion</th>

                </tr>
            </thead>
            <tbody>

                <?php if (empty($pokemones)): ?>
                <tr>
                    <td colspan="6">
                        <h2>No hay pokemones</h2>
                    </td>
                </tr>
                <?php else: ?>

                <?php foreach ($pokemones as $pokemon): ?>
                <tr>
                    <th><?php echo $pokemon->id; ?></th>
                    <td><?php echo $pokemon->nombre; ?></td>
                    <td>
                        <figure class="image is-square">
                            <img style=""class="is-rounded" src="data:image/png;base64, <?php echo $pokemon->getImage64(); ?>" alt="Imagen">
                        </figure>
                    </td>
                    <td><?php echo $pokemon->region; ?></td>
                    <td><?php echo $pokemon->tipos; ?></td>
                    <td>
                        <a href="delete.php?id=<?php echo $pokemon->id; ?>"
                            class="button is-danger is-rounded">Eliminar</a>
                        <a href="edit.php?id=<?php echo $pokemon->id; ?>"
                            class="button is-warning is-rounded">Editar</a>
                        <a href="details.php?id=<?php echo $pokemon->id; ?>"
                            class="button is-info is-rounded">Ver Detalle</a>
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