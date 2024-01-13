<?php

class ControladorCategoria
{

	/* =======================================
    REGISTRO DE CATEGORIA
    ======================================= */

	static public function ctrCrearCategoria()
	{

		if (isset($_POST["nuevoNombreC"])) {

			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombreC"])) {


				$tabla = "categoria";

				$datos = array(
					"nombre_c" => $_POST["nuevoNombreC"],
					"id_cp" => $_POST["nuevoIdCategoriaP"]
				);

                $respuesta = ModeloCategoria::mdlIngresarCategoria($tabla, $datos);

			} else {
                echo '<script>

                            Swal.fire({
                                title: "¡El nombre de la cateogoría no puede llevar caracteres espciales!",
                                text: "Has click para cerrar",
                                icon: "error",
                                confirmButtonColor: "#0576b9",
                            }).then(function(result){

                                    if(result.value){
                                    
                                        window.location = "admin-categoria";

                                    }

                                });
                        

                        </script>';
			}
		}
	}

	/* ========================================
    MOSTRAR CATEGORIA
    ======================================== */

	static public function ctrMostrarCategoria($item, $valor)
	{
		$tablaP = "categoriap";
		$tablaS = "categoria";

		$respuesta = ModeloCategoria::mdlMostrarUCategoria($tablaP, $tablaS, $item, $valor);

		return $respuesta;
	}

	/* =============================================
	EDITAR CATEGORIA
	============================================= */

	static public function ctrEditarCategoria()
	{

		if (isset($_POST["editarIdCategoria"])) {

			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombreC"])) {

				$tabla = "categoria";

				$datos = array(
					"id_c" => $_POST["editarIdCategoria"],
					"nombre_c" => $_POST["editarNombreC"],
					"id_cp" => $_POST["editandoCategoriaP"]
				);

                $respuesta = ModeloCategoria::mdlEditarCategoria($tabla, $datos);

			} else {

				echo '<script>

                        Swal.fire({
                            title: "¡La categoría no puede ir vacio o llevar caracteres especiales!",
                            text: "Has click para cerrar",
                            icon: "error",
                            confirmButtonColor: "#0576b9",
                        }).then(function(result){

                                if(result.value){
                                
                                    window.location = "admin-categoria";

                                }

                            });
                    

                    </script>';
			}
		}
	}

	/* ========================================
	BORRAR USUARIO
	======================================== */

	static public function ctrBorrarCategoria(){
		if(isset($_POST["idCategoriaD"])){

			$tabla = "categoria";
			$datos = $_POST["idCategoriaD"];

			$respuesta = ModeloCategoria::mdlBorrarCategoria($tabla, $datos);
		}
	}
}
