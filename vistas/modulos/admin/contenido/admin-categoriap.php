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
                <li class="breadcrumb-item"><a href="javascript:void(0)">Categoría A</a></li>
            </ol>
        </div>
        <!-- row -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                    <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#nuevoCategoriaP">Nueva categoría A</button>
                        <h4 class="card-title">Tabla categoría A</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example3" class="display tabla_categoriap" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Categoría A</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $item = null;
                                    $valor = null;

                                    $mostrarCategoriaP = ControladorCategoriaP::ctrMostrarCategoriaP($item, $valor);
                                    foreach($mostrarCategoriaP as $key => $value){
                                    ?>
                                    <tr>
                                        <td><?php echo ($key + 1)  ?></td>
                                        <td><?php echo $value["nombre_cp"]  ?></td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="#" class="btn btn-primary shadow btn-xs sharp me-1 btnEditarCategoriaP" idCategoriaP="<?php echo $value["id_cp"] ?>" data-bs-toggle="modal" data-bs-target="#editar_categoriaP"><i class="fas fa-pencil-alt"></i></a>
                                                <a href="#" class="btn btn-danger shadow btn-xs sharp btnEliminarCategoriaP" idCategoriaP="<?php echo $value["id_cp"] ?>"><i class="fa fa-trash"></i></a>
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

<div id="nuevoCategoriaP" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-scroll="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Nueva Categoría</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label for="example-text-input" class="form-label">Nombre categoria</label>
                        <input class="form-control" type="text" name="nuevoNombreCP" id="nuevoNombreCP" placeholder="Ingrese la cateogoría">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" id="guardar_categoriap" class="btn btn-primary waves-effect waves-light">Guardar</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<!-- ====================================
MODAL EDITAR USUARIO
==================================== -->

<div id="editar_categoriaP" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Editar Categoría</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="editarIdCategoriaP" id="editarIdCategoriaP">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nombre categoría A</label>
                        <input type="text" class="form-control" name="editarNombreCP" id="editarNombreCP">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" id="guardarCPAEditado" class="btn btn-primary waves-effect waves-light">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>



<?php
}
else{
    echo '<script>
    window.location = "admin-inicio";
    </script>';
    return;
    }
?>