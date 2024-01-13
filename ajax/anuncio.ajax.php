<?php


require_once "../controladores/anuncio.controlador.php";
require_once "../modelos/anuncio.modelo.php";

class AjaxAnuncio{

	/*=============================================
	EDITAR ANUNCIO
	=============================================*/	

	public $idAnuncio;

	public function ajaxEditarAnuncio(){

		$item = "id_a";
		$valor = $this->idAnuncio;

		$respuesta = ControladorAnuncio::ctrMostrarAnuncio($item, $valor);

		echo json_encode($respuesta);

	}

}

/*=============================================
EDITAR ANUNCIO
=============================================*/
if(isset($_POST["idAnuncio"])){

	$editar = new AjaxAnuncio();
	$editar -> idAnuncio = $_POST["idAnuncio"];
	$editar -> ajaxEditarAnuncio();

}
