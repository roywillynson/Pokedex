<?php
require_once '../helpers/utilities.php';
require_once '../layout/layout.php';
require_once './pokemon.php';
require_once '../services/IServiceBase.php';
require_once '../helpers/FileHandler/IFileHandler.php';
require_once '../helpers/FileHandler/JsonFileHandler.php';
require_once '../database/PokemonsContext.php';
require_once './PokemonServiceDatabase.php';

$layout = new Layout();
$service = new PokemonServiceDatabase('../database');

$utilities = new Utilities();

if (isset($_GET['id'])) {

    $pokemonId = $_GET['id'];
    $pokemon = $service->GetById($pokemonId);

    if (isset($_POST['nombre']) && isset($_POST['region']) && isset($_POST['tipos'])) {

        $pokemonUpdated = new Pokemon();

        $imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name'])); //Imagen Blob

        $pokemonUpdated->InitializeData(
            $pokemonId,
            $_POST['nombre'],
            $imagen,
            $_POST['region'],
            $_POST['tipos'],
            null
        );

        $service->Update($pokemonId, $pokemonUpdated);

        header('Location: ../index.php'); //Back Home
        exit();

    }

} else {

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

    <form action="edit.php?id=<?php echo $pokemon->id; ?>" method="POST" enctype="multipart/form-data">
        <div class="panel is-dark">
            <!-- TITULO -->
            <p class="panel-heading">
                Editar Transaccion
            </p>

            <div class="px-5 py-5">

                <!-- CAMPO MONTO -->
                <div class="field">
                    <label class="label">Monto:</label>
                    <div class="control">
                        <input class="input" type="number" value="<?php echo $transaccion->monto; ?>"
                            placeholder="Ingrese monto" name="monto" required>
                    </div>
                </div>

                <!-- CAMPO FECHA  -->
                <div class="field">
                    <label class="label">Fecha:</label>
                    <div class="control">
                        <input class="input" type="date" value="<?php echo $transaccion->date; ?>"
                            pattern="\d{2}-\d{2}-\d{4}" disabled>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Horario:</label>
                    <div class="control">
                        <input class="input" type="time" value="<?php echo $transaccion->time; ?>" disabled>
                    </div>
                </div>

                <!-- CAMPO DESCRIPTION -->
                <div class="field">
                    <label class="label">Descripci&oacute;n (Opcional):</label>
                    <div class="control">
                        <textarea class="textarea" placeholder="Ingrese Mensaje"
                            name="description"><?php echo $transaccion->description; ?></textarea>
                    </div>
                </div>


                <div class="field is-grouped">
                    <div class="control">
                        <button type="submit" class="button is-link">Actualizar</button>
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