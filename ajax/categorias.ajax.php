<?php


require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

class AjaxCategoria{

	/*=============================================
	EDITAR USUARIO
	=============================================*/	

	public $idCategoria;

	public function ajaxEditarCategoria(){

		$item = "id_c";
		$valor = $this->idCategoria;

        $respuesta = ControladorCategoria::ctrMostrarCategoria($item, $valor);

		echo json_encode($respuesta);

	}

}

/* =========================================
GUARDAR DATOS DE CATEGORIA B
========================================= */

if (isset($_POST["nuevoIdCategoriaP"])) {
	$nuevaCategoria = new ControladorCategoria();
	$nuevaCategoria->ctrCrearCategoria();
}

/*=============================================
EDITAR USUARIO
=============================================*/
if(isset($_POST["idCategoria"])){

	$editar = new AjaxCategoria();
	$editar -> idCategoria = $_POST["idCategoria"];
	$editar -> ajaxEditarCategoria();

}


/* ====================================
GUARDAR DATOS EDITADOS
==================================== */

if(isset($_POST["editarIdCategoria"])){
	$editarCategoria = new ControladorCategoria();
	$editarCategoria->ctrEditarCategoria();
}

if(isset($_POST["idCategoriaD"])){
	$borrarCategoria = new ControladorCategoria();
    $borrarCategoria->ctrBorrarCategoria();
}