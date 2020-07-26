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

    <!-- --->

    <?php if ($utilities->hasThumbnailsMode() == false): ?>
    <!--MODE TABLA-->
    <div class="table-container">
        <table class="table is-fullwidth is-bordered is-striped has-text-centered is-size-5">
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
                        <a href="delete.php?id=<?php echo $pokemon->id; ?>&mode=<?php echo ($utilities->hasThumbnailsMode()) ? 'true' : 'false'; ?>"
                            class="button is-medium is-danger is-rounded">Eliminar</a>
                        <a href="edit.php?id=<?php echo $pokemon->id; ?>&mode=<?php echo ($utilities->hasThumbnailsMode()) ? 'true' : 'false'; ?>"
                            class="button is-medium is-warning is-rounded">Editar</a>
                        <a href="details.php?id=<?php echo $pokemon->id; ?>&mode=<?php echo ($utilities->hasThumbnailsMode()) ? 'true' : 'false'; ?>"
                            class="button is-medium is-info is-rounded">Detalle</a>
                    </td>

                </tr>
                <?php endforeach?>

                <?php endif?>
            </tbody>
        </table>

    </div>

    <?php else: ?>
    <!--MODE THUMBNAILS-->

    <div class="container">

        <div class="columns is-multiline is-1-mobile is-0-tablet is-3-desktop is-8-widescreen is-2-fullhd">
            <?php if (empty($pokemones)): ?>

                <h2>No hay pokemones</h2>

            <?php else: ?>

            <?php foreach ($pokemones as $pokemon): ?>
            <div class="column is-one-third">
                <div class="card mb-4">
                <div class="card-image">
                    <figure class="image is-4by3">
                        <img src="data:image/png;base64, <?php echo $pokemon->getImage64(); ?>" alt="Imagen">
                    </figure>
                </div>

                <div class="card-content">
                    <div class="media">
                        <div class="media-left">
                            <figure class="image is-48x48">
                            <img src="../assets/img/pokeball.png" alt="Placeholder image">
                            </figure>
                        </div>
                        <div class="media-content">
                            <p class="title is-4"><?php echo $pokemon->nombre; ?></p>
                        </div>
                    </div>

                    <div class="media">
                        <div class="media-left">
                            <figure class="image is-48x48">
                            <img src="../assets/img/mountain.png" alt="Placeholder image">
                            </figure>
                        </div>
                        <div class="media-content">
                            <p class="title is-4"><?php echo $pokemon->region; ?></p>
                        </div>
                    </div>

                    <div class="content">
                    <span class="has-text-dark">Tipos:</span>
                    <?php echo $pokemon->tipos; ?>

                    <br>
                    <span class="has-text-dark">Ataques:</span>
                    <?php echo $pokemon->ataques; ?>
                    </div>
                </div>

                <footer class="card-footer">
                    <a href="delete.php?id=<?php echo $pokemon->id; ?>"
                            class="card-footer-item">Eliminar</a>
                    <a href="edit.php?id=<?php echo $pokemon->id; ?>"
                            class="card-footer-item">Editar</a>
                     <a href="details.php?id=<?php echo $pokemon->id; ?>"
                            class="card-footer-item">Detalle</a>
                </footer>

                </div>
            </div>
            <?php endforeach?>
            <?php endif?>
        </div>
    </div>

    <?php endif;?>

     <form action="list.php" method="GET">
        <div class="field is-grouped">
            <div class="control">
                <a href="list.php?mode=<?php echo ($utilities->hasThumbnailsMode()) ? 'false' : 'true'; ?>" type="submit" class="button <?php echo ($utilities->hasThumbnailsMode()) ? 'is-link' : 'is-outline-link'; ?> is-medium">
                <?php echo ($utilities->hasThumbnailsMode()) ? 'Desactivar Mode Thumbnails' : 'Activar Mode Thumbnails'; ?>
                </a>
            </div>

        </div>
    </form>


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