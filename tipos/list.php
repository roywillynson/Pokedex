<?php

require_once '../layout/layout.php';
require_once '../helpers/utilities.php';
require_once './tipo.php';
require_once '../services/IServiceBase.php';
require_once '../helpers/FileHandler/IFileHandler.php';
require_once '../helpers/FileHandler/JsonFileHandler.php';
require_once '../database/PokemonsContext.php';
require_once './TiposServiceDatabase.php';

$layout = new Layout();
$service = new TiposServiceDatabase('../database');

$utilities = new Utilities();

$tipos = $service->GetList();

?>
<!-- Header -->
<?php $layout->printHeader();?>
<!-- Page Content -->
<div class="container mt-6">
    <!-- Titulo -->
    <div>
        <h1 class="is-inline title">Tipos de pokemones registrados</h1>
        <a href="add.php" class="button is-primary is-medium is-pulled-right">Nuevo Tipo de Pokemon</a>
    </div>


    <hr>

    <div class="table-container">
        <table class="table is-fullwidth is-bordered is-striped has-text-centered">
            <thead>
                <tr>
                    <th class="is-dark">Id</th>
                    <th class="is-dark">Tipos</th>
                    <th class="is-dark">Accion</th>

                </tr>
            </thead>
            <tbody>

                <?php if (empty($tipos)): ?>
                <tr>
                    <td colspan="6">
                        <h2>No hay tipos de Pokemones registrados</h2>
                    </td>
                </tr>
                <?php else: ?>

                <?php foreach ($tipos as $tipo): ?>
                <tr>
                    <th><?php echo $tipo->id; ?></th>
                    <td><?php echo $tipo->tipo; ?></td>
                    <td>
                        <a href="delete.php?id=<?php echo $tipo->id; ?>"
                            class="button is-danger is-rounded">Eliminar</a>
                        <a href="edit.php?id=<?php echo $tipo->id; ?>"
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