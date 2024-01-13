<?php

require_once "../controladores/regalo.controlador.php";
require_once "../modelos/regalo.modelo.php";

class AjaxRegalo{

	/*=============================================
	EDITAR REGALO
	=============================================*/	

	public $idRegalo;

	public function ajaxEditarRegalo(){

		$tipo ="normal";
		$item = "id_r";
		$valor = $this->idRegalo;

        $respuesta = ControladorRegalo::ctrMostrarRegalo($tipo, $item, $valor);

		echo json_encode($respuesta);

	}

}

/*=============================================
EDITAR REGALO
=============================================*/
if(isset($_POST["idRegalo"])){

	$editar = new AjaxRegalo();
	$editar -> idRegalo = $_POST["idRegalo"];
	$editar -> ajaxEditarRegalo();

}

/* ===========================================
GUARDAR VIDEO 
=========================================== */

if(isset($_POST["nuevoIdCategoria"])){
	$nuevoRegalo = new ControladorRegalo();
	$nuevoRegalo->ctrCrearRegalo();
}



/* ==============================================
GUARDAR VIDEO EDITADO
============================================== */
if(isset($_POST["editarIdRegalo"])){
	$editarRegalo = new ControladorRegalo();
	$editarRegalo->ctrEditarRegalo();
}


