<?php

require_once "conexion.php";

class ModeloVisitas{

	/*=============================================
	CREAR VISITAS
	=============================================*/

	static public function mdlIngresarVisitas($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(ip_visitas, total_visitas) VALUES (:ip_visitas, :total_visitas)");

		$stmt->bindParam(":ip_visitas", $datos["ip_visitas"], PDO::PARAM_STR);
		$stmt->bindParam(":total_visitas", $datos["total_visitas"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt = null;

	}


	/*=============================================
	MOSTRAR VISITAS
	=============================================*/

	static public function mdlMostrarVisitas($tabla, $ip, $tipo){

		if($tipo == "contar"){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE ip_visitas = '$ip' ORDER BY ip_visitas DESC");
			$stmt -> execute();
			return $stmt->fetchAll();
		}elseif($tipo == "normal" && $ip==null){
			$stmt = Conexion::conectar()->prepare("SELECT SUM(total_visitas) as sumaVistas FROM $tabla");
			$stmt -> execute();
			return $stmt->fetchAll();
		}

		$stmt = null;

	}


	/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function mdlRangoFechasVisitas($tabla, $fechaInicial, $fechaFinal){

		if($fechaInicial == null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id_visitas ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();	 


		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha_visitas like '%$fechaFinal%'");

			$stmt -> bindParam(":fecha_visitas", $fechaFinal, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$fechaActual = new DateTime();
			$fechaActual ->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2 ->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

			if($fechaFinalMasUno == $fechaActualMasUno){

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha_visitas BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha_visitas BETWEEN '$fechaInicial' AND '$fechaFinal'");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}

}

