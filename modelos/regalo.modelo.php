<?php

require_once "conexion.php";

class ModeloRegalo{

    /* ===============================================
    MOSTRAR REGALO
    =============================================== */

    static public function mdlMostrarRegalo($tipo, $tablaC, $tablaR, $item, $valor){
        if($tipo == "normal"){
			if($item !=null){
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tablaC INNER JOIN $tablaR on $tablaC.id_c = $tablaR.id_c WHERE $item = :$item");
				$stmt ->bindParam(":".$item, $valor, PDO::PARAM_STR);
				$stmt->execute();
				return $stmt->fetch();
			}else{
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tablaC INNER JOIN $tablaR ON $tablaC.id_c = $tablaR.id_c");
				$stmt -> execute();
				return $stmt->fetchAll();
			}
		}
        if($tipo == "random" && $item == null && $valor == null){
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tablaC INNER JOIN $tablaR ON $tablaC.id_c = $tablaR.id_c ORDER BY rand()");
            $stmt->execute();
            return $stmt->fetchAll();
        }
        
		if($tipo == "select" && $valor == null){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tablaC INNER JOIN $tablaR on $tablaC.id_c = $tablaR.id_c WHERE $tablaC.id_c = $item");
	
			$stmt -> execute();

			return $stmt -> fetchAll();
		}


		$stmt = null;
    }

   /*  ================================================
    REGISTRO DE REGALO
    ================================================ */

    static public function mdlIngresarRegalo($tabla, $datos){
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_c, codigo_r, video_r, imagen_r, titulo_r, descripcion_r) 
                                                            VALUES(:id_c, :codigo_r, :video_r, :imagen_r, :titulo_r, :descripcion_r)");
        $stmt->bindParam(":id_c", $datos["id_c"], PDO::PARAM_INT);
        $stmt->bindParam(":codigo_r", $datos["codigo_r"], PDO::PARAM_STR);
        $stmt->bindParam(":video_r", $datos["video_r"], PDO::PARAM_STR);
        $stmt->bindParam(":imagen_r", $datos["imagen_r"], PDO::PARAM_STR);
        $stmt->bindParam(":titulo_r", $datos["titulo_r"], PDO::PARAM_STR);
        $stmt->bindParam(":descripcion_r", $datos["descripcion_r"], PDO::PARAM_STR);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt = null;
    }




    /* ===============================================
    EDITAR REGALO
    =============================================== */

	static public function mdlEditarRegalo($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET 
                                                                id_c = :id_c, 
                                                                codigo_r = :codigo_r, 
                                                                video_r = :video_r, 
                                                                imagen_r = :imagen_r, 
                                                                titulo_r = :titulo_r, 
                                                                descripcion_r = :descripcion_r 
                                                          WHERE id_r = :id_r");

		$stmt -> bindParam(":id_c", $datos["id_c"], PDO::PARAM_INT);
		$stmt -> bindParam(":codigo_r", $datos["codigo_r"], PDO::PARAM_STR);
		$stmt -> bindParam(":video_r", $datos["video_r"], PDO::PARAM_STR);
		$stmt -> bindParam(":imagen_r", $datos["imagen_r"], PDO::PARAM_STR);
		$stmt -> bindParam(":titulo_r", $datos["titulo_r"], PDO::PARAM_STR);
		$stmt -> bindParam(":descripcion_r", $datos["descripcion_r"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_r", $datos["id_r"], PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}


		$stmt = null;

	}

   /*  =================================================
    BORRAR REGALO
    ================================================= */

    static public function mdlBorrarRegalo($tabla, $datos){
        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_r = :id_r");
        $stmt->bindParam(":id_r", $datos, PDO::PARAM_INT);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt = null;
    }

    /* ==============================================
	BUSCAR VIDEO
	============================================== */

	static public function mdlBuscarRegalo($tablaC, $tablaR, $datos)
	{
		
		$stmt = Conexion::conectar()->prepare("SELECT * FROM 
												$tablaC INNER JOIN $tablaR ON $tablaC.id_c = $tablaR.id_c
												WHERE $tablaC.nombre_c LIKE  '%$datos%' OR $tablaR.titulo_r LIKE  '%$datos%' ");

		$stmt -> execute();

		return $stmt -> fetchAll();
	}
}

