<!-- Login -->
<div class="modal fade" id="modalLogin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <?php
    $item = null;
    $valor = null;

    $Usuario = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
    $contarUsuario = count($Usuario);
    if ($contarUsuario <= 0) {
    ?>
      <form  method="post" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <div class="text-center">
              <h3 class="modal-title" id="exampleModalLabel">Registrarse</h3>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <!-- entrada del nombre -->
            <div class="form-group mb-3">
              <input style="font-size: 15px;" type="text" name="nuevoNombre" class="form-control" placeholder="Ingrese su nombre completo" required>
            </div>
            <!-- entrada de correo -->
            <div class="form-group mb-3">
              <input style="font-size: 15px;" type="email" name="nuevoCorreo" class="form-control" placeholder="Ingrese su correo" required>
            </div>
            <!-- entrada de contraseña -->
            <div class="form-group mb-3 d-flex">
              <input style="font-size: 15px;" type="password" id="password" name="nuevoPassword" class="form-control" placeholder="Ingrese su contraseña" required>
              <button type="button" class="btn" style="font-size: 20px;" onclick="mostrarContrasena()"><i class="bi bi-eye"></i></button>
            </div>
            <!-- entrada de perfil -->
            <div class="form-group mb-3">
              <select style="font-size: 15px;" class="form-select" name="nuevoPerfil" id="nuevoPerfil" required>
                <option>Seleccione perfil</option>
                <option value="Administrador">Administrador</option>
              </select>
            </div>
            <!-- entrada de foto -->
            <div class="form-group mb-3 text-center">
              <div class="panel">SUBIR FOTO</div>
              <input style="font-size: 15px;" type="file" class="form-control nuevoFotoLogin" name="nuevoFoto">
              <small>Peso maximo de la foto 2MB</small><br>
              <img src="vistas/img/usuarios/default/default.jpg" style="border-radius: 100%;" class="previsualizarLogin text-center" width="200px" height="200px" alt=""  >
                        
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
            <button type="submit" class="btn btn-primary">Registrarse</button>
          </div>
        </div>
        <?php
        $crearUsuario = new ControladorUsuarios();
        $crearUsuario->ctrCrearUsuario();
        ?>
      </form>
    <?php
    } else {
    ?>
      <form method="post">
        <div class="modal-content bg-purpel">
          <div class="modal-header">
            <div class="text-center">
              <h5 class="modal-title" id="exampleModalLabel">Ingresar</h5>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            <div class="form-group mb-3">
              <input style="font-size: 15px;" type="text" name="ingresoCorreo" class="form-control" placeholder="Ingrese el usuario" required>
            </div>

            <div class="form-group mb-3">
              <input style="font-size: 15px;" type="password" name="ingresoPassword" class="form-control" placeholder="Ingrese la contraseña" required>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
            <button type="submit" class="btn btn-primary">Ingresar</button>
          </div>
        </div>
        <?php
        $login = new ControladorUsuarios();
        $login->ctrIngresoUsuario();
        ?>
      </form>
    <?php
    }
    ?>
  </div>
</div>

<script>
  function mostrarContrasena(){
      var tipo = document.getElementById("password");
      if(tipo.type == "password"){
          tipo.type = "text";
      }else{
          tipo.type = "password";
      }
  }
</script>