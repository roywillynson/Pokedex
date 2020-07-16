<?php

require_once './helpers/utilities.php';
require_once './layout/layout.php';
require_once './transacciones/transaccion.php';
require_once './services/IServiceBase.php';
require_once './transacciones/TransaccionServiceCookie.php';
require_once './helpers/FileHandler/IFileHandler.php';
require_once './helpers/FileHandler/JsonFileHandler.php';
require_once './helpers/FileHandler/SerializationFileHandler.php';
require_once './helpers/FileHandler/CSVFileHandler.php';
require_once './transacciones/TransaccionServiceFile.php';
require_once './transacciones/log.php';

$utilities = new Utilities();
$layout = new Layout(false);
$service = new TransaccionServiceFile('./transacciones/data');


$transacciones = $service->GetList();
$traer=new CSVFileHandler('transacciones','./transacciones/data');
var_dump($traer->ReadFile());
var_dump(array_keys((new Transaccion())->get()));
?>
<!-- Header -->
<?php $layout->printHeader();?>
<!-- Page Content -->
<div class="container mt-6">
    <!-- Titulo -->
    <div>
        <h1 class="is-inline title">Tus Transacciones</h1>
        <a href="transacciones/add.php" class="button is-primary is-medium is-pulled-right">Nueva Transacción</a>
    </div>


    <hr>

    <div class="table-container">
        <table class="table is-fullwidth is-bordered is-striped has-text-centered">
            <thead>
                <tr>
                    <th class="is-dark">Id</th>
                    <th class="is-dark">Fecha</th>
                    <th class="is-dark">Tiempo</th>
                    <th class="is-dark">Monto</th>
                    <th class="is-dark">Descripcion</th>
                    <th class="is-dark">Accion</th>
                </tr>
            </thead>
            <tbody>

                <?php if(empty($transacciones)):?>
                <tr>
                    <td colspan="6">
                        <h2>No hay transacciones</h2>
                    </td>
                </tr>
                <?php else: ?>

                <?php foreach ($transacciones as $transaccion):?>
                <tr>
                    <th><?php echo $transaccion->id; ?></th>
                    <td><?php echo $transaccion->date; ?></td>
                    <td><?php echo $transaccion->time; ?></td>
                    <td><?php echo $transaccion->monto; ?></td>
                    <td><?php echo $transaccion->description; ?></td>
                    <td>
                        <a href="transacciones/delete.php?id=<?php echo $transaccion->id; ?>"
                            class="button is-danger is-rounded">Eliminar</a>
                        <a href="transacciones/edit.php?id=<?php echo $transaccion->id; ?>"
                            class="button is-warning is-rounded">Editar</a>
                    </td>
                </tr>
                <?php endforeach?>

                <?php endif ?>
            </tbody>
        </table>
        <div class="buttons">
            <a class="button is-success is-medium">exportar transacciones</a>
            <a class="button is-info is-medium">importar transacciones</a>
        </div>


    </div>
    <!-- MODAL -->
    <div class="modal">
        <div class="modal-background"></div>
        <div class="modal-content">

            <div class="file">
                <label class="file-label">
                    <input class="file-input" type="file" name="resume">
                    <span class="file-cta">
                        <span class="file-icon">
                            <i class="fas fa-upload"></i>
                        </span>
                        <span class="file-label">
                            Choose a file…
                        </span>
                    </span>
                </label>
            </div>

        </div>
        <button class="modal-close is-large" aria-label="close"></button>
    </div>

</div>
<!-- Footer -->
<?php $layout->printFooter()?>