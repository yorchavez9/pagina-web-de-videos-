<?php

class ControladorCategoriaP
{

	/* =======================================
    REGISTRO DE CATEGORIA A
    ======================================= */

	static public function ctrCrearCategoriaP()
	{

		if (isset($_POST["nuevoNombreCP"])) {
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombreCP"])) {

				$tabla = "categoriap";

				/*==========================================================
				ENTRADA DE DATOS DEL REGALO
				========================================================== */

				$datos = array(
					"nombre_cp" => $_POST["nuevoNombreCP"]
				);

				$respuesta = ModeloCategoriaP::mdlIngresarCategoriaP($tabla, $datos);

			} else {

				echo '<script>

						Swal.fire({
							title: "El nombre de la categoria no puede ir vacio o llevar caracteres especiales!",
							text: "Has click para cerrar",
							icon: "error",
							confirmButtonColor: "#0576b9",
						}).then(function(result){

								if(result.value){
								
									window.location = "admin-categoriap";

								}

							});
					

					</script>';
			}
		}
	}

	/* ========================================
    MOSTRAR CATEGORIA A
    ======================================== */

	static public function ctrMostrarCategoriaP($item, $valor)
	{
		$tabla = "categoriap";

		$respuesta = ModeloCategoriaP::mdlMostrarCategoriaP($tabla, $item, $valor);

		return $respuesta;
	}

	/* =============================================
	EDITAR CATEGORIA A
	============================================= */

	static public function ctrEditarCategoriaP()
	{

		if (isset($_POST["editarIdCategoriaP"])) {

			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombreCP"])) {

				$tabla = "categoriap";

				$datos = array(
					"id_cp" => $_POST["editarIdCategoriaP"],
					"nombre_cp" => $_POST["editarNombreCP"]
				);

			

				$respuesta = ModeloCategoriaP::mdlEditarCategoriaP($tabla, $datos);
				

			} else {

				echo '<script>

							  Swal.fire({
								  title: "¡El nombre de la categoría no puede ir vacio o llevar caracteres especiales!",
								  text: "Has click para cerrar",
								  icon: "error",
								  confirmButtonColor: "#0576b9",
							  }).then(function(result){

									  if(result.value){
									  
										  window.location = "admin-categoriap";

									  }

								  });
						  

						  </script>';
			}
		}
	}

	/* ========================================
	BORRAR CATEGORIA A
	======================================== */

	static public function ctrBorrarCategoriaP(){
		if(isset($_POST["idCategoriaPD"])){

			$tabla = "categoriap";

			$datos = $_POST["idCategoriaPD"];
			

			$respuesta = ModeloCategoriaP::mdlBorrarCategoriaP($tabla, $datos);

			
		}
	}

}
