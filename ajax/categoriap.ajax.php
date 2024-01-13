<?php

require_once "../controladores/categoriap.controlador.php";
require_once "../modelos/categoriap.modelo.php";

class AjaxCategoriaP{

	/*=============================================
	EDITAR CATEGORIA A
	=============================================*/	

	public $idCategoriaP;

	public function ajaxEditarCategoriaP(){

		$item = "id_cp";
		$valor = $this->idCategoriaP;

        $respuesta = ControladorCategoriaP::ctrMostrarCategoriaP($item, $valor);

		echo json_encode($respuesta);

	}

}

/*=============================================
EDITAR CATEGORIA A
=============================================*/
if(isset($_POST["idCategoriaP"])){

	$editar = new AjaxCategoriaP();
	$editar -> idCategoriaP = $_POST["idCategoriaP"];
	$editar -> ajaxEditarCategoriaP();

}

/* ===========================================
GUARDAR CATEGORIA A
=========================================== */

if(isset($_POST["nuevoNombreCP"])){
    $nuevaCategoriaP = new ControladorCategoriaP();
    $nuevaCategoriaP->ctrCrearCategoriaP();
}

/* ==============================================
GUARDAR VIDEO ECATEGORIA A
============================================== */
if(isset($_POST["editarIdCategoriaP"])){
	$editarCategoriaP = new ControladorCategoriaP();
	$editarCategoriaP->ctrEditarCategoriaP();
}


/* =========================================
ELMINANDO
========================================= */

if(isset($_POST["idCategoriaPD"])){
    $borrarCategoriaP = new ControladorCategoriaP();
    $borrarCategoriaP->ctrBorrarCategoriaP();
}