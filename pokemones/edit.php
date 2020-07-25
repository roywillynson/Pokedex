<?php
require_once '../layout/layout.php';
require_once '../helpers/utilities.php';
require_once './pokemon.php';
require_once '../tipos/tipo.php';
require_once '../regiones/region.php';
require_once '../services/IServiceBase.php';
require_once '../helpers/FileHandler/IFileHandler.php';
require_once '../helpers/FileHandler/JsonFileHandler.php';
require_once '../database/PokemonsContext.php';
require_once './PokemonServiceDatabase.php';
require_once '../regiones/RegionServiceDatabase.php';
require_once '../tipos/TiposServiceDatabase.php';

$layout = new Layout();
$service = new PokemonServiceDatabase('../database');
$serviceRegion = new RegionServiceDatabase('../database');
$serviceTipo = new TiposServiceDatabase('../database');

$regiones = $serviceRegion->GetList();
$tipos = $serviceTipo->GetList();

$utilities = new Utilities();

if (isset($_GET['id'])) {

    $pokemonId = $_GET['id'];
    $pokemon = $service->GetById($pokemonId);

    if (isset($_POST['nombre']) && isset($_POST['region']) && isset($_POST['tipos'])) {

        $pokemonUpdated = new Pokemon();

        $tipos = $utilities->joinArray($_POST['tipos']);

        $pokemonUpdated->InitializeData(
            $pokemonId,
            $_POST['nombre'],
            $pokemon->imagen,
            $_POST['region'],
            $tipos,
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
                Editar Pokemon
            </p>

            <div class="px-5 py-5">
                <!-- File -->
                <div class="file has-name py-5">
                    <label class="file-label">
                        <input class="file-input" type="file" name="imagen"
                            accept="image/jpg, image/jpeg, image/png,image/gif" id="imagen-file">
                        <span class="file-cta">
                            <span class="file-label">
                                Seleccione un imagen nueva
                            </span>
                        </span>
                        <span class="file-name">
                        </span>
                    </label>
                </div>

                <!-- CAMPO NAME-->
                <div class="field">
                    <label class="label">Nombre:</label>
                    <div class="control">
                        <input class="input"
                        type="text"
                        placeholder="Ingrese nombre"
                        name="nombre"
                        value="<?php echo $pokemon->nombre; ?>" required>
                    </div>
                </div>

                <!-- CAMPO TIPOS -->

                <div class="field">
                    <div class="control">
                        <div class="label">Tipos:</div>
                        <?php foreach ($tipos as $tipo): ?>
                            <?php if (in_array($tipo->tipo, $utilities->splitArray($pokemon->tipos))): ?>
                            <label class="checkbox mr-4">
                                <input type="checkbox" value="<?php echo $tipo->tipo; ?>" name="tipos[]" checked>
                                <?php echo $tipo->tipo; ?>
                            </label>
                            <?php else: ?>
                                <label class="checkbox mr-4">
                                <input type="checkbox" value="<?php echo $tipo->tipo; ?>" name="tipos[]">
                                <?php echo $tipo->tipo; ?>
                            </label>
                            <?php endif;?>
                        <?php endforeach;?>
                    </div>
                </div>


                <!-- CAMPO Region -->
                 <div class="field">
                    <div class="control">
                        <div class="label">Region:</div>
                        <?php foreach ($regiones as $region): ?>

                            <?php if ($region->region === $pokemon->region): ?>

                            <label class="radio">
                                <input type="radio" name="region" value="<?php echo $region->region; ?>"  checked>
                                <?php echo $region->region; ?>
                            </label>

                            <?php else: ?>

                            <label class="radio">
                                <input type="radio" name="region" value="<?php echo $region->region; ?>"  >
                                <?php echo $region->region; ?>
                            </label>

                            <?php endif;?>
                        <?php endforeach;?>
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

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function (e) {

        $inputFile = document.getElementById('imagen-file');
        $fileName = document.querySelector('.file-name');

        $inputFile.addEventListener('change', function () {

            var fileName = this.value.split('\\').pop();
            $fileName.innerText = fileName;

        })

    });
</script>

<?php $layout->printFooter()?>