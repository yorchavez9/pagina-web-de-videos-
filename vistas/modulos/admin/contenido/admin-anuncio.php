<?php
if ($_SESSION["perfil_usuario"] == "Ayudante" || $_SESSION["perfil_usuario"] == "Administrador") {

?>

    <!--**********************************
    Content body start
***********************************-->
    <div class="content-body">
        <div class="container-fluid">

            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="admin-inicio">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Anuncio</a></li>
                </ol>
            </div>
            <!-- row -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#nuevoAnuncio">Nuevo anuncio</button>
                            <h4 class="card-title">Tabla anuncio</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example3" class="display tabla_anuncio" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Video</th>
                                            <th>Código</th>
                                            <th>imagen anuncio</th>
                                            <th>Imagen banner</th>
                                            <th>Título</th>
                                            <th>Descripción</th>
                                            <th>Link</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $item = null;
                                        $valor = null;
                                        $mostrarAnuncio = ControladorAnuncio::ctrMostrarAnuncio($item, $valor);
                                        foreach ($mostrarAnuncio as $key => $value) {
                                        ?>
                                            <tr>
                                                <td><?php echo ($key + 1)  ?></td>
                                                <td><?php echo $value["titulo_r"]  ?></td>
                                                <td><?php echo $value["codigo_a"]  ?></td>

                                                <?php
                                                if ($value["imagen_a"] != "") {
                                                ?>
                                                    <td>
                                                        <img src="<?php echo $value["imagen_a"] ?>" width="100%" height="50%" alt="">
                                                    </td>
                                                <?php
                                                } else {
                                                ?>
                                                     <td>
                                                        <img src="vistas/img/anuncio/default/default.png" width="100%" height="50%" alt="">
                                                    </td>
                                                <?php
                                                }

                                                ?>
                                                <?php
                                                if ($value["imagen_a_b"] != "") {
                                                ?>
                                                    <td>
                                                        <img src="<?php echo $value["imagen_a_b"] ?>" width="100%" height="50%" alt="">
                                                    </td>
                                                <?php
                                                } else {
                                                ?>
                                                    <td>
                                                        <img src="vistas/img/anuncio/default/default.png" width="100%" height="50%" alt="">
                                                    </td>
                                                <?php
                                                }
                                                ?>
                                                <td><?php echo $value["titulo_a"] ?></td>
                                                <td><?php echo $value["descripcion_a"] ?></td>
                                                <td><a class="text-primary" href="<?php echo $value["link_a"] ?>" target="_blank"><i class="fa fa-eye"></i> Link</a></td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="#" class="btn btn-primary shadow btn-xs sharp me-1 btnEditarAnuncio" idAnuncio="<?php echo $value["id_a"] ?>" data-bs-toggle="modal" data-bs-target="#editar_anuncio"><i class="fas fa-pencil-alt"></i></a>
                                                        <a href="#" class="btn btn-danger shadow btn-xs sharp btnEliminarAnuncio" idAnuncio="<?php echo $value["id_a"] ?>" imagenAnuncio="<?php echo $value["imagen_a"] ?>" imagenBanner="<?php echo $value["imagen_a_b"] ?>" condigoAnuncio="<?php echo $value["codigo_a"] ?>"><i class="fa fa-trash"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--**********************************
    Content body end
***********************************-->


    <!-- ====================================
MODAL NUEVO ANUNCIO
==================================== -->

<div id="nuevoAnuncio" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h3 class="modal-title" id="myModalLabel"><b>Nuevo anuncio</b></h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row col-md-12">

                        <!-- entrada de video -->
                        <div class="mb-3 col-md-6">
                            <label for="example-text-input" class="form-label"><b>Categoría</b></label>
                            <select class="form-select" name="nuevaCategoria" id="nuevaCategoria" required>
                                <option value="">Seleccionar categoría </option>
                                <?php
                                $item = null;
                                $valor = null;
                                $categoria = ControladorCategoria::ctrMostrarCategoria($item, $valor);
                                foreach ($categoria as $key => $value) {
                                    echo '<option value="' . $value["id_c"] . '">' . $value["nombre_c"] . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <!-- entrada de video -->
                        <div class="mb-3 col-md-6">
                            <label for="example-text-input" class="form-label"><b>Regalo video</b></label>
                            <select class="form-select" name="nuevoIdRegalo" id="nuevoIdRegalo" required>
                                <option value="">Seleccionar el video</option>
                            </select>
                        </div>

                    </div>


                    <!-- entrada de código -->
                    <div class="mb-2 col-md-4">
                        <label for="example-text-input" class="form-label"><b>Código</b></label>
                        <?php

                        $item = null;
                        $valor = null;
                        $codigoA = ControladorAnuncio::ctrMostrarAnuncio($item, $valor);
                        $contador = count($codigoA);
                        $ultimoDato = end($codigoA);
                        if ($contador == 0) {
                            echo '<label for="codigo">Ingrese el código:</label><small>(A001)</small>';
                        } else {
                            foreach ($codigoA as $key => $value) {
                                if ($ultimoDato == $value) {
                                    echo '<label for="codigo">Ingrese el código que sigue a:  </label>  <small class="bg-success" style="border-radius:2px 2px; color: white;">   (' . $value["codigo_a"] . ')</small>';
                                }
                            }
                        }
                        ?>
                        <input class="form-control" type="text" name="nuevoCodigoA" placeholder="Ingrese le código">
                    </div>

                    <div class="row col-md-12">
                        <!-- entrada de video -->
                        <div class="mb-2 col-md-6">
                            <label for="example-text-input" class="form-label"><b>Subir imagen main</b></label>
                            <input class="form-file-input form-control nuevoImagenAM" type="file" accept="image/*" capture="camera" name="nuevoImagenAM">
                            <div class="text-center mb-3">
                                <img src="vistas/img/anuncio/default/default.png" class="previsualizarMainImagen" width="200" height="200" alt="">
                            </div>
                        </div>

                        <!-- entrada de video -->
                        <div class="mb-2 col-md-6">
                            <label for="example-text-input" class="form-label"><b>Subir imagen banner</b></label>
                            <input class="form-file-input form-control nuevoImagenAB" type="file" accept="image/*" capture="camera" name="nuevoImagenAB">
                            <div class="text-center mb-3">
                                <img src="vistas/img/anuncio/default/defaultB.png" class="previsualizarBannerImagen" width="200" height="130" alt="">
                            </div>
                        </div>

                    </div>

                    <!-- entrada de titulo del video -->
                    <div class="mb-2">
                        <label for="example-text-input" class="form-label"><b>Título</b></label>
                        <textarea name="nuevoTituloA" class="form-control" id="" placeholder="Ingrese el titulo del anuncio"></textarea>
                    </div>

                    <!-- entrada de descripcion -->
                    <div class="mb-2">
                        <label for="example-text-input" class="form-label"><b>Descripción</b></label>
                        <textarea id="nuevoDescripcionA" name="nuevoDescripcionA" cols="30" rows="10" class="form-control"></textarea>
                    </div>

                    <!-- entrada de link -->
                    <div class="mb-2">
                        <label for="example-text-input" class="form-label"><b>Link del anuncio</b></label>
                        <textarea name="nuevoLinkA" id="" cols="30" rows="10" class="form-control" placeholder="Ingrese el link del anuncio"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
                <?php
                $nuevoAnuncio  = new ControladorAnuncio();
                $nuevoAnuncio->ctrCrearAnuncio();

                ?>
            </form>
        </div><!-- /.modal-content -->
    </div>
</div><!-- /.modal-dialog -->


    <!-- ====================================
MODAL EDITAR ANUNCIO
==================================== -->

    <!-- ====================================
MODAL EDITAR ANUNCIO
==================================== -->

<div id="editar_anuncio" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Editar Anuncio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                      
                     <!-- editar id de anuncio  -->  
                    <div class="mb-3">
                        <input class="form-control" type="hidden" name="editarIdAnuncio" id="editarIdAnuncio" require>
                    </div>

                    <!-- editar codigo del anuncio -->
                    <div class="mb-3">
                        <input class="form-control" type="hidden" name="editarCodigoA" id="editarCodigoA" require>
                    </div>

                    <div class="row col-md-12">

                        <!-- editar cateogria del anuncio -->
                        <div class="mb-3 col-md-6">
                            <label for="exampleInputEmail1"><b>Categoría del anuncio</b></label>
                            <select class="form-select" name="editarCategoriaAn" id="editarCategoriaAn">
                                <option value="" id="editarCategoriaA"></option>
                                <?php
                                $item = null;
                                $valor = null;
                                $servicioCategoria = ControladorCategoria::ctrMostrarCategoria($item, $valor);
                                foreach ($servicioCategoria as $key => $value) {
                                    echo '<option  value="' . $value["id_c"] . '">' . $value["nombre_c"] . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <!-- editar titulo del video del anuncio -->
                        <div class="mb-3 col-md-6">
                            <label for="exampleInputEmail1"><b>Título del video</b></label>
                            <select class="form-select" name="editarRegaloA" id="editarRegaloAB">
                                <option value="" id="editarRegaloA"></option>
                            </select>
                        </div>

                    </div>

                    <div class="row col-md-12">

                        <!-- editar imagen  anuncio -->
                        <div class="mb-2 col-md-6">
                            <label for="example-text-input" class="form-label"><b>Imagen principal del anuncio</b></label>
                            <input class="form-file-input form-control editarImagenA" type="file" accept="image/*" capture="camera" id="editarImagenA" name="editarImagenA">
                            <div>
                                <img src="" class="previsualizadorImagenAnuncio" alt="" width="200" height="200">
                            </div>
                            <input type="text" name="imagenActualA" id="imagenActualA" class="form-control">
                        </div>

                        <!-- imagen de banner del anuncio-->
                        <div class="mb-2 col-md-6">
                            <label for="example-text-input" class="form-label"><b>Imagen banner del anuncio</b></label>
                            <input class="form-file-input form-control editarImagenB" type="file" accept="image/*" capture="camera" id="editarImagenB" name="editarImagenB">
                            <div>
                                <img src="" class="previsualizarImagenBanner" alt="" width="200" height="130">
                            </div>
                            <input type="text" name="imagenActualB" id="imagenActualB" class="form-control">
                        </div>

                    </div>

                    <!--  editar titulo del anuncio -->
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label"><b>Título del anuncio</b></label>
                        <textarea name="editarTituloR" id="editarTituloR" class="form-control"></textarea>
                    </div>

                    <!-- editar descripción del anuncio -->
                    <div class="mb-2 custom-ekeditor">
                        <label for="example-text-input" class="form-label"><b>Descripción del anuncio</b></label>
                        <textarea name="editarDescripcionA" id="summernoteEditarA" cols="30" rows="10" class="form-control editarDescripcionA"></textarea>
                    </div>

                    <!-- editar link del anuncio -->
                    <div class="mb-2 custom-ekeditor">
                        <label for="example-text-input" class="form-label"><b>link del anuncio</b></label>
                        <textarea name="editarLinkA" id="editarLinkA" cols="30" rows="10" class="form-control"></textarea>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Guardar</button>
                </div>
                <?php

                $editarAnuncio = new ControladorAnuncio();
                $editarAnuncio->ctrEditarAnuncio();
                ?>
            </form>
        </div>
    </div>
</div>
<!-- ===========================================
BORRAR ANUNCIO
=========================================== -->
<?php
$borrarAnuncio = new ControladorAnuncio();
$borrarAnuncio->ctrBorrarAnuncio();
?>

<?php
} else {
    echo '<script>
            window.location = "admin-inicio";
        </script>';
    return;
}
?>