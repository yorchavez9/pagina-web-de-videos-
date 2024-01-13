<?php

require_once "conexion.php";

class ModeloAnuncio{

    /* ===============================================
    MOSTRAR ANUNCIO
    =============================================== */

    static public function mdlMostrarAnuncio($tablaC, $tablaR, $tablaA, $item, $valor){
        if($item != null){
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tablaC INNER JOIN $tablaR INNER JOIN $tablaA ON $tablaC.id_c = $tablaR.id_c AND  $tablaR.id_r = $tablaA.id_r WHERE $item = :$item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();

        }else{

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tablaC INNER JOIN $tablaR INNER JOIN $tablaA ON $tablaC.id_c = $tablaR.id_c AND  $tablaR.id_r = $tablaA.id_r");
            $stmt->execute();
            return $stmt->fetchAll();

        }

        $stmt = null;
    }

   /*  ================================================
    REGISTRO DE ANUNCIO
    ================================================ */

    static public function mdlIngresarAnuncio($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_c, id_r, codigo_a, imagen_a, imagen_a_b, titulo_a, descripcion_a, link_a) 
                                                            VALUES(:id_c, :id_r, :codigo_a, :imagen_a, :imagen_a_b, :titulo_a, :descripcion_a, :link_a)");
        $stmt->bindParam(":id_c", $datos["id_c"], PDO::PARAM_INT);
        $stmt->bindParam(":id_r", $datos["id_r"], PDO::PARAM_INT);
        $stmt->bindParam(":codigo_a", $datos["codigo_a"], PDO::PARAM_STR);
        $stmt->bindParam(":imagen_a", $datos["imagen_a"], PDO::PARAM_STR);
        $stmt->bindParam(":imagen_a_b", $datos["imagen_a_b"], PDO::PARAM_STR);
        $stmt->bindParam(":titulo_a", $datos["titulo_a"], PDO::PARAM_STR);
        $stmt->bindParam(":descripcion_a", $datos["descripcion_a"], PDO::PARAM_STR);
        $stmt->bindParam(":link_a", $datos["link_a"], PDO::PARAM_STR);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt = null;
    }

    /* ===============================================
    EDITAR ANUNCIO
    =============================================== */

	static public function mdlEditarAnuncio($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET 
                                                                id_c = :id_c, 
                                                                id_r = :id_r, 
                                                                codigo_a = :codigo_a, 
                                                                imagen_a = :imagen_a, 
                                                                imagen_a_b = :imagen_a_b, 
                                                                titulo_a = :titulo_a, 
                                                                descripcion_a = :descripcion_a,
                                                                link_a = :link_a
                                                          WHERE id_a = :id_a");

		$stmt -> bindParam(":id_c", $datos["id_c"], PDO::PARAM_INT);
		$stmt -> bindParam(":id_r", $datos["id_r"], PDO::PARAM_INT);
		$stmt -> bindParam(":codigo_a", $datos["codigo_a"], PDO::PARAM_STR);
		$stmt -> bindParam(":imagen_a", $datos["imagen_a"], PDO::PARAM_STR);
		$stmt -> bindParam(":imagen_a_b", $datos["imagen_a_b"], PDO::PARAM_STR);
		$stmt -> bindParam(":titulo_a", $datos["titulo_a"], PDO::PARAM_STR);
		$stmt -> bindParam(":descripcion_a", $datos["descripcion_a"], PDO::PARAM_STR); 
		$stmt -> bindParam(":link_a", $datos["link_a"], PDO::PARAM_STR); 
		$stmt -> bindParam(":id_a", $datos["id_a"], PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}


		$stmt = null;

	}

   /*  =================================================
    BORRAR ANUNCIO
    ================================================= */

    static public function mdlBorrarAnuncio($tabla, $datos){
        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_a = :id_a");
        $stmt->bindParam(":id_a", $datos, PDO::PARAM_INT);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt = null;
    }
}

