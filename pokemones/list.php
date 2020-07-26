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
$utilities = new Utilities();

$service = new PokemonServiceDatabase('../database');
$serviceRegion = new RegionServiceDatabase('../database');
$serviceTipo = new TiposServiceDatabase('../database');

$regiones = $serviceRegion->GetList();
$tipos = $serviceTipo->GetList();
$pokemones = $service->GetList();

session_start();

if (!isset($_POST['thumbnailsMode']) or empty($_POST['thumbnailsMode'])) {

    $_SESSION['thumbnailsMode'] = false;
    var_dump($_SESSION['thumbnailsMode']);

}

?>
<!-- Header -->
<?php $layout->printHeader();?>

<?php if (!empty($regiones) and !empty($tipos)): ?>
<!-- Page Content -->
<div class="container mt-6">
    <!-- Titulo -->
    <div>
        <h1 class="is-inline title">Mis pokemones</h1>
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
                    <th class="is-dark">Ataques</th>
                    <th class="is-dark">Accion</th>

                </tr>
            </thead>
            <tbody>

                <?php if (empty($pokemones)): ?>
                <tr>
                    <td colspan="7">
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
                    <td><?php echo $pokemon->ataques; ?></td>
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

        <form action="list.php" method="GET">
            <div class="field is-grouped">
                <div class="control">
                    <a href="list.php?mode=<?php echo ($_SESSION['thumbnailsMode']) ? 'true' : 'false'; ?>" type="submit" class="button <?php echo ($_SESSION['thumbnailsMode']) ? 'is-link' : 'is-outline-link'; ?> is-medium">
                    <?php echo ($_SESSION['thumbnailsMode']) ? 'Desactivar Mode Thumbnails' : 'Activar Mode Thumbnails'; ?>
                    </a>
                </div>

            </div>
        </form>

    </div>


</div>
<?php else: ?>
<div class="container">
    <h2 class="title mt-5">Hey!! No tienes Regiones o Tipos asignados</h2>
    <div>
        <a href="../index.php" class="button is-primary is-medium">Volver al home</a>
    </div>
</div>
<?php endif?>


<!-- Footer -->
<?php $layout->printFooter()?>