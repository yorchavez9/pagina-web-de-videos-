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
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Categorias B</a></li>
                </ol>
            </div>
            <!-- row -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#nuevoCategoria">Nueva categoría B</button>
                            <h4 class="card-title">Tabla categoría</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example3" class="display tabla_categoria" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Categoría A</th>
                                            <th>Categoría B</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $item = null;
                                        $valor = null;

                                        $mostrarCategoria = ControladorCategoria::ctrMostrarCategoria($item, $valor);
                                        foreach ($mostrarCategoria as $key => $value) {
                                        ?>
                                            <tr>
                                                <td><?php echo ($key + 1)  ?></td>
                                                <td><?php echo $value["nombre_cp"]  ?></td>
                                                <td><?php echo $value["nombre_c"]  ?></td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="#" class="btn btn-primary shadow btn-xs sharp me-1 btnEditarCategoria" idCategoria="<?php echo $value["id_c"] ?>" data-bs-toggle="modal" data-bs-target="#editar_categoria"><i class="fas fa-pencil-alt"></i></a>
                                                        <a href="#" class="btn btn-danger shadow btn-xs sharp btnEliminarCategoria" idCategoria="<?php echo $value["id_c"] ?>"><i class="fa fa-trash"></i></a>
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
MODAL NUEVO CATEGORIA
==================================== -->

<div id="nuevoCategoria" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-scroll="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Nueva Categoría</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <!-- entrada de categoria -->
                    <div class="mb-3 col-md-6">
                        <label for="example-text-input" class="form-label"><b>Categoría A</b></label>
                        <select class="form-select" name="nuevoIdCategoriaP" id="nuevoIdCategoriaP">
                            <option value="">Seleccione la categoría A</option>
                            <?php
                            $item = null;
                            $valor = null;
                            $mostrarCategoriaP = ControladorCategoriaP::ctrMostrarCategoriaP($item, $valor);
                            foreach ($mostrarCategoriaP as $key => $value) {
                            ?>
                                <option value="<?php echo $value["id_cp"] ?>"><?php echo $value["nombre_cp"] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>

                    <!-- entrada de categoria B -->
                    <div class="mb-2">
                        <label for="example-text-input" class="form-label">Nombre categoria A</label>
                        <input class="form-control" type="text" name="nuevoNombreC" id="nuevoNombreC" placeholder="Ingrese la cateogoría">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" id="guardarSubCategoria" class="btn btn-primary waves-effect waves-light">Guardar</button>
                </div>

            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

    <!-- ====================================
MODAL EDITAR USUARIO
==================================== -->

<div id="editar_categoria" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Editar Categoría</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <!-- mostrando id de categoria B -->
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="editarIdCategoria" id="editarIdCategoria">
                    </div>

                    <!-- editando el categoría -->
                    <div class="mb-3">
                        <label for="exampleInputEmail1">Selecciona el la categoría Principal</label>
                        <select class="form-select" name="editarCategoriaP" id="editandoCategoriaP">
                            <option value="" id="editarCategoriaP"></option>
                            <?php 
                            $item = null;
                            $valor = null;
                            $servicioCategoria = ControladorCategoriaP::ctrMostrarCategoriaP($item, $valor);
                            foreach($servicioCategoria as $key => $value){
                                echo '<option value="'.$value["id_cp"].'">'.$value["nombre_cp"].'</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <!--  Editar nombre decategoria B -->
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nombre categoría</label>
                        <input type="text" class="form-control" name="editarNombreC" id="editarNombreC">
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" id="GuardarEditar" class="btn btn-primary waves-effect waves-light">Guardar</button>
                </div>
                
            </form>
        </div>
    </div>
</div>


<?php
} else {
    echo '<script>
    window.location = "admin-inicio";
    </script>';
    return;
}
?>