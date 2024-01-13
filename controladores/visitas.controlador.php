<?php

class ControladorVisitas{

	/*=============================================
	CREAR VISITAS
	=============================================*/

	static public function ctrCrearVisitas($sumaVisitas){				
		
		if(isset($_SERVER['REMOTE_ADDR'])){
			$tabla = "visitas";
			$datos = array(
				"ip_visitas" => $_SERVER['REMOTE_ADDR'],
				"total_visitas"=> $sumaVisitas
			);
			$respuesta = ModeloVisitas::mdlIngresarVisitas($tabla, $datos);
		}

	}

	/*=============================================
	MOSTRAR VISITAS
	=============================================*/

	static public function ctrMostrarVisitas($ip, $tipo){

		
		$tabla = "visitas";

		$respuesta = ModeloVisitas::mdlMostrarVisitas($tabla, $ip, $tipo);

		return $respuesta;
	
	}


	/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function ctrRangoFechasVisitas($fechaInicial, $fechaFinal){

		$tabla = "visitas";

		$respuesta = ModeloVisitas::mdlRangoFechasVisitas($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;
		
	}
}
