<?php
if ($_SESSION["perfil_usuario"] == "Ayudante") {
    echo '<script>
        window.location = "admin-inicio";
    </script>';
    return;
}
?>

<!--**********************************
    Content body start
***********************************-->
<div class="content-body">
    <div class="container-fluid">

        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="admin-inicio">Inicio</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Usuarios</a></li>
            </ol>
        </div>
        <!-- row -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                    <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#nuevoUsuario">Nuevo usuario</button>
                        <h4 class="card-title">Tabla usuarios</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example3" class="display tabla_usuario" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Correo</th>
                                        <th>Foto</th>
                                        <th>Perfil</th>
                                        <th>Estado</th>
                                        <th>Último login</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $item = null;
                                    $valor = null;

                                    $mostrarUsuario = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
                                    foreach($mostrarUsuario as $key => $value){
                                    ?>
                                    <tr>
                                        <td><?php echo ($key + 1)  ?></td>
                                        <td><?php echo $value["nombre_usuario"]  ?></td>
                                        <td><?php echo $value["correo_usuario"]  ?></td>
                                        <?php
                                        if($value["foto_usuario"] != ""){
                                        ?>
                                            <td><img class="rounded-circle" width="50" src="<?php echo $value["foto_usuario"] ?>" alt=""></td>
                                        <?php
                                        }else{
                                        ?>
                                            <td><img class="rounded-circle" width="50" src="vistas/img/usuarios/default/default.jpg" alt=""></td>
                                        <?php
                                        }
                                        ?>
                                        <td><?php echo $value["perfil_usuario"] ?></td>
                                        <?php
                                        if ($value["estado_usuario"] != 0) {
                                        ?>    
                                            <td><button class="btn btn-success btn-xs btnActivar" idUsuario="<?php echo $value["id_usuario"] ?>" estadoUsuario="0">Activado</button></td>
                                        <?php
                                        } else {
                                        ?>
                                            <td><button class="btn btn-danger btn-xs btnActivar" idUsuario="<?php echo $value["id_usuario"] ?>" estadoUsuario="1">Desactivado</button></td>
                                        <?php
                                        }
                                        ?>
                                        <td><?php echo $value["ultimo_login_usuario"] ?></td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="#" class="btn btn-primary shadow btn-xs sharp me-1 btnEditarUsuario" idUsuario="<?php echo $value["id_usuario"] ?>" data-bs-toggle="modal" data-bs-target="#editar_usuario"><i class="fas fa-pencil-alt"></i></a>
                                                <a href="#" class="btn btn-danger shadow btn-xs sharp btnEliminarUsuario" idUsuario="<?php echo $value["id_usuario"] ?>" fotoUsuario="<?php echo $value["foto_usuario"] ?>" correo="<?php echo $value["correo_usuario"] ?>"><i class="fa fa-trash"></i></a>
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
MODAL NUEVO USUARIO
==================================== -->

<div id="nuevoUsuario" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-scroll="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Nuevo usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label for="example-text-input" class="form-label">Nombre completo</label>
                        <input class="form-control" type="text" name="nuevoNombre" placeholder="Nombre completo">
                    </div>
                    <div class="mb-2">
                        <label for="example-text-input" class="form-label">Correo electrónico</label>
                        <input class="form-control" type="text" name="nuevoCorreo" placeholder="Correo electrónico">
                    </div>
                    <div class="mb-2">
                        <label for="example-text-input" class="form-label">Contraseña</label>
                        <input class="form-control" type="password" name="nuevoPassword" placeholder="Contraseña">
                    </div>
                    <div class="mb-2">
                        <label for="example-text-input" class="form-label">Perfil</label>
                        <select class="form-select" name="nuevoPerfil" id="">
                            <option value="">Seleccione</option>
                            <option value="Administrador">Administrador</option>
                            <option value="Ayudante">Ayudante</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="example-text-input" class="form-label">Subir Foto</label>
                        <input class="form-control nuevoFoto" type="file" accept="image/*" capture="camera" name="nuevoFoto">
                        <div class="text-center">
                            <small class="help-block">Peso máximo de la foto 2MB</small><br><br>
                            <img src="vistas/img/usuarios/default/default.jpg" style="border-radius: 100%;" class="previsualizar" width="150px">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Guardar</button>
                </div>
                <?php
                $nuevoUsuario = new ControladorUsuarios();
                $nuevoUsuario->ctrCrearUsuario();
                ?>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<!-- ====================================
MODAL EDITAR USUARIO
==================================== -->

<div id="editar_usuario" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Editar usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nombre completo</label>
                        <input type="text" class="form-control" name="editarNombre" id="editarNombre" placeholder="Ingrese su nombre completo">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Dirección de correo electrónico</label>
                        <input type="email" class="form-control" name="editarCorreo" id="editarCorreo" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Contraseña</label>
                        <input type="password" class="form-control" name="editarPassword" id="editarPassword" placeholder="Ingrese la nueva contraseña">
                        <input type="hidden" id="passwordActual" name="passwordActual">
                    </div>

                    <div class="form-group">
                        <label>Perfil</label>
                        <select class="form-select" name="editarPerfil">
                            <option id="editarPerfil"></option>
                            <option value="Administrador">Administrador</option>
                            <option value="Ayudante">Ayudante</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Subir foto</label>
                        <input type="file" accept="image/*" capture="camera" class="form-control nuevaFoto" name="editarFoto">
                        <div class="text-center">
                            <small class="help-block">Peso máximo de la foto 2MB</small><br><br>
                            <img src="vistas/img/usuarios/default/automatico.png" style="border-radius: 100%;" class="previsualizarEditar" width="150px">
                        </div>
                        <input type="hidden" name="fotoActual" id="fotoActual">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Guardar</button>
                </div>
                <?php
                 $editarUsuario = new ControladorUsuarios();
                 $editarUsuario -> ctrEditarUsuario();
                ?>
            </form>
        </div>
    </div>
</div>

<!-- ===========================================
BORRAR USUARIO
=========================================== -->
<?php
$borrarUsuario = new ControladorUsuarios();
$borrarUsuario->ctrBorrarUsuario();
?>