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

if (isset($_POST['tipo'])) {

    $tiposUpdated = new Tipo();

    $tiposUpdated->InitializeData(
        0,
        $_POST['tipo']
    );

    $service->Add($tiposUpdated);

    header('Location: ../index.php'); //Back Home
    exit();
}

?>

<?php $layout->printHeader();?>
<!-- Page Content -->
<div class="container my-5">
    <div>
        <a href="list.php" class="button is-primary is-medium">Volver</a>
    </div>

    <hr>

    <form action="add.php" method="POST">
        <div class="panel is-dark">
            <!-- TITULO -->
            <p class="panel-heading">
                Nuevo Tipo de Pokemon
            </p>

            <div class="px-5 py-5">

                <!-- CAMPO TIPOS -->
                <div class="field">
                    <label class="label">Tipos:</label>
                    <div class="control">
                        <input class="input" placeholder="Ingrese Tipos"
                            name="tipo" required></input>
                    </div>
                </div>


                <div class="field is-grouped">
                    <div class="control">
                        <button type="submit" class="button is-link">Agregar</button>
                    </div>
                    <div class="control">
                        <a href="list.php" class="button is-link is-light">Cancel</a>
                    </div>
                </div>

            </div>

        </div>
    </form>

</div>

</script>
<?php $layout->printFooter()?>