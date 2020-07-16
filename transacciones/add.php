<?php

require_once '../layout/layout.php';
require_once '../helpers/utilities.php';
require_once './transaccion.php';
require_once '../services/IServiceBase.php';
require_once './TransaccionServiceCookie.php';
require_once '../helpers/FileHandler/IFileHandler.php';
require_once '../helpers/FileHandler/JsonFileHandler.php';
require_once '../helpers/FileHandler/SerializationFileHandler.php';
require_once '../helpers/FileHandler/CSVFileHandler.php';
require_once './TransaccionServiceFile.php';
require_once './log.php';

$layout = new Layout(true);

$service = new TransaccionServiceFile();
$utilities = new Utilities();

var_dump($_POST);

if (isset($_POST['monto']) && isset($_POST['description'])) {

    $dateNow = $utilities->getCurrentDateTime('Y-m-d'); //Fecha
    $timeNow = $utilities->getCurrentDateTime('H:i:s'); //Tiempo


    $newTransaccion = new Transaccion();
    $newTransaccion->InitializeData(0, $_POST['monto'], $_POST['description'], $dateNow, $timeNow );

    $service->Add($newTransaccion);

    header('Location: ../index.php'); //Back Home
    exit();
}

?>

<?php $layout->printHeader();?>
<!-- Page Content -->
<div class="container my-5">
    <div>
        <a href="../" class="button is-primary is-medium">Volver</a>
    </div>

    <hr>

    <form action="add.php" method="POST">
        <div class="panel is-dark">
            <!-- TITULO -->
            <p class="panel-heading">
                Registrar Transaccion
            </p>

            <div class="px-5 py-5">
                <!-- CAMPO MONTO -->
                <div class="field">
                    <label class="label">Monto:</label>
                    <div class="control">
                        <input class="input" type="number" placeholder="Ingrese monto" name="monto" required>
                    </div>
                </div>
                <!--
                 CAMPO FECHA 
                <div class="field">
                    <label class="label">Fecha</label>
                    <div class="control">
                        <input class="input" type="date" value="">
                    </div>
                </div>
                -->
                <div class="field">
                    <label class="label">Descripci&oacute;n (Opcional):</label>
                    <div class="control">
                        <textarea class="textarea" placeholder="Ingrese Mensaje" name="description"></textarea>
                    </div>
                </div>



                <div class="field is-grouped">
                    <div class="control">
                        <button type="submit" class="button is-link">Agregar</button>
                    </div>
                    <div class="control">
                        <a href="../index.php" class="button is-link is-light">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </form>



</div>
<?php $layout->printFooter()?>