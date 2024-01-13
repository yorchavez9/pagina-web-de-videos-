<?php

class ControladorRegalo
{

	/* =======================================
    REGISTRO DE REGALO
    ======================================= */

	static public function ctrCrearRegalo()
	{

		if (isset($_POST["nuevoCodigoR"])) {
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoCodigoR"])) {

				/*=============================================
				VALIDAR VIDEO
				=============================================*/

				$rutaVideo = "";

				if(isset($_FILES["nuevoVideoR"])){

					$file_name = $_FILES['nuevoVideoR']['name'];
					$temp_name = $_FILES['nuevoVideoR']['tmp_name'];

					$directorio = "";
					
					$directorio = "../vistas/img/regalo/video/".$_POST["nuevoCodigoR"];

					mkdir($directorio, 0755);

					if($_FILES["nuevoVideoR"]["type"] == "video/mp4"){

						$rutaVideo = "../vistas/img/regalo/video/".$_POST["nuevoCodigoR"]."/".$file_name;

						move_uploaded_file($temp_name,$rutaVideo);
					}
				}

				/*=============================================
				VALIDAR IMAGEN
				=============================================*/


				$rutaImagen = "";

				if(isset($_FILES["nuevoFotoR"])){

					$file_name_imagen = $_FILES['nuevoFotoR']['name'];
					$temp_name_imagen = $_FILES['nuevoFotoR']['tmp_name'];

					$directorioImagen = "";
					
					$directorioImagen = "../vistas/img/regalo/img/".$_POST["nuevoCodigoR"];

					mkdir($directorioImagen, 0755);

					if($_FILES["nuevoFotoR"]["type"] == "image/png" || $_FILES["nuevoFotoR"]["type"] == "image/jpeg" ){

						$rutaImagen = "../vistas/img/regalo/img/".$_POST["nuevoCodigoR"]."/".$file_name_imagen;

						move_uploaded_file($temp_name_imagen,$rutaImagen);
					}
				}


				$tabla = "regalo";


				/*==========================================================
				ENTRADA DE DATOS DEL REGALO
				========================================================== */

				$datos = array(
					"id_c" => $_POST["nuevoIdCategoria"],
					"codigo_r" => $_POST["nuevoCodigoR"],
					"video_r" => $rutaVideo,
					"imagen_r" => $rutaImagen,
					"titulo_r" => $_POST["nuevoTituloR"],
					"descripcion_r" => $_POST["nuevoDescripcionR"]
				);

				$respuesta = ModeloRegalo::mdlIngresarRegalo($tabla, $datos);


			} else {

				echo '<script>

						Swal.fire({
							title: "El ccódigo del video no puede ir vacio o llevar caracteres especiales!",
							text: "Has click para cerrar",
							icon: "error",
							confirmButtonColor: "#0576b9",
						}).then(function(result){

								if(result.value){
								
									window.location = "admin-regalo";

								}

							});
					

					</script>';
			}
		}
	}

	/* ========================================
    MOSTRAR REGALO
    ======================================== */

	static public function ctrMostrarRegalo($tipo, $item, $valor)
	{
		$tablaC = "categoria";
		$tablaR = "regalo";

		$respuesta = ModeloRegalo::mdlMostrarRegalo($tipo, $tablaC, $tablaR, $item, $valor);

		return $respuesta;
	}

	/* =============================================
	EDITAR REGALO
	============================================= */

	static public function ctrEditarRegalo()
	{

		if (isset($_POST["editarIdRegalo"])) {

			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCodigoR"])) {

				/*=============================================
				VALIDAR VALIDAR
				=============================================*/

				$rutaVideo = $_POST["videoActualR"];


				if(isset($_FILES["editarVideoR"])){
					
					$file_name = $_FILES['editarVideoR']['name'];
					$temp_name = $_FILES['editarVideoR']['tmp_name'];
					
					$directorio = "../vistas/img/regalo/video/".$_POST["editarCodigoR"];

					mkdir($directorio, 0755);

					if($_FILES["editarVideoR"]["type"] == "video/mp4"){

						$rutaVideo = "../vistas/img/regalo/video/".$_POST["editarCodigoR"]."/".$file_name;

						move_uploaded_file($temp_name,$rutaVideo);
					}
				}

				/*=============================================
				VALIDAR IMAGEN
				=============================================*/

				$rutaImagen = $_POST["fotoActualR"];


				if(isset($_FILES["editarFotoR"])){
					
					$file_name = $_FILES['editarFotoR']['name'];
					$temp_name = $_FILES['editarFotoR']['tmp_name'];
					
					$directorio = "../vistas/img/regalo/img/".$_POST["editarCodigoR"];

					mkdir($directorio, 0755);

					if($_FILES["editarFotoR"]["type"] == "image/jpeg" || $_FILES["editarFotoR"]["type"] == "image/png"){

						$rutaImagen = "../vistas/img/regalo/img/".$_POST["editarCodigoR"]."/".$file_name;

						move_uploaded_file($temp_name,$rutaImagen);
					}
				}

				$tabla = "regalo";


				$datos = array(
					"id_c" => $_POST["editarCategoriaR"],
					"codigo_r" => $_POST["editarCodigoR"],
					"video_r" => $rutaVideo,
					"imagen_r" => $rutaImagen,
					"titulo_r" => $_POST["editarTituloR"],
					"descripcion_r" => $_POST["editarDescripcionR"],
					"id_r" => $_POST["editarIdRegalo"]
				);

			

				$respuesta = ModeloRegalo::mdlEditarRegalo($tabla, $datos);
				

			} else {

				echo '<script>

							  Swal.fire({
								  title: "¡El código no puede ir vacio o llevar caracteres especiales!",
								  text: "Has click para cerrar",
								  icon: "error",
								  confirmButtonColor: "#0576b9",
							  }).then(function(result){

									  if(result.value){
									  
										  window.location = "admin-regalo";

									  }

								  });
						  

						  </script>';
			}
		}
	}

	/* ========================================
	BORRAR REGALO
	======================================== */

	static public function ctrBorrarRegalo(){
		if(isset($_GET["idRegalo"])){

			$tabla = "regalo";

			$datos = $_GET["idRegalo"];
			
			if($_GET["videoRegalo"]!=""){

				unlink($_GET["videoRegalo"]);
				rmdir('vistas/img/regalo/video/'.$_GET["codigoRegalo"]);

			}

			if($_GET["imagenRegalo"]!=""){

				unlink($_GET["imagenRegalo"]);
				rmdir('vistas/img/regalo/img/'.$_GET["codigoRegalo"]);

			}

			$respuesta = ModeloRegalo::mdlBorrarRegalo($tabla, $datos);

			if($respuesta == "ok"){
				echo '<script>

				Swal.fire({
					title: "¡El video ha sido borrado con exito!",
					text: "Has click para cerrar",
					icon: "success",
					confirmButtonColor: "#0576b9",
				}).then(function(result){

						if(result.value){
						
							window.location = "admin-regalo";

						}

					});
			

			</script>';

			}
		}
	}

	/* ========================================
	BUSCAR VIDEO
	======================================== */
	static public function ctrBuscarVideo($datos){
		
		$tablaC = "categoria";
		$tablaR = "regalo";

		$respuesta = ModeloRegalo::mdlBuscarRegalo($tablaC, $tablaR, $datos);

		return $respuesta;
	}
}
