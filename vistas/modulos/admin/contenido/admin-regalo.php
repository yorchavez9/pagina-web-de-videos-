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
                <li class="breadcrumb-item"><a href="javascript:void(0)">Video</a></li>
            </ol>
        </div>
        <!-- row -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#nuevoREgaloModal">Nuevo Video</button>
                        <h4 class="card-title">Tabla Video</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example3" class="display tabla_regalo responsive wrap" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Categoria B</th>
                                        <th>Código</th>
                                        <th>Video</th>
                                        <th>Miniatura</th>
                                        <th>Título</th>
                                        <th>Descripción</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $tipo = "normal";
                                    $item = null;
                                    $valor = null;
                                    $mostrarRegalo = ControladorRegalo::ctrMostrarRegalo($tipo, $item, $valor);
                                    foreach ($mostrarRegalo as $key => $value) {
                                    ?>
                                        <tr>
                                            <td><?php echo ($key + 1)  ?></td>
                                            <td><?php echo $value["nombre_c"]  ?></td>
                                            <td><?php echo $value["codigo_r"]  ?></td>

                                            <?php
                                            if ($value["video_r"] != "") {
                                            ?>
                                                <td>
                                                    <video controls poster="<?php echo  substr($value["imagen_r"],3) ?>" width="200" height="120">
                                                        <source src="<?php echo  substr($value["video_r"],3) ?>" type="video/mp4">
                                                    </video>
                                                </td>
                                            <?php
                                            } else {
                                            ?>
                                                <td>
                                                    <video controls poster="vistas/img/regalo/img/A001/back1.jpg" width="300" height="200">
                                                        <source src="vistas/img/regalo/default/default.mp4" type="video/mp4">
                                                    </video>
                                                </td>
                                            <?php
                                            }
                                            ?>
                                            <?php
                                            if ($value["imagen_r"] != "") {
                                            ?>
                                                <td>
                                                    <img src="<?php echo substr($value["imagen_r"],3) ?>" width="200" alt="">
                                                </td>
                                            <?php
                                            } else {
                                            ?>
                                                <td>
                                                    <img src="vistas/img/regalo/default/video.png" width="200" alt="">
                                                </td>
                                            <?php
                                            }
                                            ?>
                                            <td><?php echo $value["titulo_r"] ?></td>

                                            <td><?php echo $value["descripcion_r"] ?></td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="#" class="btn btn-primary shadow btn-xs sharp me-1 btnEditarRegalo" idRegalo="<?php echo $value["id_r"] ?>" data-bs-toggle="modal" data-bs-target="#editar_regalo"><i class="fas fa-pencil-alt"></i></a>
                                                    <a href="#" class="btn btn-danger shadow btn-xs sharp btnEliminarRegalo" idRegalo="<?php echo $value["id_r"] ?>" videoRegalo="<?php echo substr($value["video_r"],3) ?>" imagenRegalo="<?php echo substr($value["imagen_r"],3) ?>" codigoRegalo="<?php echo $value["codigo_r"] ?>"><i class="fa fa-trash"></i></a>
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
MODAL NUEVO REGALO
==================================== -->

<div id="nuevoREgaloModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form enctype="multipart/form-data">
                <div class="modal-header">
                    <h3 class="modal-title" id="myModalLabel"><b>Nuevo regalo</b></h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row col-md-12">
                        <!-- entrada de categoria -->
                        <div class="mb-3 col-md-6">
                            <label for="example-text-input" class="form-label"><b>Categoría</b></label>
                            <select class="form-select" name="nuevoIdCategoria" id="nuevoIdCategoria">
                                <option value="">Seleccione la categoría</option>
                                <?php
                                $item = null;
                                $valor = null;
                                $mostrarCategoria = ControladorCategoria::ctrMostrarCategoria($item, $valor);
                                foreach ($mostrarCategoria as $key => $value) {
                                ?>
                                    <option value="<?php echo $value["id_c"] ?>"><?php echo $value["nombre_c"] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>

                        <!-- entrada de código -->
                        <div class="mb-2 col-md-6">
                            <label for="example-text-input" class="form-label"><b>Código</b></label>
                            <?php
                            $tipo = "normal";
                            $item = null;
                            $valor = null;
                            $codigoR = ControladorRegalo::ctrMostrarRegalo($tipo, $item, $valor);
                            $contador = count($codigoR);
                            $ultimoDato = end($codigoR);
                            if($contador == 0){
                                echo '<label for="codigo">Ingrese el código:</label><small>(A001)</small>';
                            }else{
                                foreach($codigoR as $key => $value){
                                    if($ultimoDato == $value) {
                                        echo '<label for="codigo">Ingrese el código que sigue a:  </label>  <small class="bg-success" style="border-radius:2px 2px; color: white;">   ('.$value["codigo_r"].')</small>';

                                    }
                                }    
                            }
                            ?>
                            <input class="form-control" type="text" id="nuevoCodigoR" name="nuevoCodigoR" placeholder="Ingrese le código">
                        </div>
                    </div>


                    <div class="row col-md-12">
                        <!-- entrada de video -->
                        <div class="mb-2 col-md-6">
                            <label for="example-text-input" class="form-label"><b>Subir video</b></label>
                            <input class="form-file-input form-control nuevoVideoR" id="nuevoVideoR" type="file" accept="video/*" capture="camera" name="nuevoVideoR">
                        </div>
                        <!-- imagen del minuatura -->
                        <div class="mb-2 col-md-6">
                            <label for="example-text-input" class="form-label"><b>Subir miniatura</b></label>
                            <input class="form-file-input form-control nuevoFotoR" id="nuevoFotoR" type="file" accept="image/*" capture="camera" name="nuevoFotoR">
                        </div>

                    </div>

                    <!-- vista previa del video -->
                    <div class="mb-2">
                        <div class="text-center">
                            <small class="help-block">Peso máximo de la video 200MB</small><br><br>
                            <video controls class="previsualizarImagenR" load poster="" width="300" height="200">
                                <source id="previsualizarVideoR" src="" type="video/mp4">
                            </video>
                        </div>
                    </div>

                    <!-- entrada de titulo del video -->
                    <div class="mb-2">
                        <label for="example-text-input" class="form-label"><b>Título</b></label>
                        <textarea name="nuevoTituloR" class="form-control" id="nuevoTituloR" placeholder="Ingrese el titulo"></textarea>
                    </div>

                    <!-- entrada de descripcion -->
                    <div class="mb-2">
                        <label for="example-text-input" class="form-label"><b>Descripción</b></label>
                        <textarea id="summernoteNuevoR" name="nuevoDescripcionR" cols="30" rows="10" class="form-control"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button id="guardar_video" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div>
</div><!-- /.modal-dialog -->


<!-- ====================================
MODAL EDITAR REGALO
==================================== -->

<!-- ====================================
MODAL EDITAR PRECIO
==================================== -->

<div id="editar_regalo" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Editar Regalo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <!-- editar id del regalo -->
                    <div class="mb-3">
                        <input class="form-control" type="hidden" name="editarIdRegalo" id="editarIdRegalo" require>
                    </div>

                    <!-- editar codigo del regalo -->
                    <div class="mb-3">
                        <input class="form-control" type="hidden" name="editarCodigoR" id="editarCodigoR" require>
                    </div>
                    
                    <!-- editando el categoría -->
                    <div class="mb-3 col-md-6">
                        <label for="exampleInputEmail1">Selecciona el la categoría</label>
                        <select class="form-select" name="editarCategoriaR" id="editandoCategoríaR">
                            <option value="" id="editarCategoriaR"></option>
                            <?php 
                            $item = null;
                            $valor = null;
                            $servicioCategoria = ControladorCategoria::ctrMostrarCategoria($item, $valor);
                            foreach($servicioCategoria as $key => $value){
                                echo '<option value="'.$value["id_c"].'">'.$value["nombre_c"].'</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <div class="row col-md-12">
                        <!-- entrada de video -->
                        <div class="mb-2 col-md-6">
                            <label for="example-text-input" class="form-label"><b>Subir video</b></label>
                            <input class="form-file-input form-control editarVideoR" type="file" accept="video/*" capture="camera" id="editarVideoR" name="editarVideoR">
                            <input type="hidden" name="videoActualR" id="videoActualR">
                        </div>
                        <!-- imagen del minuatura -->
                        <div class="mb-2 col-md-6">
                            <label for="example-text-input" class="form-label"><b>Subir miniatura</b></label>
                            <input class="form-file-input form-control editarFotoR" type="file" accept="image/*" capture="camera" id="editarFotoR" name="editarFotoR">
                            <input type="hidden" name="fotoActualR" id="fotoActualR">
                        </div>

                    </div>

                    <!-- vista previa del video -->
                    <div class="mb-2">
                        <div class="text-center">
                            <small class="help-block">Peso máximo de la video 200MB</small><br><br>
                            <video controls class="previsualizarEditarImagenR" load poster="" width="300" height="200">
                                <source class="previsualizarEditarVideoR" src="" type="video/mp4">
                            </video>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Título</label>
                        <textarea name="editarTituloR" id="editarTituloR" class="form-control"></textarea>
                    </div>
                     <!-- entrada de descripcion -->
                     <div class="mb-2 custom-ekeditor">
                        <label for="example-text-input" class="form-label"><b>Descripción</b></label>
                        <textarea name="editarDescripcionR" id="summernoteEditarR" cols="30" rows="10" class="form-control editarDescripcionR"></textarea>
                    </div>
               
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Cerrar</button>
                    <button id="guardar_video_editado" class="btn btn-primary waves-effect waves-light">Guardar</button>
                </div>

            </form>
        </div>
    </div>
</div>


<!-- =========================================
BORRAR DATOS
========================================= -->
<?php
$borrarRegalo = new ControladorRegalo();
$borrarRegalo->ctrBorrarRegalo();
?>

<?php
} else {
    echo '<script>
            window.location = "admin-inicio";
        </script>';
    return;
}
?>