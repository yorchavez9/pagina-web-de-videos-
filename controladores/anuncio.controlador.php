<?php

class ControladorAnuncio
{

	/* =======================================
    REGISTRO DE ANUNCIO
    ======================================= */

	static public function ctrCrearAnuncio()
	{

		if (isset($_POST["nuevoCodigoA"])) {
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoCodigoA"])) {

				/*=============================================
				VALIDAR IMAGEN MAIN
				=============================================*/

				$rutaImagenMain = "";

				if(isset($_FILES["nuevoImagenAM"])){

					$file_name = $_FILES['nuevoImagenAM']['name'];
					$temp_name = $_FILES['nuevoImagenAM']['tmp_name'];

					$directorio = "";
					
					$directorio = "vistas/img/anuncio/main/".$_POST["nuevoCodigoA"];

					mkdir($directorio, 0755);

					if($_FILES["nuevoImagenAM"]["type"] == "image/png" || $_FILES["nuevoImagenAM"]["type"] == "image/jpeg"){

						$rutaImagenMain = "vistas/img/anuncio/main/".$_POST["nuevoCodigoA"]."/".$file_name;

						move_uploaded_file($temp_name,$rutaImagenMain);
					}
				}

				/*=============================================
				VALIDAR IMAGEN BANNER
				=============================================*/


				$rutaImagenBanner = "";

				if(isset($_FILES["nuevoImagenAB"])){

					$file_name_imagen = $_FILES['nuevoImagenAB']['name'];
					$temp_name_imagen = $_FILES['nuevoImagenAB']['tmp_name'];

					$directorioImagen = "";
					
					$directorioImagen = "vistas/img/anuncio/banner/".$_POST["nuevoCodigoA"];

					mkdir($directorioImagen, 0755);

					if($_FILES["nuevoImagenAB"]["type"] == "image/png" || $_FILES["nuevoImagenAB"]["type"] == "image/jpeg" ){

						$rutaImagenBanner = "vistas/img/anuncio/banner/".$_POST["nuevoCodigoA"]."/".$file_name_imagen;

						move_uploaded_file($temp_name_imagen,$rutaImagenBanner);
					}
				}


				$tabla = "anuncio";


				/*==========================================================
				ENTRADA DE DATOS DEL ANUNCIO
				========================================================== */

				$datos = array(
					"id_c" => $_POST["nuevaCategoria"],
					"id_r" => $_POST["nuevoIdRegalo"],
					"codigo_a" => $_POST["nuevoCodigoA"],
					"imagen_a" => $rutaImagenMain,
					"imagen_a_b" => $rutaImagenBanner,
					"titulo_a" => $_POST["nuevoTituloA"],
					"descripcion_a" => $_POST["nuevoDescripcionA"],
					"link_a" => $_POST["nuevoLinkA"]
				);

				$respuesta = ModeloAnuncio::mdlIngresarAnuncio($tabla, $datos);


				if($respuesta == "ok"){

					echo '<script>

							Swal.fire({
								title: "El anuncio ha sido guardado con exito!",
								text: "Has click para cerrar",
								icon: "success",
								confirmButtonColor: "#0576b9",
							}).then(function(result){

									if(result.value){
									
										window.location = "admin-anuncio";

									}

								});
						

						</script>';

				}


			} else {

				echo '<script>

						Swal.fire({
							title: "El código del anuncio no puede ir vacio o llevar caracteres especiales!",
							text: "Has click para cerrar",
							icon: "error",
							confirmButtonColor: "#0576b9",
						}).then(function(result){

								if(result.value){
								
									window.location = "admin-anuncio";

								}

							});
					

					</script>';
			}
		}
	}

	/* ========================================
    MOSTRAR ANUNCIO
    ======================================== */

	static public function ctrMostrarAnuncio($item, $valor)
	{
		$tablaC = "categoria";
		$tablaR = "regalo";
		$tablaA = "anuncio";

		$respuesta = ModeloAnuncio::mdlMostrarAnuncio($tablaC, $tablaR, $tablaA, $item, $valor);

		return $respuesta;
	}

	/* =============================================
	EDITAR ANUNCIO
	============================================= */

	static public function ctrEditarAnuncio()
	{

		if (isset($_POST["editarIdAnuncio"])) {

			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCodigoA"])) {

				

				/*=============================================
				VALIDAR IMAGEN
				=============================================*/

				$rutaImagenE = $_POST["imagenActualA"];


				if(isset($_FILES["editarImagenA"])){
					
					$file_name = $_FILES['editarImagenA']['name'];
					$temp_name = $_FILES['editarImagenA']['tmp_name'];
					
					$directorio = "vistas/img/anuncio/main/".$_POST["editarCodigoA"];

					mkdir($directorio, 0755);

					if($_FILES["editarImagenA"]["type"] == "image/png" || $_FILES["editarImagenA"]["type"] == "image/jpeg"){

						$rutaImagenE = "vistas/img/anuncio/main/".$_POST["editarCodigoA"]."/".$file_name;

						move_uploaded_file($temp_name,$rutaImagenE);
					}
				}


				/*=============================================
				VALIDAR IMAGEN
				=============================================*/

				$rutaBannerE = $_POST["imagenActualB"];


				if(isset($_FILES["editarImagenB"])){
					
					$file_name = $_FILES['editarImagenB']['name'];
					$temp_name = $_FILES['editarImagenB']['tmp_name'];
					
					$directorio = "vistas/img/anuncio/banner/".$_POST["editarCodigoA"];

					mkdir($directorio, 0755);

					if($_FILES["editarImagenB"]["type"] == "image/png" || $_FILES["editarImagenB"]["type"] == "image/jpeg"){

						$rutaBannerE = "vistas/img/anuncio/banner/".$_POST["editarCodigoA"]."/".$file_name;

						move_uploaded_file($temp_name,$rutaBannerE);
					}
				}

				$tabla = "anuncio";


				$datos = array(
					"id_c" => $_POST["editarCategoriaAn"],
					"id_r" => $_POST["editarRegaloA"],
					"codigo_a" => $_POST["editarCodigoA"],
					"imagen_a" => $rutaImagenE,
					"imagen_a_b" => $rutaBannerE,
					"titulo_a" => $_POST["editarTituloR"],
					"descripcion_a" => $_POST["editarDescripcionA"],
					"link_a" => $_POST["editarLinkA"],
					"id_a" => $_POST["editarIdAnuncio"]
				);

				$respuesta = ModeloAnuncio::mdlEditarAnuncio($tabla, $datos);
				
				if ($respuesta == "ok") {

					echo '<script>
			   
							Swal.fire({
								title: "¡El  anuncio ha sido editado con éxito!",
								text: "Has click para cerrar",
								icon: "success",
								confirmButtonColor: "#0576b9",
							}).then(function(result){

									if(result.value){
									
										window.location = "admin-anuncio";

									}

								});
						

						</script>';
				}


			} else {

				echo '<script>

							  Swal.fire({
								  title: "¡El código no puede ir vacio o llevar caracteres especiales!",
								  text: "Has click para cerrar",
								  icon: "error",
								  confirmButtonColor: "#0576b9",
							  }).then(function(result){

									  if(result.value){
									  
										  window.location = "admin-anuncio";

									  }

								  });
						  

						  </script>';
			}
		}
	}

	/* ========================================
	BORRAR ANUNCIO
	======================================== */

	static public function ctrBorrarAnuncio(){
		if(isset($_GET["idAnuncio"])){

			$tabla = "anuncio";

			$datos = $_GET["idAnuncio"];
			
			if($_GET["imagenAnuncio"]!=""){

				unlink($_GET["imagenAnuncio"]);
				rmdir('vistas/img/anuncio/main/'.$_GET["condigoAnuncio"]);

			}

			if($_GET["imagenBanner"]!=""){

				unlink($_GET["imagenBanner"]);
				rmdir('vistas/img/anuncio/banner/'.$_GET["condigoAnuncio"]);

			}

			$respuesta = ModeloAnuncio::mdlBorrarAnuncio($tabla, $datos);

			if($respuesta == "ok"){
				echo '<script>

				Swal.fire({
					title: "¡El anuncio ha sido borrado con exito!",
					text: "Has click para cerrar",
					icon: "success",
					confirmButtonColor: "#0576b9",
				}).then(function(result){

						if(result.value){
						
							window.location = "admin-anuncio";

						}

					});
			

			</script>';

			}
		}
	}
}
