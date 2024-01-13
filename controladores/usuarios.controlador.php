<?php

class ControladorUsuarios
{
	/*  =====================================
    INGRESO DE USUARIOS
    ===================================== */

	static public function ctrIngresoUsuario()
	{
		if (isset($_POST["ingresoCorreo"])) {
			if ($_POST["ingresoCorreo"]) {

				$encriptar = crypt($_POST["ingresoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$tabla = "usuarios";
				$item = "correo_usuario";
				$valor = $_POST["ingresoCorreo"];

				$respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);

				if ($respuesta["correo_usuario"] == $_POST["ingresoCorreo"] && $respuesta["password_usuario"] == $encriptar) {
					if ($respuesta["estado_usuario"] == 1) {

						$_SESSION["iniciarSession"] = "ok";
						$_SESSION["id_usuario"] = $respuesta["id_usuario"];
						$_SESSION["nombre_usuario"] = $respuesta["nombre_usuario"];
						$_SESSION["correo_usuario"] = $respuesta["correo_usuario"];
						$_SESSION["foto_usuario"] = $respuesta["foto_usuario"];
						$_SESSION["perfil_usuario"] = $respuesta["perfil_usuario"];

						/*  =================================================
                        REGISTRAR FECHA PARA SABER EL ÚTIMO LOGIN
                        ================================================= */

						date_default_timezone_set('America/Lima');

						$fecha = date('Y-m-d');
						$hora = date('Y-m-d');

						$fechaActual = $fecha . ' ' . $hora;

						$item1 = "ultimo_login_usuario";
						$valor1 = $fechaActual;

						$item2 = "id_usuario";
						$valor2 = $respuesta["id_usuario"];

						$ultimoLogin = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor2, $item2, $valor2);

						if ($ultimoLogin == "ok") {
							echo '<script>
                                window.location = "admin-inicio";
                            </script>';
						}
					} else {
						echo '<br> <div class="alert-danger">El usuario aún no está activado</div>';
					}
				} else {
					echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentarlo</div>';
				}
			}
		}
	}


	/* =======================================
    REGISTRO DE USUARIO
    ======================================= */

	static public function ctrCrearUsuario()
	{

		if (isset($_POST["nuevoCorreo"])) {

			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"])) {

				/*=============================================
				VALIDAR IMAGEN
				=============================================*/


				$rutaImagenU = "";

				if(isset($_FILES["nuevoFoto"])){

					$file_name_imagen = $_FILES['nuevoFoto']['name'];
					$temp_name_imagen = $_FILES['nuevoFoto']['tmp_name'];

					$directorioImagen = "";
					
					$directorioImagen = "vistas/img/usuarios/".$_POST["nuevoCorreo"];

					mkdir($directorioImagen, 0755);

					if($_FILES["nuevoFoto"]["type"] == "image/png" || $_FILES["nuevoFoto"]["type"] == "image/jpeg" ){

						$rutaImagenU = "vistas/img/usuarios/".$_POST["nuevoCorreo"]."/".$file_name_imagen;

						move_uploaded_file($temp_name_imagen,$rutaImagenU);
					}
				}


				$tabla = "usuarios";

				$encriptar = crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$datos = array(
					"nombre_usuario" => $_POST["nuevoNombre"],
					"correo_usuario" => $_POST["nuevoCorreo"],
					"password_usuario" => $encriptar,
					"perfil_usuario" => $_POST["nuevoPerfil"],
					"foto_usuario" => $rutaImagenU
				);

				$respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);

				
				if ($respuesta == "ok") {


					echo '<script>

						Swal.fire({
							title: "¡Se registró con exito!",
							text: "Has click para cerrar",
							icon: "success",
							confirmButtonColor: "#0576b9",
						}).then(function(result){

								if(result.value){
								
									window.location = "admin-usuarios";

								}

							});
					

					</script>';
			
				}
				
			} else {

				echo '<script>

						Swal.fire({
							title: "¡Error al regsitrar los datos!",
							text: "Has click para cerrar",
							icon: "success",
							confirmButtonColor: "#0576b9",
						}).then(function(result){

								if(result.value){
								
									window.location = "admin-usuarios";

								}

							});
					

					</script>';
			}
		}
	}

	/* ========================================
    MOSTRAR USUARIOS
    ======================================== */

	static public function ctrMostrarUsuarios($item, $valor)
	{
		$tabla = "usuarios";

		$respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);

		return $respuesta;
	}

	/* =============================================
	EDITAR USUARIO
	============================================= */

	static public function ctrEditarUsuario()
	{

		if (isset($_POST["editarCorreo"])) {

			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"])) {

				/*=============================================
				VALIDAR IMAGEN
				=============================================*/

				$ruta = $_POST["fotoActual"];

				if (isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"])) {

					list($ancho, $alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vistas/img/usuarios/" . $_POST["editarCorreo"];

					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/

					if (!empty($_POST["fotoActual"])) {

						unlink($_POST["fotoActual"]);
					} else {

						mkdir($directorio, 0755);
					}

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if ($_FILES["editarFoto"]["type"] == "image/jpeg") {

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100, 999);

						$ruta = "vistas/img/usuarios/" . $_POST["editarCorreo"] . "/" . $aleatorio . ".jpg";

						$origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);
					}

					if ($_FILES["editarFoto"]["type"] == "image/png") {

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100, 999);

						$ruta = "vistas/img/usuarios/" . $_POST["editarCorreo"] . "/" . $aleatorio . ".png";

						$origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);
					}
				}

				$tabla = "usuarios";

				if ($_POST["editarPassword"] != "") {

					if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])) {

						$encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
					} else {


						echo '<script>

							  Swal.fire({
								  title: "¡La contraseña no puede ir vacía o llevar caracteres especiales!",
								  text: "Has click para cerrar",
								  icon: "error",
								  confirmButtonColor: "#0576b9",
							  }).then(function(result){

									  if(result.value){
									  
										  window.location = "admin-usuarios";

									  }

								  });
						  

						  </script>';

						return;
					}
				} else {

					$encriptar = $_POST["passwordActual"];
				}

				$datos = array(
					"nombre_usuario" => $_POST["editarNombre"],
					"correo_usuario" => $_POST["editarCorreo"],
					"password_usuario" => $encriptar,
					"perfil_usuario" => $_POST["editarPerfil"],
					"foto_usuario" => $ruta
				);

				$respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);
				echo $respuesta;
				if ($respuesta == "ok") {

					echo '<script>
			   
											 Swal.fire({
												 title: "¡El usuario ha sido editado con éxito!",
												 text: "Has click para cerrar",
												 icon: "success",
												 confirmButtonColor: "#0576b9",
											 }).then(function(result){
			   
													 if(result.value){
													 
														 window.location = "admin-usuarios";
			   
													 }
			   
												 });
										 
			   
										 </script>';
				}
			} else {

				echo '<script>

							  Swal.fire({
								  title: "¡El nombre no puede ir vacio o llevar caracteres especiales!",
								  text: "Has click para cerrar",
								  icon: "error",
								  confirmButtonColor: "#0576b9",
							  }).then(function(result){

									  if(result.value){
									  
										  window.location = "admin-usuarios";

									  }

								  });
						  

						  </script>';
			}
		}
	}

	/* ========================================
	BORRAR USUARIO
	======================================== */

	static public function ctrBorrarUsuario(){
		if(isset($_GET["idUsuario"])){
			$tabla = "usuarios";
			$datos = $_GET["idUsuario"];
			if($_GET["fotoUsuario"]!=""){
				unlink($_GET["fotoUsuario"]);
				rmdir('vistas/img/usuarios/'.$_GET["correo"]);
			}

			$respuesta = ModeloUsuarios::mdlBorrarUsuario($tabla, $datos);

			if($respuesta == "ok"){
				echo '<script>

				Swal.fire({
					title: "¡El usuario ha sido borrado con exito!",
					text: "Has click para cerrar",
					icon: "success",
					confirmButtonColor: "#0576b9",
				}).then(function(result){

						if(result.value){
						
							window.location = "admin-usuarios";

						}

					});
			

			</script>';

			}
		}
	}
}
